<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (!TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('frontend_editing')) {
    // Add an empty placeholder viewhelper if the EXT:frontend_editing is not active
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['core'][] = 'T3kit\\themeT3kit\\ViewHelpers';
}

$GLOBALS['TYPO3_CONF_VARS']
    ['SC_OPTIONS']
    ['cms/layout/class.tx_cms_layout.php']
    ['tt_content_drawItem']
    ['imageTextLink'] = \T3kit\themeT3kit\Hooks\ImageTextLinkPreviewRenderer::class;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['imageTextLink']
    = \T3kit\themeT3kit\Hooks\ImageTextLinkPreviewRenderer::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t3kit'][] = 'T3kit\\themeT3kit\\ViewHelpers';


$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3kit_default']
    = 'EXT:theme_t3kit/Resources/Private/Extensions/RTE/Default.yaml';


$GLOBALS['TYPO3_CONF_VARS']['BE']['interfaces'] = 'frontend,backend';

// register to signal slot from SystemInformationToolbarItem to include
// Themes Development Mode constant setting per "siteroot" to system information
$signalSlotDispatcher = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class
);
$signalSlotDispatcher->connect(
    \TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem::class,
    'getSystemInformation',
    \T3kit\themeT3kit\Slot\GetSystemInformationSlot::class,
    'getSystemInformation'
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/tsconfig.txt">'
);
