<?php
defined('TYPO3_MODE') or die();

call_user_func(function() {

    $contentElementLanguageFilePrefix = 'LLL:EXT:theme_t3kit/Resources/Private/Language/ContentElements.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
    $cmsLanguageFilePrefix = 'LLL:EXT:cms/locallang_ttc.xlf:';

    //
    // CTypes
    //
    // "accordion"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'accordion.title',
            'accordion',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/accordion.gif'
        ],
        'login',
        'after'
    );

    // "contentElementSlider"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'slider.title',
            'contentElementSlider',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/slider.gif'
        ],
        'accordion',
        'after'
    );

    // "bigIconTextButton"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'bigIconTextButton.title',
            'bigIconTextButton',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/bigIconTextButton.gif'
        ],
        'contentElementSlider',
        'after'
    );

    // "iconTextButton"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'iconTextButton.title',
            'iconTextButton',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/iconTextButton.gif'
        ],
        'bigIconTextButton',
        'after'
    );

    // "imageTextLink"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'imageTextLink.title',
            'imageTextLink',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/imageTextLink.gif'
        ],
        'iconTextButton',
        'after'
    );

    // "logoCarousel"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'logoCarousel.title',
            'logoCarousel',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/logoCarousel.gif'
        ],
        'imageTextLink',
        'after'
    );

    // "quote"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'quote.title',
            'quote',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/quote.gif'
        ],
        'logoCarousel',
        'after'
    );

    // "tabs"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'tabs.title',
            'tabs',
            'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/tabs.gif'
        ],
        'quote',
        'after'
    );

    // The "divider" these content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'tab.contentElements',
            '--div--',
            NULL
        ],
        'login',
        'after'
    );

    //
    // Palettes
    //
    // "imageSize"
    $GLOBALS['TCA']['tt_content']['palettes']['imageSize'] = [
        'showitem' => '
            imagewidth;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize.imageWidth,
            imageheight;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize.imageHeight,
        '
    ];

    // "imageMaxSize"
    $GLOBALS['TCA']['tt_content']['palettes']['imageMaxSize'] = [
        'showitem' => '
            imagewidth;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize.imageMaxWidth,
            imageheight;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize.imageMaxHeight,
        '
    ];

    //
    // Types
    //
    // "contentElementSlider"
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
            --div--;' . $contentElementLanguageFilePrefix . 'slider.tabs.slides,image,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "bigIconTextButton"
    $GLOBALS['TCA']['tt_content']['types']['bigIconTextButton'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $cmsLanguageFilePrefix . 'header_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'bigIconTextButton.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'bigIconTextButton.buttonText,
                --linebreak--,header_link;' . $cmsLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "contentElementSlider"
    $GLOBALS['TCA']['tt_content']['types']['iconTextButton'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $cmsLanguageFilePrefix . 'header_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'iconTextButton.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'iconTextButton.buttonText,
                --linebreak--,header_link;' . $cmsLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "accordion"
    $GLOBALS['TCA']['tt_content']['types']['accordion'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.headers;headers,
                records;' . $contentElementLanguageFilePrefix . 'accordion.records_formlabe,
                rowDescription,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "imageTextLink"
    $GLOBALS['TCA']['tt_content']['types']['imageTextLink'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $cmsLanguageFilePrefix . 'header_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'iconTextButton.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'iconTextButton.linkText,
                --linebreak--,header_link;' . $cmsLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
            --div--;' . $contentElementLanguageFilePrefix . 'imageTextLink.tabs.media,media,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "logoCarousel"
    $GLOBALS['TCA']['tt_content']['types']['logoCarousel'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.headers;headers,
            --div--;' . $contentElementLanguageFilePrefix . 'logoCarousel.tabs.logos,image,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageMaxSize,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "quote"
    $GLOBALS['TCA']['tt_content']['types']['quote'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $contentElementLanguageFilePrefix . 'quote.header,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'quote.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'quote.linkText,
                --linebreak--,header_link;' . $cmsLanguageFilePrefix . 'header_link_formlabel,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "tabs"
    $GLOBALS['TCA']['tt_content']['types']['tabs'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.headers;headers,
                records;' . $contentElementLanguageFilePrefix . 'accordion.records_formlabe,
                rowDescription,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    //
    // Flexforms
    //
    // "contentElementSlider"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,bigIconTextButton'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_bigIconTextButton.xml';

    // "iconTextButton"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,iconTextButton'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_iconTextButton.xml';

    // "accordion"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,accordion'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_accordion.xml';

});

