<?php
namespace T3kit\themeT3kit\UserFunction;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Pixelant AB
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use \TYPO3\CMS\Core\Utility\PathUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use \TYPO3\CMS\Backend\Utility\BackendUtility;
use \TYPO3\CMS\Core\Utility\StringUtility;

/**
 * Renders
 *
 * @package t3kitEztensionTools
 * @subpackage UserFunction
 */
class IconFontSelector
{

    /**
     * Array to store information about the css file from parameter
     * @var array
     */
    protected $cssFileInformation;

    /**
     * Array to store what items to output
     * @var array
     */
    protected $items;

    /**
     * String FontPrefix
     * @var string
     */
    protected $fontPrefix = 'icon-';

    /**
     * String fontSize
     * @var string
     */
    protected $fontSize = '20px';

    /**
     * String selectedIconClass
     * @var string
     */
    protected $selectedIconClass = 'text-primary';

    /**
     * Filename of json file when isIcoMoon configuration is TRUE
     * @var string
     */
    protected $icoMoonSelectionJsonFileName = 'selection.json';

    /**
     * @param array $PA
     * @param TYPO3\CMS\Backend\Form\Element\UserElement $pObj
     * @return string
     */
    public function renderField(array $PA, \TYPO3\CMS\Backend\Form\Element\UserElement $pObj)
    {

        $content = '';

        try {

            $this->overridePAByPageTsConfig($PA);

            $this->initialize($PA);

            $this->addStylesAndJavascriptToForm();

            $content = $this->getSingleField_typeSelect_single($PA['table'], $PA['field'], $PA['row'], $PA, $PA['fieldConf']['config'], $this->items, 'NO MATCH!');

        } catch (\Exception $e) {

            $content = $this->getExceptionOutput($e);

        }

        return $content;
    }

    /**
     * Initialize and check configuration
     * @param array $PA
     * @return void
     */
    private function initialize(array $PA)
    {

        if (!isset($PA['fieldConf']['config']['cssFile'])) {
            throw new \Exception(LocalizationUtility::translate('iconFontSelector.exception.missingConfigCssFile', 'theme_t3kit'));
        }
        $this->collectCssFileInformation($PA['fieldConf']['config']['cssFile']);

        if (isset($PA['fieldConf']['config']['fontPrefix']) && strlen(trim($PA['fieldConf']['config']['isIcoMoon'])) > 0) {
            $this->fontPrefix = $PA['fieldConf']['config']['fontPrefix'];
        }

        if (isset($PA['fieldConf']['config']['fontSize']) && strlen(trim($PA['fieldConf']['config']['fontSize'])) > 0) {
            $this->fontSize = $PA['fieldConf']['config']['fontSize'];
        }

        if (isset($PA['fieldConf']['config']['tableColumnsPerRow']) && strlen(trim($PA['fieldConf']['config']['tableColumnsPerRow'])) > 0) {
            $this->tableColumnsPerRow = $PA['fieldConf']['config']['tableColumnsPerRow'];
        }
        // Include items from TCA config (will be overwritten if icon exists in font-icon)
        if (isset($PA['fieldConf']['config']['items']) && count($PA['fieldConf']['config']['items']) > 0) {
            $this->items = $PA['fieldConf']['config']['items'];
        }

        if (isset($PA['fieldConf']['config']['isIcoMoon']) && $PA['fieldConf']['config']['isIcoMoon']) {
            // Try to parse items from selection.json file
            $this->populateItemsFromIcoMoonJson();
        }
    }

    /**
     * Collects information about the css file
     * @param  string $filename Filename
     * @return void
     */
    private function collectCssFileInformation($filename)
    {

        $this->cssFileInformation = $this->getFileInformation($filename);
        $this->cssFileInformation['referencedFiles'] = $this->getListOfFilesFromCssUrls($this->cssFileInformation['absFileName']);

        if (is_array($this->cssFileInformation['referencedFiles']) && count($this->cssFileInformation['referencedFiles']) > 0) {
            foreach ($this->cssFileInformation['referencedFiles'] as $key => $value) {
                try {
                    $fullFilename = rtrim($this->cssFileInformation['dirname'], '/') . '/' . $value;
                    $fileInformation = $this->getFileInformation($fullFilename);
                } catch (\Exception $e) {
                    $message = LocalizationUtility::translate('iconFontSelector.exception.iconFileMissing', 'theme_t3kit');
                    $message .= ' (' . rtrim($this->cssFileInformation['dirname'], '/') . '/' . $value . ')';
                    throw new \Exception($message, $e->getCode(), $e);
                }
            }
        }
    }

    /**
     * Try to populate items from json file (like IcoMoon selection.json)
     * @return void
     */
    private function populateItemsFromIcoMoonJson()
    {
        try {
            $filename = rtrim($this->cssFileInformation['dirname'], '/') . '/' . $this->icoMoonSelectionJsonFileName;
            $fileInformation = $this->getFileInformation($filename);
            $jsonData = json_decode(GeneralUtility::getUrl($fileInformation['absFileName']), true);
            $classSelector = '';
            if (is_array($jsonData['icons']) && count($jsonData['icons']) > 0) {
                if (isset($jsonData['preferences']['fontPref']['prefix']) && $jsonData['metadata']['name']) {
                    if (isset($jsonData['preferences']['fontPref']['classSelector'])) {
                        $classSelector = ltrim($jsonData['preferences']['fontPref']['classSelector'], '.') . ' ';
                    }
                    $this->fontPrefix = $classSelector . $jsonData['preferences']['fontPref']['prefix'];
                    foreach ($jsonData['icons'] as $key => $icon) {
                        $title = preg_replace("/([[:alpha:]])([[:digit:]])/", "\\1 \\2", $icon['properties']['name']);
                        $this->items[] = array(
                            '0' => ucwords(str_replace(array('-', '_'), ' ', $title)),
                            '1' => $icon['properties']['name'],
                            '2' => $icon['properties']['name'],
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            $message = LocalizationUtility::translate('iconFontSelector.exception.populateItemsFromIcoMoonJson', 'theme_t3kit');
            $message .= ' (' . rtrim($this->cssFileInformation['dirname'], '/') . '/' . $this->icoMoonSelectionJsonFileName . ')';
            throw new \Exception($message, $e->getCode(), $e);
        }
    }

    /**
     * Collects information about the file
     * @param  string $filename Filename
     * @return array            Array of collected information
     */
    private function getFileInformation($filename, $throwExeptions = true)
    {
        $fileProperties = array();

        $fileProperties['filename'] = $filename;
        if (strlen(trim($filename)) == 0 && $throwExeptions) {
            throw new \Exception(LocalizationUtility::translate('iconFontSelector.exception.missingFilename', 'theme_t3kit'), 20);
        }
        $fileProperties['absFileName'] = GeneralUtility::getFileAbsFileName($filename);
        $fileProperties['fileExists'] = file_exists($fileProperties['absFileName']);
        if (!$fileProperties['fileExists'] && $throwExeptions) {
            throw new \Exception(LocalizationUtility::translate('iconFontSelector.exception.fileExists', 'theme_t3kit') . ' (' . $filename . ')', 21);
        }
        $pathInfo = PathUtility::pathinfo($fileProperties['absFileName']);
        $fileProperties['dirname'] = $pathInfo['dirname'];
        $fileProperties['basename'] = $pathInfo['basename'];
        $fileProperties['extension'] = $pathInfo['extension'];
        $fileProperties['filename'] = $pathInfo['filename'];
        $fileProperties['isAllowedAbsPath'] = GeneralUtility::isAllowedAbsPath($fileProperties['absFileName']);
        if (!$fileProperties['isAllowedAbsPath'] && $throwExeptions) {
            throw new \Exception(LocalizationUtility::translate('iconFontSelector.exception.isAllowedAbsPath', 'theme_t3kit'), 22);
        }
        $fileProperties['relativePath'] = PathUtility::getRelativePathTo($fileProperties['dirname']);
        return $fileProperties;
    }

    private function getListOfFilesFromCssUrls($absFileName)
    {

        $returnFileNames = array();

        if (file_exists($absFileName)) {
            $fileContent = GeneralUtility::getUrl($absFileName);
            $matches = false;
            // preg_match_all('#(url\(.*/)#', $fileContent, $matches);
            preg_match_all('/url\(([\s])?([\"|P<name>\'])?(.*?)([\"|\'])?([\s])?\)/i', $fileContent, $matches, PREG_PATTERN_ORDER);
            if (is_array($matches) && count($matches[3]) > 0) {
                foreach ($matches[3] as $key => $value) {
                    list($fileName) = GeneralUtility::trimExplode('?', $value);
                    $returnFileNames[] = $fileName;
                }
            }
        }
        return $returnFileNames;
    }

    /**
     * Adds and css and javascript to BE form.
     *
     * @return void
     */
    protected function addStylesAndJavascriptToForm()
    {
        $extCssRel = ExtensionManagementUtility::extRelPath('theme_t3kit') . 'Resources/Public/css/BE/iconFontSelector.css';
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        $pageRenderer->addCssFile(rtrim($this->cssFileInformation['relativePath'], '/') . '/' . $this->cssFileInformation['basename']);
        $pageRenderer->addCssFile($extCssRel);
    }

    /**
     * Generates output for exceptions
     * @param  \Exception $e The exception
     * @return srting        HTML to render
     */
    protected function getExceptionOutput(\Exception $e)
    {
        $title = LocalizationUtility::translate('iconFontSelector.exception.title', 'theme_t3kit');
        $message = $e->getMessage();
        $content = '<div class="alert alert-danger">
            <div class="media">
                <div class="media-left">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-times fa-stack-1x"></i>
                    </span>
                </div>
                <div class="media-body">
                    <h4 class="alert-title">' . $title . '</h4>
                    <div class="alert-message">' . $message . '</div>
                </div>
            </div>
        </div>';
        return $content;
    }

    /**
     * Creates a single-selector box
     *
     * @param string $table See getSingleField_typeSelect()
     * @param string $field See getSingleField_typeSelect()
     * @param array $row See getSingleField_typeSelect()
     * @param array $parameterArray See getSingleField_typeSelect()
     * @param array $config (Redundant) content of $PA['fieldConf']['config'] (for convenience)
     * @param array $selectItems Items available for selection
     * @param string $noMatchingLabel Label for no-matching-value
     * @return string The HTML code for the item
     */
    protected function getSingleField_typeSelect_single($table, $field, $row, $parameterArray, $config, $selectItems, $noMatchingLabel)
    {
        // Initialization:
        $selectId = StringUtility::getUniqueId('tceforms-select-');
        $selectedIndex = 0;
        $selectedIcon = '';
        $selectedValueFound = FALSE;
        $onlySelectedIconShown = FALSE;
        $size = (int)$config['size'];

        // Style set on <select/>
        $out = '';
        $options = '';
        $disabled = FALSE;
        if ($config['readOnly']) {
            $disabled = TRUE;
            $onlySelectedIconShown = TRUE;
        }

        // Icon configuration:
        if ($config['suppress_icons'] === 'IF_VALUE_FALSE') {
            $suppressIcons = empty($parameterArray['itemFormElValue']);
        } elseif ($config['suppress_icons'] === 'ONLY_SELECTED') {
            $suppressIcons = FALSE;
            $onlySelectedIconShown = TRUE;
        } elseif ($config['suppress_icons']) {
            $suppressIcons = TRUE;
        } else {
            $suppressIcons = FALSE;
        }

        // Prepare groups
        $selectItemCounter = 0;
        $selectItemGroupCount = 0;
        $selectItemGroups = array();
        $selectIcons = array();
        $selectedValue = '';
        if (!empty($parameterArray['itemFormElValue'])) {
            $selectedValue = (string)$parameterArray['itemFormElValue'];
        }

        foreach ($selectItems as $item) {
            if ($item[1] === '--div--') {
                // IS OPTGROUP
                if ($selectItemCounter !== 0) {
                    $selectItemGroupCount++;
                }
                $selectItemGroups[$selectItemGroupCount]['header'] = array(
                    'title' => $item[0],
                    'icon' => (!empty($item[2]) ? FormEngineUtility::getIconHtml($item[2]) : ''),
                );
            } else {
                // IS ITEM
                $title = htmlspecialchars($item['0'], ENT_COMPAT, 'UTF-8', FALSE);
                $selected = $selectedValue === (string)$item[1];
                if ($selected) {
                    $selectedIndex = $selectItemCounter;
                    $selectedIcon = $icon;
                    $selectedValueFound = TRUE;
                }
                $icon = !empty($item[2]) ? $this->getIconHtml($item[2], $selected) : '';
                $selectItemGroups[$selectItemGroupCount]['items'][] = array(
                    'title' => $title,
                    'value' => $item[1],
                    'icon' => $icon,
                    'selected' => $selected,
                    'index' => $selectItemCounter
                );
                // ICON
                if ($icon && !$suppressIcons && (!$onlySelectedIconShown || $selected)) {
                    $onClick = 'document.editform[' . GeneralUtility::quoteJSvalue($parameterArray['itemFormElName']) . '].selectedIndex=' . $selectItemCounter . ';';
                    $onClick .= implode('', $parameterArray['fieldChangeFunc']);
                    $onClick .= 'this.blur();return false;';
                    $selectIcons[] = array(
                        'title' => $title,
                        'icon' => $icon,
                        'index' => $selectItemCounter,
                        'onClick' => $onClick
                    );
                }
                $selectItemCounter++;
            }

        }

        // No-matching-value:
        if ($selectedValue && !$selectedValueFound && !$parameterArray['fieldTSConfig']['disableNoMatchingValueElement'] && !$config['disableNoMatchingValueElement']) {
            $noMatchingLabel = @sprintf($noMatchingLabel, $selectedValue);
            $options = '<option value="' . htmlspecialchars($selectedValue) . '" selected="selected">' . htmlspecialchars($noMatchingLabel) . '</option>';
        } elseif (!$selectedIcon && $selectItemGroups[0]['items'][0]['icon']) {
            $selectedIcon = $selectItemGroups[0]['items'][0]['icon'];
        }

        // Process groups
        foreach ($selectItemGroups as $selectItemGroup) {
            // suppress groups without items
            if (empty($selectItemGroup['items'])) {
                continue;
            }

            $optionGroup = is_array($selectItemGroup['header']);
            $options .= ($optionGroup ? '<optgroup label="' . htmlspecialchars($selectItemGroup['header']['title'], ENT_COMPAT, 'UTF-8', FALSE) . '">' : '');
            if (is_array($selectItemGroup['items'])) {
                foreach ($selectItemGroup['items'] as $item) {
                    $options .= '<option value="' . htmlspecialchars($item['value']) . '" data-icon="' .
                        htmlspecialchars($item['icon']) . '"'
                        . ($item['selected'] ? ' selected="selected"' : '') . '>' . $item['title'] . '</option>';
                }
            }
            $options .= ($optionGroup ? '</optgroup>' : '');
        }

        // Create item form fields:
        $sOnChange = 'if (this.options[this.selectedIndex].value==\'--div--\') {this.selectedIndex=' . $selectedIndex . ';} ';
        $sOnChange .= implode('', $parameterArray['fieldChangeFunc']);

        // Build the element
        $out .= '
            <div class="form-control-wrap">
                <select'
                    . ' id="' . $selectId . '"'
                    . ' name="' . htmlspecialchars($parameterArray['itemFormElName']) . '"'
                    . $this->getValidationDataAsDataAttribute($config)
                    . ' class="form-control form-control-adapt"'
                    . ($size ? ' size="' . $size . '"' : '')
                    . ' onchange="' . htmlspecialchars($sOnChange) . '"'
                    . $parameterArray['onFocus']
                    . ($disabled ? ' disabled="disabled"' : '')
                    . '>
                    ' . $options . '
                </select>
            </div>';

        // Create icon table:
        if (!empty($selectIcons) && !$config['noIconsBelowSelect']) {

            $out .= '<ul name="IconSelectTable-' . $PA['itemFormElName'] . '" class="list-inline __icon-font-selector">';
            $selectIconTotalCount = count($selectIcons);
            for ($selectIconCount = 0; $selectIconCount < $selectIconTotalCount; $selectIconCount++) {
                $out .= '<li>';
                if (is_array($selectIcons[$selectIconCount])) {
                    $out .= (!$onlySelectedIconShown ? '<a href="#" title="' . $selectIcons[$selectIconCount]['title'] . '" onClick="' . htmlspecialchars($selectIcons[$selectIconCount]['onClick']) . '">' : '');
                    $out .= $selectIcons[$selectIconCount]['icon'];
                    $out .= (!$onlySelectedIconShown ? '</a>' : '');
                }
                $out .= '</li>';
            }
            $out .= '</ul>';
        }

        return $out;
    }

    /**
     * Get the html for icon
     * @param  string $icon     The icon css class
     * @param  boolean $selected If the icon is selected/active
     * @return string           HTML output
     */
    protected function getIconHtml($icon, $selected)
    {
        $iconClass = $this->fontPrefix . $icon;
        $selectedClass = $selected == true ? ' ' . $this->selectedIconClass : '';
        return '<i class="' . $iconClass . $selectedClass . ' "></i>';
    }

    /**
     * Build JSON string for validations rules and return it
     * as data attribute for HTML elements.
     *
     * @param array $config
     * @return string
     */
    protected function getValidationDataAsDataAttribute(array $config)
    {
        return sprintf(' data-formengine-validation-rules="%s" ', htmlspecialchars($this->getValidationDataAsJsonString($config)));
    }

    /**
     * Build JSON string for validations rules.
     *
     * @param array $config
     * @return string
     */
    protected function getValidationDataAsJsonString(array $config)
    {
        $validationRules = array();
        if (!empty($config['eval'])) {
            $evalList = GeneralUtility::trimExplode(',', $config['eval'], true);
            unset($config['eval']);
            foreach ($evalList as $evalType) {
                $validationRules[] = array(
                    'type' => $evalType,
                    'config' => $config
                );
            }
        }
        if (!empty($config['range'])) {
            $validationRules[] = array(
                'type' => 'range',
                'config' => $config['range']
            );
        }
        if (!empty($config['maxitems']) || !empty($config['minitems'])) {
            $minItems = (isset($config['minitems'])) ? (int)$config['minitems'] : 0;
            $maxItems = (isset($config['maxitems'])) ? (int)$config['maxitems'] : 10000;
            $type = ($config['type']) ?: 'range';
            if ($config['renderMode'] !== 'tree' && $maxItems <= 1 && $minItems > 0) {
                $validationRules[] = array(
                    'type' => $type,
                    'minItems' => 1,
                    'maxItems' => 100000
                );
            } else {
                $validationRules[] = array(
                    'type' => $type,
                    'minItems' => $minItems,
                    'maxItems' => $maxItems
                );
            }
        }
        if (!empty($config['required'])) {
            $validationRules[] = array('type' => 'required');
        }
        return json_encode($validationRules);
    }

    /**
     * overrideByPageTsConfig Overrides some flexform configuration
     * @param  array &$PA PA
     * @return void
     */
    protected function overridePAByPageTsConfig(&$PA)
    {
        // by default use pid as pageid, but use uid for pages
        $pageId = $PA['row']['pid'];
        if ($PA['table'] === 'pages') {
            $pageId = $PA['row']['uid'];
        }
        $cType = $PA['row']['CType'][0];
        $table = $PA['table'];
        $field = $PA['field'];
        $pageTsConfig = GeneralUtility::removeDotsFromTS(BackendUtility::getPagesTSconfig($pageId));
        $tceForm = null;

        if (isset($pageTsConfig['TCEFORM'][$table][$field][$cType]['sDEF']['iconClass'])) {
            $tceForm = $pageTsConfig['TCEFORM'][$table][$field][$cType]['sDEF']['iconClass'];
        } elseif (isset($pageTsConfig['TCEFORM'][$table][$field]['iconClass'])) {
            $tceForm = $pageTsConfig['TCEFORM'][$table][$field]['iconClass'];
        }

        if (is_array($tceForm) && count($tceForm)>0) {

            // override cssFile
            if (isset($tceForm['config']['cssFile']) && strlen($tceForm['config']['cssFile']) > 0) {
                $PA['fieldConf']['config']['cssFile'] = $tceForm['config']['cssFile'];
            }

            // addItems
            if (isset($tceForm['addItems']) && count($tceForm['addItems']) > 0) {
                $laguageService = GeneralUtility::makeInstance(\TYPO3\CMS\Lang\LanguageService::class);
                foreach ($tceForm['addItems'] as $key => $value) {
                    $localizedValue = $laguageService->sL($value);
                    if (strlen($localizedValue) == 0) {
                        $localizedValue = $value;
                    }
                    $this->items[] = array('0' => $localizedValue, '1' => $key, '2' => $key);
                }
            }
        }

    }
}
