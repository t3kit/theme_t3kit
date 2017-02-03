<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$contentElementIconFilePrefix = 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/ContentElements/';

if (TYPO3_MODE === 'BE') {
    /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'content-elements-accordion',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'accordion.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-contentElementSlider',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'slider.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-bigIconTextButton',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'bigIconTextButton.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-iconTextButton',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'iconTextButton.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-imageTextLink',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'imageTextLink.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-logoCarousel',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'logoCarousel.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-quote',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'quote.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-tabs',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'tabs.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-fullWidthImage',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'fullWidthImage.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-responsiveVideo',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'responsiveVideo.svg']
    );


    $iconRegistry->registerIcon(
        'content-elements-socialIcons',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'socialIcons.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-copyrightText',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'copyrightText.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-contacts',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $contentElementIconFilePrefix . 'contacts.svg']
    );

	// Add context sensitive help (csh) for the haiku table
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tt_content',
        'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh_tt_content.xml'
    );

    /***************
     * Custom content elements
     */
    # PageTS custom content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $_EXTKEY,
        'Configuration/PageTS/custom_content_elements.txt',
        'EXT:theme_t3kit :: Enable Custom Content Elemets (fileadmin/templates/...)'
    );
    # Static files for custom content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $_EXTKEY,
        'Configuration/TypoScript/CustomContentElements/',
        'EXT:theme_t3kit :: Enable Custom Content Elemets (fileadmin/templates/...)'
    );

    // Include ext_tables from 'custom_content_elements'
    if (is_file(PATH_site . 'fileadmin/templates/theme_t3kit/custom_content_elements/Configuration/Backend/ext_tables.php')) {
        require_once(PATH_site . 'fileadmin/templates/theme_t3kit/custom_content_elements/Configuration/Backend/ext_tables.php');
    }

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Backend\Template\Components\Buttons\SplitButton::class] = [
        'className' => \T3kit\themeT3kit\Xclass\DefaultSplitButton::class
    ];

}

$iconRegistry->registerIcon(
	'module-guide-tour-themes-module',
	\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
	array(
		'source' => '/typo3conf/ext/themes/ext_icon.svg'
	)
);
