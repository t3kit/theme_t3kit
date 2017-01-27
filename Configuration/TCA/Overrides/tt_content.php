<?php
defined('TYPO3_MODE') or die();

call_user_func(function() {

    $contentElementLanguageFilePrefix = 'LLL:EXT:theme_t3kit/Resources/Private/Language/ContentElements.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
    $cmsLanguageFilePrefix = 'LLL:EXT:cms/locallang_ttc.xlf:';

    // Include tt_content overrides from "custom_content_elenent"
    if (is_file(PATH_site . 'fileadmin/templates/theme_t3kit/custom_content_elements/Configuration/TCA/Overrides/tt_content.php')) {
        require_once(PATH_site . 'fileadmin/templates/theme_t3kit/custom_content_elements/Configuration/TCA/Overrides/tt_content.php');
    }

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

    // "contentElementBootstrapSlider"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'bootstrap.slider.title',
            'contentElementBootstrapSlider',
            'content-elements-contentElementSlider'
        ],
        'contentElementSlider',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contentElementBootstrapSlider'] = 'content-elements-contentElementSlider';

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

    // "fullWidthImage"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'fullWidthImage.title',
            'fullWidthImage',
            'content-elements-fullWidthImage'
        ],
        'tabs',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['fullWidthImage'] = 'content-elements-fullWidthImage';

    // "responsiveVideo"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'responsiveVideo.title',
            'responsiveVideo',
            'content-elements-responsiveVideo'
        ],
        'fullWidthImage',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['responsiveVideo'] = 'content-elements-responsiveVideo';

    // "socialIcons"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'socialIcons.title',
            'socialIcons',
            'content-elements-socialIcons'
        ],
        'responsiveVideo',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['socialIcons'] = 'content-elements-socialIcons';

    // "copyrightText"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'copyrightText.title',
            'copyrightText',
            'content-elements-copyrightText'
        ],
        'socialIcons',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['copyrightText'] = 'content-elements-copyrightText';

    // "contacts"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'contacts.title',
            'contacts',
            'content-elements-contacts'
        ],
        'copyrightText',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contacts'] = 'content-elements-contacts';







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
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
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

// Override foreign_types for contentElementSlider so we can add a custom palette
// columnsOverrides doens't seem to be correct if irre children are collapsed when tt_content record is opened
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['appearance']['collapseAll'] = 0;
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'] = '--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;sliderPalette, --palette--;;imageoverlayPalette, --palette--;;filePalette';
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['1']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['2']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['3']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['4']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['5']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];

    // "contentElementBootstrapSlider"
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider'] = [
        'showitem' => '
            --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
            header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
            --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
        --div--;' . $contentElementLanguageFilePrefix . 'bootstrap.slider.tabs.slides,image,
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

    // "iconTextButton"
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

    // "divider"
    $GLOBALS['TCA']['tt_content']['types']['div'] = [
        'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel,
                tx_themes_icon,rowDescription,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:layout_formlabel,wrapper,wrapper_margin_top,
                wrapper_margin_bottom,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,categories,
                tx_themes_variants,tx_themes_behaviour,tx_themes_responsive,
                --div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements,
                tx_gridelements_container,tx_gridelements_columns
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
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'imageTextLink.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'imageTextLink.linkText,
                --linebreak--,header_link;' . $cmsLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.images,image,
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
    // "fullWidthImage"
    $GLOBALS['TCA']['tt_content']['types']['fullWidthImage'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
            --div--;' . $contentElementLanguageFilePrefix . 'fullWidthImage.tabs.image,image,
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

    // "responsiveVideo"
    $GLOBALS['TCA']['tt_content']['types']['responsiveVideo'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
            --div--;' . $contentElementLanguageFilePrefix . 'responsiveVideo.tabs.video,media,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];


    // "socialIcons"
    $GLOBALS['TCA']['tt_content']['types']['socialIcons'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
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

    // "copyrightText"
    $GLOBALS['TCA']['tt_content']['types']['copyrightText'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.extended
        '
    ];

    // "contacts"
    $GLOBALS['TCA']['tt_content']['types']['contacts'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
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

    // "imageTextLink"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,imageTextLink'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_imageTextLink.xml';

    // "divider"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,div'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_div.xml';

    // "accordion"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,accordion'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_accordion.xml';

    // "contentElementBootstrapSlider"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,contentElementBootstrapSlider'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_bootstrapSlider.xml';

    // "contentElementSlider"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,contentElementSlider'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_slider.xml';

    // "contentElementSocialIcons"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,socialIcons'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_socialIcons.xml';

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
        'aligning' => [
            'exclude' => true,
            'label' => $contentElementLanguageFilePrefix . 'tt_content.aligning',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$contentElementLanguageFilePrefix . 'label.default', 0]
                ],
                'default' => 0
            ]
        ],
        'wrapper_margin_top' => [
            'exclude' => true,
            'label' => $contentElementLanguageFilePrefix . 'tt_content.wrapper_margin_top',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$contentElementLanguageFilePrefix . 'label.default', 0]
                ],
                'default' => 0
            ]
        ],
        'wrapper_margin_bottom' => [
            'exclude' => true,
            'label' => $contentElementLanguageFilePrefix . 'tt_content.wrapper_margin_bottom',
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
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'wrapper, aligning, wrapper_margin_top, wrapper_margin_bottom', '', 'after:layout');
});

// gridelements TCA overrides
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns');
