<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

if(TYPO3_MODE == 'BE') {
	// Add page typoscript tours
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/tsconfig.txt">');

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	setup.default.rteCleanPasteBehaviour=pasteStructure
');

