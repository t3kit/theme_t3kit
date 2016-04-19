<?php
namespace T3kit\themeT3kit\Plugin\GridElements;

/***************************************************************
 *  Copyright notice
 *  (c) 2016 Taras Drowalyuk <taras@pixelant.se>
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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Plugin 'Grid Element' for the 'gridelements' extension.
 *
 * @author Taras Drowalyuk <taras@pixelant.se>
 *
 */
class Gridelements extends \GridElementsTeam\Gridelements\Plugin\Gridelements
{

    /**
     * The main method of the PlugIn
     *
     * @param string $content : The PlugIn content
     * @param array $conf : The PlugIn configuration
     *
     * @return string The content that is displayed on the website
     */
    public function main($content = '', $conf = array())
    {
        // first we have to take care of possible flexform values containing additional information
        // that is not available via DB relations. It will be added as "virtual" key to the existing data Array
        // so that you can easily get the values with TypoScript
        $this->initPluginFlexForm();
        $this->getPluginFlexFormData();

        // now we have to find the children of this grid container regardless of their column
        // so we can get them within a single DB query instead of doing a query per column
        // but we will only fetch those columns that are used by the current grid layout
        if ($GLOBALS['TSFE']->sys_language_contentOL && $this->cObj->data['l18n_parent']) {
            $element = $this->cObj->data['l18n_parent'];
        } else {
            $element = $this->cObj->data['uid'];
        }

        $layout = $this->cObj->data['tx_gridelements_backend_layout'];

        /** @var LayoutSetup $layoutSetup */
        $layoutSetup = GeneralUtility::makeInstance(LayoutSetup::class);
        $layoutSetup->init($this->cObj->data['pid'], $conf);

        $availableColumns = $layoutSetup->getLayoutColumns($layout);
        $csvColumns = str_replace('-2,-1,', '', $availableColumns['CSV']);

	// change variable $csvColumns to get all columns for our element
	// this columns are saved at DB,but we haven't properly TS configuration
	// so we will 'build it on fly'
	$t3kitValue = $layoutSetup->getLayoutSetup($layout)['config']['t3kitValue'];
	if ($t3kitValue == 1 && $this->cObj->data['tx_gridelements_children'] > 0){
	    $valName = $layoutSetup->getLayoutSetup($layout)['config']['rowsFieldName'];
	    $spVal = $this->cObj->data['pi_flexform']['data']['columns']['lDEF'][$valName]['vDEF'];
	    $csvColumns = "";
	    for($i=0; $i < intval($spVal); $i++){
		$csvColumns .= $i.",";
	    }
	    $csvColumns = substr($csvColumns, 0, -1);
	}

        $this->getChildren($element, $csvColumns);

        // and we have to determine the frontend setup related to the backend layout record which is assigned to this container
        $typoScriptSetup = $layoutSetup->getTypoScriptSetup($layout);

        // we need a sorting columns array to make sure that the columns are rendered in the order
        // that they have been created in the grid wizard but still be able to get all children
        // within just one SELECT query
        $sortColumns = explode(',', $csvColumns);

        $this->renderChildrenIntoParentColumns($typoScriptSetup, $sortColumns);
        unset($children);
        unset($sortColumns);

        // if there are any columns available, we can go on with the render process
        if (!empty($this->cObj->data['tx_gridelements_view_columns'])) {
            $content = $this->renderColumnsIntoParentGrid($typoScriptSetup);
        }
        unset($availableColumns);
        unset($csvColumns);

        if (isset($typoScriptSetup['jsFooterInline']) || isset($typoScriptSetup['jsFooterInline.'])) {
            $jsFooterInline = isset($typoScriptSetup['jsFooterInline.']) ? $this->cObj->stdWrap($typoScriptSetup['jsFooterInline'],
                $typoScriptSetup['jsFooterInline.']) : $typoScriptSetup['jsFooterInline'];

            $this->getPageRenderer()->addJsFooterInlineCode('gridelements' . $element, $jsFooterInline);
            unset($typoScriptSetup['jsFooterInline']);
            unset($typoScriptSetup['jsFooterInline.']);
        }
        // finally we can unset the columns setup as well and apply stdWrap operations to the overall result
        // before returning the content
        unset($typoScriptSetup['columns.']);

	// here we will add special function for parsing data for out element
	if ($t3kitValue == 1 && $this->cObj->data['tx_gridelements_children'] > 0){
	    $this->parseDataForT3kitElement($layoutSetup);
	}

        $content = !empty($typoScriptSetup) ? $this->cObj->stdWrap($content, $typoScriptSetup) : $content;

        return $content;
    }

    /**
     * create new element 'tx_gridelements_t3kit_values' at data array,
     * srecial for new t3kit elements
     *
     * @param \GridElementsTeam\Gridelements\Backend\LayoutSetup $layoutSetup
     */
    private function parseDataForT3kitElement ($layoutSetup){
	$sortedColumns = $this->cObj->data['tx_gridelements_view_raw_columns'];
	ksort($sortedColumns);
	$newArray = array();

	// get label from TS
	$labelTS = $layoutSetup->getLayoutSetup($this->cObj->data['tx_gridelements_backend_layout'])['config']['rowsDefaultConfig.']['label'];
	// get labels from flexform
	$flexFormData = $this->cObj->data['pi_flexform']['data']['columns']['lDEF'];

	foreach ($sortedColumns as $col => $data){
	    $header = "";
	    if (isset($flexFormData['tabHeader_'.($col + 1)]['vDEF']) &&
		    !empty($flexFormData['tabHeader_'.($col + 1)]['vDEF'])){

		$header = $flexFormData['tabHeader_'.($col + 1)]['vDEF'];

	    } elseif ( !empty ($labelTS)){
		$header = $GLOBALS['LANG']->sL($labelTS . ($col + 1) );
	    }

	    $newArray[] = array ("column" => $col,
		"uid" => $data[0]['uid'],
		"header" => $header
		);
	}
	$this->cObj->data['tx_gridelements_t3kit_values'] = $newArray;
    }
}