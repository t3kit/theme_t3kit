<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']
    ['SC_OPTIONS']
    ['cms/layout/class.tx_cms_layout.php']
    ['tt_content_drawItem']
    ['imageTextLink'] = \T3kit\themeT3kit\Hooks\ImageTextLinkPreviewRenderer::class;

// Register data handler hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] =
    \T3kit\themeT3kit\Hooks\DataHandlerHook::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][$_EXTKEY] =
    \T3kit\themeT3kit\Hooks\DataHandlerHook::class;

/**
 *  Load predefined configuration of fixedPostVars
 */
$extConf = \T3kit\themeT3kit\Utility\HelperUtility::getExtConf();

if (is_array($extConf) && $extConf['fixedPostVarsConfigurationfFile']) {
    $filePath = PATH_site . trim($extConf['fixedPostVarsConfigurationfFile']);
}

if (isset($filePath) && file_exists($filePath)) {
    require_once($filePath);
} else {
    /** @noinspection PhpIncludeInspection */
    @include_once(PATH_site . 'typo3conf/ext/theme_t3kit/Configuration/Realurl/predefined_fixedPostVars_conf.php');
}
// To enable dynamic fixed pages, following code needs to be added to realurl_conf.php to include the generated file
// Fixed pages, dynamically created (shorter url)
/*
$fixedPostVarsConfigurationUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \T3kit\themeT3kit\Utility\FixedPostVarsConfigurationUtility::class
);
$fixedPostVarsFile = $fixedPostVarsConfigurationUtility->getSaveFilePath();
if (file_exists($fixedPostVarsFile)) {
    \TYPO3\CMS\Core\Utility\GeneralUtility::requireOnce($fixedPostVarsFile);
}
*/

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['imageTextLink']
	= \T3kit\themeT3kit\Hooks\ImageTextLinkPreviewRenderer::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t3kit'][] = 'T3kit\\themeT3kit\\ViewHelpers';


$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3kit_default'] = 'EXT:theme_t3kit/Resources/Private/Extensions/RTE/Default.yaml';
