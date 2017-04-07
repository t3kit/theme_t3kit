<?php
namespace T3kit\themeT3kit\DataProcessing;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This data processor can be used for setting class by the content layout so it will be accessible in fluid template
 *
 * Example TypoScript configuration:
 * 10 = T3kit\themeT3kit\DataProcessing\LayoutClassProcessor
 * 10 {
 *   as = layoutClass
 *   classMappings {
 *      0 = __class-modifier-intence
 *      1 = __class-modifier-calm __class-modifier-darker
 *   }
 * }
 *
 * whereas "layoutClass" can be used as a variable {layoutClass} inside Fluid to set a class name in template.
 *
 */
class LayoutClassProcessor implements DataProcessorInterface
{

    /**
     * Generate variable Get string from classMappings array with the same key as the "layout" in the content
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        // set targetvariable, default "layoutClass"
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'layoutClass');
        $processedData[$targetVariableName] = '';

        // set fieldname, default "layout"
        $fieldName = $cObj->stdWrapValue('fieldName', $processorConfiguration, 'layout');

        if (isset($cObj->data[$fieldName]) && is_array($processorConfiguration['classMappings.'])) {
            $layoutClassMappings = GeneralUtility::removeDotsFromTS($processorConfiguration['classMappings.']);
            $processedData[$targetVariableName] = $layoutClassMappings[$cObj->data[$fieldName]];
        }
        // if targetvariable is settings, try to merge it with contentObjectConfiguration['settings.']
        if ($targetVariableName == 'settings') {
            if (is_array($contentObjectConfiguration['settings.'])) {
                $convertedConf = GeneralUtility::removeDotsFromTS($contentObjectConfiguration['settings.']);
                foreach ($convertedConf as $key => $value) {
                    if (!isset($processedData[$targetVariableName][$key]) || $processedData[$targetVariableName][$key] == false) {
                        $processedData[$targetVariableName][$key] = $value;
                    }
                }
            }
        }

        return $processedData;
    }
}
