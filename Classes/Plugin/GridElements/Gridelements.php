<?php
namespace T3kit\themeT3kit\Plugin\GridElements;

/***************************************************************
 *  Copyright notice
 *  (c) 2011 Jo Hasenau <info@cybercraft.de>
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
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Plugin 'Grid Element' for the 'gridelements' extension.
 *
 * @author Jo Hasenau <info@cybercraft.de>
 * @package TYPO3
 * @subpackage tx_gridelements
 */
//class Gridelements extends \GridElementsTeam\Gridelements\Plugin\Gridelements
class Gridelements extends ContentObjectRenderer
{

    /**
     * @var ContentObjectRenderer
     */
    protected $cObj;

    /**
     * @var PageRenderer
     */
    protected $pageRenderer;

    /**
     * @var LanguageService
     */
    protected $languageService;

    public $prefixId = 'Gridelements'; // Same as class name
    public $scriptRelPath = 'Classes/Plugin/Gridelements.php'; // Path to this script relative to the extension dir.
    public $extKey = 'gridelements'; // The extension key.

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

    /**
     * fetches all available children for a certain grid container
     *
     * @param int $element : The uid of the grid container
     * @param string $csvColumns : A list of available column IDs
     *
     * @return array $children: The child elements of this grid container
     */
    public function getChildren($element = 0, $csvColumns = '')
    {

        if ($element && $csvColumns !== '') {

            $where = '(tx_gridelements_container = ' . $element . $this->cObj->enableFields('tt_content') . ' AND colPos != -2
				AND pid > 0
				AND tx_gridelements_columns IN (' . $csvColumns . ')
				AND sys_language_uid IN (-1,0)
			)';

            if ($GLOBALS['TSFE']->sys_language_content > 0) {
                if ($GLOBALS['TSFE']->sys_language_contentOL) {
                    if (isset($this->cObj->data['_LOCALIZED_UID']) && $this->cObj->data['_LOCALIZED_UID'] !== 0) {
                        $element = (int)$this->cObj->data['_LOCALIZED_UID'];
                    }

                    if ($element) {
                        $where .= '  OR (
						tx_gridelements_container = ' . $element . $this->cObj->enableFields('tt_content') . ' AND sys_language_uid IN (-1,' . $GLOBALS['TSFE']->sys_language_content . ')
							AND l18n_parent = 0
					)';
                    }
                } else {
                    if ($element) {
                        $where .= '  OR (
						tx_gridelements_container = ' . (int)$element . $this->cObj->enableFields('tt_content') . ' AND sys_language_uid IN (-1,' . $GLOBALS['TSFE']->sys_language_content . ')
					)';
                    }
                }
            }

            $res = $this->getDatabaseConnection()->exec_SELECTquery('*', 'tt_content', $where, '', 'sorting ASC');

            if (!$this->getDatabaseConnection()->sql_error()) {
                $this->cObj->data['tx_gridelements_view_children'] = array();
                while ($child = $this->getDatabaseConnection()->sql_fetch_assoc($res)) {
                    // Versioning preview:
                    $sorting = $child['sorting'];
                    $GLOBALS['TSFE']->sys_page->versionOL('tt_content', $child, true);

                    // Language overlay:
                    if (is_array($child)) {
                        $child['sorting'] = $sorting;
                        if ($GLOBALS['TSFE']->sys_language_contentOL) {
                            $child = $GLOBALS['TSFE']->sys_page->getRecordOverlay('tt_content', $child,
                                $GLOBALS['TSFE']->sys_language_content, $GLOBALS['TSFE']->sys_language_contentOL);
                        }
                        if ($child !== false) {
                            $this->cObj->data['tx_gridelements_view_children'][] = $child;
                            unset($child);
                        }
                    }
                }

                $compareFunction = function ($child_a, $child_b) {
                    if ($child_a['sorting'] > $child_b['sorting']) {
                        return 1;
                    } elseif ($child_a['sorting'] === $child_b['sorting']) {
                        return 0;
                    } else {
                        return -1;
                    }
                };

                usort($this->cObj->data['tx_gridelements_view_children'], $compareFunction);

                $this->getDatabaseConnection()->sql_free_result($res);
            }
        }
    }

    /**
     * fetches values from the grid flexform and assigns them to virtual fields in the data array
     *
     * @return void
     */
    public function getPluginFlexFormData()
    {
        $pluginFlexForm = $this->cObj->data['pi_flexform'];

        if (is_array($pluginFlexForm) && is_array($pluginFlexForm['data'])) {
            foreach ($pluginFlexForm['data'] as $sheet => $data) {
                if (is_array($data)) {
                    foreach ((array)$data as $language => $value) {
                        if (is_array($value)) {
                            foreach ((array)$value as $key => $val) {
                                $this->cObj->data['flexform_' . $key] = $this->getFlexFormValue($pluginFlexForm, $key,
                                    $sheet);
                            }
                        }
                    }
                }
            }
        }

        unset($pluginFlexForm);
    }

    /**
     * renders the children of the grid container and
     * puts them into their respective columns
     *
     * @param array $typoScriptSetup
     * @param array $sortColumns : An Array of column positions within the grid container in the order they got in the grid setup
     */
    public function renderChildrenIntoParentColumns($typoScriptSetup = array(), $sortColumns = array())
    {

        // first we have to make a backup copy of the original data array
        // and we have to modify the depth counter to avoid stopping too early

        $currentParentGrid = $this->copyCurrentParentGrid();
        $columns = $this->getUsedColumns($sortColumns);
        $parentGridData = $this->getParentGridData($currentParentGrid['data']);
        $parentGridData['tx_gridelements_view_columns'] = $columns;

        $counter = !empty($this->cObj->data['tx_gridelements_view_children']);
        $parentRecordNumbers = array();
        $GLOBALS['TSFE']->cObjectDepthCounter += $counter;

        // each of the children will now be rendered separately and the output will be added to it's particular column
        $rawColumns = array();
        if (!empty($this->cObj->data['tx_gridelements_view_children'])) {
            foreach ($this->cObj->data['tx_gridelements_view_children'] as $child) {
                $rawColumns[$child['tx_gridelements_columns']][] = $child;
                $renderedChild = $child;
                $this->renderChildIntoParentColumn($columns, $renderedChild, $parentGridData, $parentRecordNumbers,
                    $typoScriptSetup);
                $currentParentGrid['data']['tx_gridelements_view_child_' . $child['uid']] = $renderedChild;
                unset($renderedChild);
            }
            $currentParentGrid['data']['tx_gridelements_view_raw_columns'] = $rawColumns;
        }

        // now we can reset the depth counter and the data array so that the element will behave just as usual
        // it will just contain the additional tx_gridelements_view section with the prerendered elements
        // it is important to do this before any stdWrap functions are applied to the grid container
        // since they will depend on the original data
        $GLOBALS['TSFE']->cObjectDepthCounter -= $counter;

        $this->resetCurrentParentGrid($currentParentGrid);
        if (!empty($sortColumns)) {
            $this->cObj->data['tx_gridelements_view_columns'] = array();
            foreach ($sortColumns as $sortKey) {
                $sortKey = trim($sortKey);
                if (isset($parentGridData['tx_gridelements_view_columns'][$sortKey])) {
                    $this->cObj->data['tx_gridelements_view_columns'][$sortKey] = $parentGridData['tx_gridelements_view_columns'][$sortKey];
                }
            }
        }
        unset($parentGridData);
        unset($currentParentGrid);

    }

    /**
     * @param array $sortColumns
     *
     * @return array
     */
    public function getUsedColumns($sortColumns = array())
    {
        $columns = array();

        // we need the array values as keys
        if (!empty($sortColumns)) {
            foreach ($sortColumns as $column_number) {
                $columns[$column_number] = '';
            }
        }

        unset($sortColumns);

        return $columns;
    }

    /**
     * @return array
     */
    public function copyCurrentParentGrid()
    {

        $data['record'] = $this->cObj->currentRecord;
        $data['data'] = $this->cObj->data;
        $data['parentRecordNumber'] = $this->cObj->parentRecordNumber;

        return $data;

    }

    /**
     * @param $data
     *
     * @return array
     */
    public function resetCurrentParentGrid($data = array())
    {

        $this->cObj->currentRecord = $data['record'];
        $this->cObj->data = $data['data'];

        $this->cObj->parentRecordNumber = $data['parentRecordNumber'];

        unset($data);
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function getParentGridData($data = array())
    {

        // filter out existing superfluous keys to reduce memory load
        // String comparisons are way too expensive, so we go for unset within some loops
        if (!empty($data['tx_gridelements_view_children'])) {
            foreach ($data['tx_gridelements_view_children'] as $child) {
                unset($data['tx_gridelements_view_child_' . $child['uid']]);
            }
        }
        if (!empty($data['tx_gridelements_view_columns'])) {
            foreach ($data['tx_gridelements_view_columns'] as $column => $content) {
                unset($data['tx_gridelements_view_column_' . $column]);
            }
        }

        unset($data['tx_gridelements_view_children']);
        unset($data['tx_gridelements_view_columns']);

        // Set parent grid data for the first time
        $parentGridData = $this->setParentGridData($data);

        // Now we can remove any parentgrid_parentgrid_ keys
        if (!empty($parentGridData)) {
            foreach ($parentGridData as $key => $value) {
                unset($data[$key]);
            }
        }

        // Set parentgrid data for the first time
        $parentGridData = $this->setParentGridData($data);

        unset($data);

        return $parentGridData;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function setParentGridData($data = array())
    {

        $parentGridData = array();
        foreach ($data as $key => $value) {
            $parentGridData['parentgrid_' . $key] = $value;
        }

        unset($data);

        return $parentGridData;
    }

    /**
     * renders the columns of the grid container and returns the actual content
     *
     * @param $columns
     * @param array $child
     * @param array $parentGridData
     * @param array $parentRecordNumbers
     * @param array $typoScriptSetup
     *
     * @return void
     */
    public function renderChildIntoParentColumn(
        $columns,
        &$child,
        &$parentGridData,
        &$parentRecordNumbers,
        $typoScriptSetup = array()
    ) {

        $column_number = (int)$child['tx_gridelements_columns'];
        $columnKey = $column_number . '.';

        if (!isset($typoScriptSetup['columns.'][$columnKey])) {
            $columnSetupKey = 'default.';
        } else {
            $columnSetupKey = $columnKey;
        }

        if ($child['uid'] > 0) {

            // update SYS_LASTCHANGED if necessary

            $this->cObj->lastChanged($child['tstamp']);

            $this->cObj->start(array_merge($child, $parentGridData), 'tt_content');

            $parentRecordNumbers[$columnKey]++;
            $this->cObj->parentRecordNumber = $parentRecordNumbers[$columnKey];

            // we render each child into the children key to provide them prerendered for usage with your own templating
            $child = $this->cObj->cObjGetSingle($typoScriptSetup['columns.'][$columnSetupKey]['renderObj'],
                $typoScriptSetup['columns.'][$columnSetupKey]['renderObj.']);
            // then we assign the prerendered child to the appropriate column
            if (isset($columns[$column_number])) {
                $parentGridData['tx_gridelements_view_columns'][$column_number] .= $child;
            }
            unset($columns);
        }

        unset($typoScriptSetup);
    }

    /**
     * renders the columns of the grid container and returns the actual content
     *
     * @param array $setup : The adjusted setup of the grid container
     *
     * @return array $content: The raw HTML output of the grid container before stdWrap functions will be applied to it
     */
    public function renderColumnsIntoParentGrid($setup = array())
    {

        $content = '';

        if (!empty($this->cObj->data['tx_gridelements_view_columns'])) {
            foreach ($this->cObj->data['tx_gridelements_view_columns'] as $column => $columnContent) {
                // if there are any columns available, we have to determine the corresponding TS setup
                // and if there is none we are going to use the default setup
                $tempSetup = isset($setup['columns.'][$column . '.']) ? $setup['columns.'][$column . '.'] : $setup['columns.']['default.'];
                // now we just have to unset the renderObj
                // before applying the rest of the keys via the usual stdWrap operations
                unset($tempSetup['renderObj']);
                unset($tempSetup['renderObj.']);

                // we render each column into the column key to provide them prerendered for usage  with your own templating
                $this->cObj->data['tx_gridelements_view_column_' . $column] = !empty($tempSetup) ? $this->cObj->stdWrap($columnContent,
                    $tempSetup) : $columnContent;
                $content .= $this->cObj->data['tx_gridelements_view_column_' . $column];
            }
        }

        return $content;

    }

    /**
     * renders a recursive pidList to reference content from a list of pages
     */
    public function user_getTreeList()
    {
        $GLOBALS['TSFE']->register['pidInList'] = trim(($this->cObj->data['uid'] . ',' . ($GLOBALS['TSFE']->register['tt_content_shortcut_recursive'] ? $this->cObj->getTreeList($this->cObj->data['uid'],
                $GLOBALS['TSFE']->register['tt_content_shortcut_recursive']) : '')), ',');
    }

    /**
     * Converts $this->cObj->data['pi_flexform'] from XML string to flexForm array.
     *
     * @param string $field Field name to convert
     *
     * @return void
     */
    public function initPluginFlexForm($field = 'pi_flexform')
    {
        // Converting flexform data into array:
        if (!is_array($this->cObj->data[$field]) && $this->cObj->data[$field]) {
            $this->cObj->data[$field] = GeneralUtility::xml2array($this->cObj->data[$field]);
            if (!is_array($this->cObj->data[$field])) {
                $this->cObj->data[$field] = array();
            }
        }
    }

    /**
     * Return value from somewhere inside a FlexForm structure
     *
     * @param array $T3FlexForm_array FlexForm data
     * @param string $fieldName Field name to extract. Can be given like "test/el/2/test/el/field_templateObject" where each part will dig a level deeper in the FlexForm data.
     * @param string $sheet Sheet pointer, eg. "sDEF"
     * @param string $language Language pointer, eg. "lDEF"
     * @param string $value Value pointer, eg. "vDEF"
     *
     * @return string The content.
     */
    public function getFlexFormValue(
        $T3FlexForm_array,
        $fieldName,
        $sheet = 'sDEF',
        $language = 'lDEF',
        $value = 'vDEF'
    ) {
        $sheetArray = is_array($T3FlexForm_array) ? $T3FlexForm_array['data'][$sheet][$language] : '';
        if (is_array($sheetArray)) {
            return $this->getFlexFormValueFromSheetArray($sheetArray, explode('/', $fieldName), $value);
        } else {
            return '';
        }
    }

    /**
     * Returns part of $sheetArray pointed to by the keys in $fieldNameArray
     *
     * @param array $sheetArray Multidimensional array, typically FlexForm contents
     * @param array $fieldNameArr Array where each value points to a key in the FlexForms content - the input array will have the value returned pointed to by these keys. All integer keys will not take their integer counterparts, but rather traverse the current position in the array an return element number X (whether this is right behavior is not settled yet...)
     * @param string $value Value for outermost key, typ. "vDEF" depending on language.
     *
     * @return mixed The value, typ. string.
     * @access private
     * @see pi_getFlexFormValue()
     */
    public function getFlexFormValueFromSheetArray($sheetArray, $fieldNameArr, $value)
    {

        $tempArr = $sheetArray;
        foreach ($fieldNameArr as $k => $v) {
            $checkedValue = MathUtility::canBeInterpretedAsInteger($v);
            if ($checkedValue) {
                if (is_array($tempArr)) {
                    $c = 0;
                    foreach ($tempArr as $values) {
                        if ($c == $v) {
                            $tempArr = $values;
                            break;
                        }
                        $c++;
                    }
                }
            } else {
                $tempArr = $tempArr[$v];
            }
        }
        if (is_array($tempArr)) {
            if (is_array($tempArr['el'])) {
                $out = $this->getFlexformSectionsRecursively($tempArr['el'], $value);
            } else {
                $out = $tempArr[$value];
            }
        } else {
            $out = $tempArr;
        }

        return $out;
    }

    /**
     * @param $dataArr
     * @param string $valueKey
     *
     * @return array
     */
    public function getFlexformSectionsRecursively($dataArr, $valueKey = 'vDEF')
    {
        $out = array();
        foreach ($dataArr as $k => $el) {
            if (is_array($el) && is_array($el['el'])) {
                $out[$k] = $this->getFlexformSectionsRecursively($el['el']);
            } elseif (is_array($el) && is_array($el['data']['el'])) {
                $out[] = $this->getFlexformSectionsRecursively($el['data']['el']);
            } else {
                if (isset($el[$valueKey])) {
                    $out[$k] = $el[$valueKey];
                }
            }
        }

        return $out;
    }

    /**
     * @return DatabaseConnection
     */
    public function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

    /**
     * @return PageRenderer
     */
    public function getPageRenderer()
    {
        if ($this->pageRenderer === null) {
            $this->pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        }

        return $this->pageRenderer;
    }

}