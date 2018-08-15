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

use TYPO3\CMS\Extbase\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This data processor can be used for processing data for the content elements which have flexform contents in one field
 *
 * Example TypoScript configuration:
 * 10 = Pixelant\ThemeCore\DataProcessing\FlexFormProcessor
 * 10 {
 *   if.isTrue.field = pi_flexform
 *   fieldName = pi_flexform
 *   as = flexform
 * }
 *
 * whereas "flexform" can be used as a variable {flexform} inside Fluid to fetch values.
 * if as = settings, flexform settings are merged with contentObjectConfiguration['settings.']
 *
 */
class FlexFormProcessor implements DataProcessorInterface {

	/**
	 * Process flexform field data to an array
	 *
	 * @param ContentObjectRenderer $cObj The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        // set targetvariable, default "flexform"
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'flexform');

        // set fieldname, default "pi_flexform"
        $fieldName = $cObj->stdWrapValue('fieldName', $processorConfiguration, 'pi_flexform');

        // parse flexform
        $flexformService = GeneralUtility::makeInstance(FlexFormService::class);
        $processedData[$targetVariableName] = $flexformService->convertFlexFormContentToArray($cObj->data[$fieldName]);

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
