<?php
namespace T3kit\themeT3kit\Hooks;

/***************************************************************
 *  Copyright notice
 *  (c) 2013 Jo Hasenau <info@cybercraft.de>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use GridElementsTeam\Gridelements\Backend\LayoutSetup;
use GridElementsTeam\Gridelements\Helper\Helper;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Database\ReferenceIndex;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Type\Bitmask\Permission;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Versioning\VersionState;
use TYPO3\CMS\Lang\LanguageService;

/**
 * Class/Function which manipulates the rendering of item example content and replaces it with a grid of child elements.
 *
 * @author Jo Hasenau <info@cybercraft.de>
 * @package TYPO3
 * @subpackage tx_gridelements
 */
class DrawItem extends \GridElementsTeam\Gridelements\Hooks\DrawItem //implements PageLayoutViewDrawItemHookInterface, SingletonInterface
{

//    /**
//     * @var Helper
//     */
//    protected $helper;
//
//    /**
//     * @var DatabaseConnection
//     */
//    protected $databaseConnection;
//
//    /**
//     * @var IconFactory
//     */
//    protected $iconFactory;
//
//    /**
//     * @var LanguageService
//     */
//    protected $languageService;
//
//    /**
//     * Stores whether a certain language has translations in it
//     *
//     * @var array
//     */
//    protected $languageHasTranslationsCache = array();
//
//    /**
//     * @var QueryGenerator
//     */
//    protected $tree;
//
//    /**
//     * @var string
//     */
//    protected $backPath = '';

    /**
     * renders the HTML output for elements of the CType gridelements_pi1
     *
     * @param PageLayoutView $parentObject : The parent object that triggered this hook
     * @param array $row : The current data row for this item
     * @param string $showHidden : query String containing enable fields
     * @param string $deleteClause : query String to check for deleted items
     *
     * @return string $itemContent: The HTML output for elements of the CType gridelements_pi1
     */
    public function renderCTypeGridelements(PageLayoutView $parentObject, &$row, &$showHidden, &$deleteClause)
    {
        $head = array();
        $gridContent = array();
        $editUidList = array();
        $colPosValues = array();
        $singleColumn = false;

        // get the layout record for the selected backend layout if any
        $gridContainerId = $row['uid'];
        /** @var $layoutSetup LayoutSetup */
        $layoutSetup = GeneralUtility::makeInstance(LayoutSetup::class);
        if ($row['pid'] < 0) {
            $originalRecord = BackendUtility::getRecord('tt_content', $row['t3ver_oid']);
        } else {
            $originalRecord = $row;
        }
        $gridElement = $layoutSetup->init($originalRecord['pid'])->cacheCurrentParent($gridContainerId, true);
        $layoutUid = $gridElement['tx_gridelements_backend_layout'];
        $layout = $layoutSetup->getLayoutSetup($layoutUid);
        $parserRows = null;

        if (isset($layout['config']) && isset($layout['config']['rows.'])) {
	    // taras@pixelant.se
	    // we need to check spesial value, that was added at TS 't3kitValue'
	    if (isset($layout['config']['t3kitValue']) && $layout['config']['t3kitValue'] == 1){
		// if this value was set, then we need to build new grid
		$parserRows = $this->generateNewGrid($row, $layout);
	    } else {
		$parserRows = $layout['config']['rows.'];
	    }
        }

        // if there is anything to parse, lets check for existing columns in the layout
        if (is_array($parserRows) && !empty($parserRows)) {
            $this->setMultipleColPosValues($parserRows, $colPosValues);
        } else {
            $singleColumn = true;
            $this->setSingleColPosItems($parentObject, $colPosValues, $gridElement, $showHidden, $deleteClause);
        }

        // if there are any columns, lets build the content for them
        $outerTtContentDataArray = $parentObject->tt_contentData['nextThree'];
        if (!empty($colPosValues)) {
            $this->renderGridColumns($parentObject, $colPosValues, $gridContent, $gridElement, $editUidList,
                $singleColumn, $head, $showHidden, $deleteClause);
        }
        $parentObject->tt_contentData['nextThree'] = $outerTtContentDataArray;

        // if we got a selected backend layout, we have to create the layout table now
        if ($layoutUid && isset($layout['config'])) {
            $itemContent = $this->renderGridLayoutTable($layout, $gridElement, $head, $gridContent);
        } else {
            $itemContent = '<div class="t3-grid-container t3-grid-element-container">';
            $itemContent .= '<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%" class="t3-page-columns t3-grid-table">';
            $itemContent .= '<tr><td valign="top" class="t3-grid-cell t3-page-column t3-page-column-0">' . $gridContent[0] . '</td></tr>';
            $itemContent .= '</table></div>';
        }
        return $itemContent;
    }

    /**
     *	'build on fly' new config for grid, according to flexform data !!!
     *
     * @param array $row : The current data row for this item
     * @param array $layout : The current layout of this 'row' item
     *
     * @return array $result['rows.'] : configuration array for building of BE grid
     */
    private function generateNewGrid (&$row, &$layout){
	// get name of special value
	$rowFieldName = $layout['config']['rowsFieldName'];
	$flexformService = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');
        $flexFormData = $flexformService->convertFlexFormContentToArray($row['pi_flexform']);
	$spVal = intval($flexFormData[$rowFieldName]);

	if ($spVal > 0){

	    // label for BE columns
	    $columnLabel = $layout['config']['rowsDefaultConfig.']['label'];
	    $result ['rows.']['1.']['columns.'] = array();

	    // 'build on fly' our configuration
	    for ($i = 1; $i<=$spVal; $i++){
		$result ['rows.']['1.']['columns.'][$i."."]['name'] = $columnLabel.$i;
		$result ['rows.']['1.']['columns.'][$i."."]['colPos'] = $i - 1;
	    }

	    // rewrite data at layout of current element
	    $layout['config']['colCount'] = $spVal;
	    $layout['config']['rows.'] = $result['rows.'];

	    return $result['rows.'];
	} else {
	    return $layout['config']['rows.'];
	}
    }
}
