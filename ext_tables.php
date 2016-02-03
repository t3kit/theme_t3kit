<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
    /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'content-elements-accordion',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/accordion.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-contentElementSlider',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/slider.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-bigIconTextButton',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/bigIconTextButton.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-iconTextButton',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/iconTextButton.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-imageTextLink',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/imageTextLink.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-logoCarousel',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/logoCarousel.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-quote',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/quote.svg']
    );
    $iconRegistry->registerIcon(
        'content-elements-tabs',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/tabs.svg']
    );
    # PageTS custom content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'theme_t3kit',
        'Configuration/PageTS/custom_content_elements.txt',
        'EXT:theme_t3kit :: Enable Custom Content Elemets'
    );
    # Static files for custom content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $_EXTKEY,
        'Configuration/TypoScript/CustomContentElements/',
        'EXT:theme_t3kit :: Enable Custom Content Elemets'
    );
}

if (is_file(PATH_site . 'fileadmin/templates/theme_t3kit/custom_content_elements/Configuration/TCA/Overrides/tt_content.php')) {
    require_once(PATH_site . 'fileadmin/templates/theme_t3kit/custom_content_elements/Configuration/TCA/Overrides/tt_content.php');
}
