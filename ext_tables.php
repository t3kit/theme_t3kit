<?php
defined('TYPO3_MODE') or die();

$boot = function ($_EXTKEY) {
    if (TYPO3_MODE === 'BE') {
        $contentElementIconFilePrefix = 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/ContentElements/';

        $contentElementIcons = [
            'content-elements-accordion' => 'accordion.svg',
            'content-elements-contentElementSlider' => 'slider.svg',
            'content-elements-bigIconTextButton' => 'bigIconTextButton.svg',
            'content-elements-iconTextButton' => 'iconTextButton.svg',
            'content-elements-imageTextLink' => 'imageTextLink.svg',
            'content-elements-logoCarousel' => 'logoCarousel.svg',
            'content-elements-quote' => 'quote.svg',
            'content-elements-tabs' => 'tabs.svg',
            'content-elements-fullWidthImage' => 'fullWidthImage.svg',
            'content-elements-responsiveVideo' => 'responsiveVideo.svg',
            'content-elements-socialIcons' => 'socialIcons.svg',
            'content-elements-copyrightText' => 'copyrightText.svg',
            'content-elements-contacts' => 'contacts.svg',
            'content-center-vertical-text-img-left' => 'content-center-vertical-text-img-left.svg',
            'content-center-vertical-text-img-right' => 'content-center-vertical-text-img-right.svg',
        ];

        /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        foreach ($contentElementIcons as $identifier => $contentElementIcon) {
            $iconRegistry->registerIcon(
                $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => $contentElementIconFilePrefix . $contentElementIcon]
            );
        }

        // Grid element icons
        $gridElementsPath = 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/GridElements/';

        $gridElementsIcons = [
            'grid-elements-2ColumnGrid' => '2-column-grid.svg',
            'grid-elements-3ColumnGrid' => '3-column-grid.svg',
            'grid-elements-4ColumnGrid' => '4-column-grid.svg',
            'grid-elements-adv1ColumnGrid' => 'adv1-column-grid.svg',
            'grid-elements-adv2ColumnGrid' => 'adv2-column-grid.svg',
            'grid-elements-adv3ColumnGrid' => 'adv3-column-grid.svg',
            'grid-elements-adv4ColumnGrid' => 'adv4-column-grid.svg',
            'grid-elements-collapsible' => 'collapsible.svg',
            'grid-elements-collapsibleGroup' => 'collapsibleGroup.svg',
            'grid-elements-parallax' => 'parallax.svg',
            'grid-elements-tabGroup' => 'tabGroup.svg',
            'grid-elements-tab' => 'tab.svg'
        ];

        foreach ($gridElementsIcons as $identifier => $gridElementsIcon) {
            $iconRegistry->registerIcon(
                $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => $gridElementsPath . $gridElementsIcon]
            );
        }

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

    }
};
$boot($_EXTKEY);
unset($boot);