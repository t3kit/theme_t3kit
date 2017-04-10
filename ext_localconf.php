<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	setup.default.rteCleanPasteBehaviour=pasteStructure
');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['imageTextLink']
	= \T3kit\themeT3kit\Hooks\ImageTextLinkPreviewRenderer::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t3kit'][] = 'T3kit\\themeT3kit\\ViewHelpers';