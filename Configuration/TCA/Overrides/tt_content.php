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
            'content-elements-accordion'
        ],
        'login',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['accordion'] = 'content-elements-accordion';

    // "contentElementSlider"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'slider.title',
            'contentElementSlider',
            'content-elements-contentElementSlider'
        ],
        'accordion',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contentElementSlider'] = 'content-elements-contentElementSlider';

    // "bigIconTextButton"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'bigIconTextButton.title',
            'bigIconTextButton',
            'content-elements-bigIconTextButton'
        ],
        'contentElementSlider',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bigIconTextButton'] = 'content-elements-bigIconTextButton';

    // "iconTextButton"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'iconTextButton.title',
            'iconTextButton',
            'content-elements-iconTextButton'
        ],
        'bigIconTextButton',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['iconTextButton'] = 'content-elements-iconTextButton';

    // "imageTextLink"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'imageTextLink.title',
            'imageTextLink',
            'content-elements-imageTextLink'
        ],
        'iconTextButton',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['imageTextLink'] = 'content-elements-imageTextLink';

    // "logoCarousel"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'logoCarousel.title',
            'logoCarousel',
            'content-elements-logoCarousel'
        ],
        'imageTextLink',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['logoCarousel'] = 'content-elements-logoCarousel';

    // "quote"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'quote.title',
            'quote',
            'content-elements-quote'
        ],
        'logoCarousel',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['quote'] = 'content-elements-quote';

    // "tabs"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'tabs.title',
            'tabs',
            'content-elements-tabs'
        ],
        'quote',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['tabs'] = 'content-elements-tabs';

    // The "divider" these content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'tab.contentElements',
            '--div--',
            null
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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

    // Add additional fields for tt_content
    $additionalColumns = [
        'wrapper' => [
            'exclude' => true,
            'label' => $contentElementLanguageFilePrefix . 'tt_content.wrapper',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$contentElementLanguageFilePrefix . 'label.default', 0]
                ],
                'default' => 0
            ]
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'wrapper', '', 'after:layout');
});
