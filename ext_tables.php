<?php
defined('TYPO3_MODE') or die();

$boot = function ($_EXTKEY) {
    if (TYPO3_MODE === 'BE') {

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        // Content Elements Icons
        $contentElementIconFilePrefix = 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/ContentElements/';
        $contentElementIcons = [
            'content-elements-contentElementSlider' => 'slider.svg',
            'content-elements-bigIconTextButton' => 'bigIconTextButton.svg',
            'content-elements-iconTextButton' => 'iconTextButton.svg',
            'content-elements-imageTextLink' => 'imageTextLink.svg',
            'content-elements-logoCarousel' => 'logoCarousel.svg',
            'content-elements-quote' => 'quote.svg',
            'content-elements-fullWidthImage' => 'fullWidthImage.svg',
            'content-elements-responsiveVideo' => 'responsiveVideo.svg',
            'content-elements-socialIcons' => 'socialIcons.svg',
            'content-elements-copyrightText' => 'copyrightText.svg',
            'content-elements-contacts' => 'contacts.svg',
            'content-elements-button' => 'button.svg',
            'content-elements-heroImage' => 'heroImage.svg',
            'content-elements-contactsCard' => 'contactsCard.svg'
        ];
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
            'grid-elements-simpleAccordion' => 'simpleAccordion.svg',
            'grid-elements-tabGroup' => 'tabGroup.svg',
            'grid-elements-tab' => 'tab.svg',
            'grid-elements-sliderContainer' => 'sliderContainer.svg'
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

        // Add default state for frontend editing to be enabled for all backend users
        $GLOBALS['TYPO3_USER_SETTINGS']['columns']['frontend_editing']['default'] = 1;
    }
};

$boot($_EXTKEY);

unset($boot);
