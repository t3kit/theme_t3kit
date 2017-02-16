<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	setup.default.rteCleanPasteBehaviour=pasteStructure
');

if (TYPO3_MODE === 'BE') {
	// Add page typoscript tours
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Resources/Private/Extensions/Guides/PageTS/tsconfig.txt">');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['imageTextLink']
	= \T3kit\themeT3kit\Hooks\ImageTextLinkPreviewRenderer::class;
