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

//use TYPO3\CMS\Extbase\Utility\DebuggerUtility as du;

/**
 * Class/Function which manipulates the rendering of item example content and replaces it with a grid of child elements.
 *
 * @author Jo Hasenau <info@cybercraft.de>
 * @package TYPO3
 * @subpackage tx_gridelements
 */
class DrawItem extends \GridElementsTeam\Gridelements\Hooks\DrawItem //implements PageLayoutViewDrawItemHookInterface, SingletonInterface
{
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
	    if (isset($layout['config']['t3kitValue']) && $layout['config']['t3kitValue'] == 1){
		$itemContent = $this->renderGridLayoutTable($layout, $gridElement, $head, $gridContent, $layout['config']['t3kitBEView']);
	    } else {
		$itemContent = $this->renderGridLayoutTable($layout, $gridElement, $head, $gridContent);
	    }
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

    /**
     * Renders the grid layout table after the HTML content for the single elements has been rendered
     *
     * @param array $layoutSetup : The setup of the layout that is selected for the grid we are going to render
     * @param array $row : The current data row for the container item
     * @param array $head : The data for the column headers of the grid we are going to render
     * @param array $gridContent : The content data of the grid we are going to render
     * @param string $t3kitView BE view of current grid element
     *
     * @return string
     */
    public function renderGridLayoutTable($layoutSetup, $row, $head, $gridContent, $t3kitView = NULL) {

	$specificIds = $this->helper->getSpecificIds($row);
	$flexformService = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');
	$flexFormData = $flexformService->convertFlexFormContentToArray($row['pi_flexform']);

	$colCount = 0;
	if (isset($layoutSetup['config'])) {
	    if (isset($layoutSetup['config']['colCount'])) {
		$colCount = (int) $layoutSetup['config']['colCount'];
	    }
	}

	switch ($t3kitView) {
	    case "t3kit-accordeon2":
		$grid = '<div class="t3-grid-container t3-grid-element-container t3kit-accordeon2-grid-container">';

		$grid .= '<div class="panel-group" id="t3kit-accordeon2-'.$row['uid'].'" role="tablist" aria-multiselectable="TRUE">';

		for ($i = 0; $i < $colCount; $i++){
		    $grid .= '<div class="panel panel-default">';

		    // build header for accordion
		    $grid .= '<div class="panel-heading" role="tab" id="t3kit-accordeon2-heading-'.$row['uid'].'-'.$i.'">';
		    $grid .= '<h4 class="panel-title">';
		    $grid .= '<a role="button" data-toggle="collapse" data-parent="#t3kit-accordeon2-'.$row['uid'].'"'
			    . ' href="#t3kit-accordeon2-collapse-'.$row['uid'].'-'.$i.'" aria-expanded="FALSE"'
			    . ' aria-controls="t3kit-accordeon2-collapse-'.$row['uid'].'-'.$i.'">';

		    // set headers from flexform
		    if ( !empty($flexFormData['tabHeader_'.( $i + 1 )]) ){
			$grid .= $flexFormData['tabHeader_'.( $i + 1 )];
		    } else {
			$grid .= $this->languageService->sL($layoutSetup['config']['rowsDefaultConfig.']['label'] . ( $i + 1 ) );
		    }

		    $grid .= '</a></h4></div>';

		    // build body for accordeons
		    $grid .= '<div  id="t3kit-accordeon2-collapse-'.$row['uid'].'-'.$i.'" class="panel-collapse collapse" role="tabpanel">';
		    $grid .= '<div class="panel-body">';
		    $grid .= $gridContent[$i];
		    $grid .= '</div></div>';

		    $grid .= '</div>';
		}

		$grid .= '</div></div>';
		break;

	    case "t3kit-tabs2":
		$grid = '<div class="t3-grid-container t3-grid-element-container t3kit-tabs2-grid-container">';

		$grid .= '<div class="tabs">';

		// start: build head of tabs
		$grid .= '<ul class="nav nav-tabs" role="tablist">';
		for ($i = 0; $i < $colCount; $i++){

		    if ($i == 0){
			$grid .= '<li class="t3kit-tabs2-grid_li-item active">';
		    } else {
			$grid .= '<li class="t3kit-tabs2-grid_li-item">';
		    }

		    $grid .= '<a href="#t3kit-tabs2-'.$row['uid'].'-'.$i.'" data-toggle="tab" role="tab">';

		    // set headers from flexform
		    if ( !empty($flexFormData['tabHeader_'.( $i + 1 )]) ){
			$grid .= $flexFormData['tabHeader_'.( $i + 1 )];
		    } else {
			$grid .= $this->languageService->sL($layoutSetup['config']['rowsDefaultConfig.']['label'] . ( $i + 1 ) );
		    }

		    $grid .= '</a></li>';
		}
		$grid .= '</ul>';
		// end: build head of tabs

		// start: build body of tabs
		$grid .= '<div class="tab-content">';
		for ($i = 0; $i < $colCount; $i++){

		    if ($i == 0){
			$grid .= '<div role="tabpanel" class="tab-pane fade in active" id="t3kit-tabs2-'.$row['uid'].'-'.$i.'">';
		    } else {
			$grid .= '<div role="tabpanel" class="tab-pane fade" id="t3kit-tabs2-'.$row['uid'].'-'.$i.'">';
		    }
		    $grid .= $gridContent[$i];
		    $grid .= '</div>';
		}
		$grid .= '</div>';
		// end: build body of tabs

		$grid .= '</div></div>';
		break;
	    default:
		// default grid rendefing of view
		$grid = '<div class="t3-grid-container t3-grid-element-container' . ($layoutSetup['frame'] ? ' t3-grid-container-framed t3-grid-container-' . $layoutSetup['frame'] : '') . ($layoutSetup['top_level_layout'] ? ' t3-grid-tl-container' : '') . '">';
		if ($layoutSetup['frame'] || $this->helper->getBackendUser()->uc['showGridInformation'] === 1) {
		    $grid .= '<h4 class="t3-grid-container-title-' . (int) $layoutSetup['frame'] . '">' . BackendUtility::wrapInHelp('tx_gridelements_backend_layouts', 'title', $this->languageService->sL($layoutSetup['title']), array(
				'title' => $this->languageService->sL($layoutSetup['title']),
				'description' => $this->languageService->sL($layoutSetup['description'])
			    )) . '</h4>';
		}
		$grid .= '<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%" class="t3-page-columns t3-grid-table">';
		// add colgroups
		$colCount = 0;
		$rowCount = 0;
		if (isset($layoutSetup['config'])) {
		    if (isset($layoutSetup['config']['colCount'])) {
			$colCount = (int) $layoutSetup['config']['colCount'];
		    }
		    if (isset($layoutSetup['config']['rowCount'])) {
			$rowCount = (int) $layoutSetup['config']['rowCount'];
		    }
		}
		$grid .= '<colgroup>';
		for ($i = 0; $i < $colCount; $i++) {
		    $grid .= '<col style="width:' . (100 / $colCount) . '%"></col>';
		}
		$grid .= '</colgroup>';
		// cycle through rows
		for ($layoutRow = 1; $layoutRow <= $rowCount; $layoutRow++) {
		    $rowConfig = $layoutSetup['config']['rows.'][$layoutRow . '.'];
		    if (!isset($rowConfig)) {
			continue;
		    }
		    $grid .= '<tr>';
		    for ($col = 1; $col <= $colCount; $col++) {
			$columnConfig = $rowConfig['columns.'][$col . '.'];
			if (!isset($columnConfig)) {
			    continue;
			}
			// which column should be displayed inside this cell
			$columnKey = isset($columnConfig['colPos']) && $columnConfig['colPos'] !== '' ? (int) $columnConfig['colPos'] : 32768;
			// allowed CTypes
			$allowedContentTypes = array();
			if (!empty($columnConfig['allowed'])) {
			    $allowedContentTypes = array_flip(GeneralUtility::trimExplode(',', $columnConfig['allowed']));
			    if (!isset($allowedContentTypes['*'])) {
				foreach ($allowedContentTypes as $key => &$ctype) {
				    $ctype = 't3-allow-' . $key;
				}
			    } else {
				unset($allowedContentTypes);
			    }
			}
			if (!empty($columnConfig['allowedGridTypes'])) {
			    $allowedGridTypes = array_flip(GeneralUtility::trimExplode(',', $columnConfig['allowedGridTypes']));
			    if (!isset($allowedGridTypes['*']) && !empty($allowedGridTypes)) {
				foreach ($allowedGridTypes as $gridType => &$gridTypeClass) {
				    $gridTypeClass = 't3-allow-gridtype t3-allow-gridtype-' . $gridType;
				}
				$allowedContentTypes['gridelements_pi1'] = 't3-allow-gridelements_pi1';
			    } else {
				if (!empty($allowedContentTypes)) {
				    $allowedContentTypes['gridelements_pi1'] = 't3-allow-gridelements_pi1';
				}
				unset($allowedGridTypes);
			    }
			}
			// render the grid cell
			$colSpan = (int) $columnConfig['colspan'];
			$rowSpan = (int) $columnConfig['rowspan'];
			$expanded = $this->helper->getBackendUser()->uc['moduleData']['page']['gridelementsCollapsedColumns'][$row['uid'] . '_' . $columnKey] ? 'collapsed' : 'expanded';
			$grid .= '<td valign="top"' . (isset($columnConfig['colspan']) ? ' colspan="' . $colSpan . '"' : '') .
				(isset($columnConfig['rowspan']) ? ' rowspan="' . $rowSpan . '"' : '') .
				'data-colpos="' . $columnKey . '" data-columnkey="' . $specificIds['uid'] . '_' . $columnKey . '"
					class="t3-grid-cell t3js-page-column t3-page-column t3-page-column-' . $columnKey .
				(!isset($columnConfig['colPos']) || $columnConfig['colPos'] === '' ? ' t3-grid-cell-unassigned' : '') .
				(isset($columnConfig['colspan']) && $columnConfig['colPos'] !== '' ? ' t3-grid-cell-width' . $colSpan : '') .
				(isset($columnConfig['rowspan']) && $columnConfig['colPos'] !== '' ? ' t3-grid-cell-height' . $rowSpan : '') . ' ' .
				($layoutSetup['horizontal'] ? ' t3-grid-cell-horizontal' : '') . (!empty($allowedContentTypes) ? ' ' .
				join(' ', $allowedContentTypes) : ' t3-allow-all') . (!empty($allowedGridTypes) ? ' ' .
				join(' ', $allowedGridTypes) : '') . ' ' . $expanded . '" data-state="' . $expanded . '">';

			$grid .= ($this->helper->getBackendUser()->uc['hideColumnHeaders'] ? '' : $head[$columnKey]) . $gridContent[$columnKey];
			$grid .= '</td>';
		    }
		    $grid .= '</tr>';
		}
		$grid .= '</table></div>';
		break;
	}

	return $grid;
    }

    private function parseGridHeader (){

    }

}
