<?php
defined('TYPO3_MODE') or die();

call_user_func(function() {
    if (!isset($GLOBALS['TCA']['tt_content']['palettes']['frames'])) {
        $GLOBALS['TCA']['tt_content']['palettes']['frames'] = [
            'showitem' => 'layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:layout_formlabel'
        ];
    }

    $contentElementLanguageFilePrefix = 'LLL:EXT:theme_t3kit/Resources/Private/Language/ContentElements.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
    $frontendLanguageDatabaseFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:';
    $coreLanguageFilePrefix = 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:';

    // Content elements Flexform Path
    $flexformPath = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/';


    // Example how to add comments
    // ======================= contentName [begin] ==========================================
    // contentName CType
    // contentName backend fields
    // contentName flexform
    // ======================= contentName [end] ==========================================


    // Example how to configure the backend fields for our new content element. Just remove unneeded parts.

    // 'showitem' => '
    //     --div--;' .  $coreLanguageFilePrefix .'general,
    //         --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
    //         header;' . $frontendLanguageFilePrefix . 'header_formlabel,
    //         --linebreak--,bodytext;' . $frontendLanguageFilePrefix . 'bodytext_formlabel,
    //         --linebreak--,subheader;' . $frontendLanguageFilePrefix . 'subheader_formlabel,
    //         --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,
    //         --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

    //     --div--;' . $frontendLanguageFilePrefix . 'tabs.media,assets,
    //     --div--;' . $frontendLanguageFilePrefix . 'tabs.images,image,
    //         --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,
    //         --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageMaxSize,
    //         --palette--;' . $frontendLanguageDatabaseFilePrefix . 'tt_content.palette.mediaAdjustments;mediaAdjustments,
    //         --palette--;' . $frontendLanguageDatabaseFilePrefix . 'tt_content.palette.gallerySettings;gallerySettings,
    //         --palette--;' . $frontendLanguageFilePrefix . 'palette.imagelinks;imagelinks,

    //     --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
    //         --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
    //         --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
    //     --div--;' .  $coreLanguageFilePrefix .'language,
    //         --palette--;;language,
    //     --div--;' .  $coreLanguageFilePrefix .'access,
    //         --palette--;;hidden,
    //         --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
    //     --div--;' .  $coreLanguageFilePrefix .'categories,categories,
    //     --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
    //     --div--;' .  $coreLanguageFilePrefix .'extended,
    // '


    // Content elements tab
    // The "divider" these content elements
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'tab.contentElements',
            '--div--',
            null
        ],
        'form',
        'after'
    );


    // Content elements

    // ======================= heroImage [begin] ==========================================
    //  heroImage CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'heroImage.title',
            'heroImage',
            'content-elements-heroImage'
        ],
        'form',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['heroImage'] = 'content-elements-heroImage';

    // heroImage backend fields
    $GLOBALS['TCA']['tt_content']['types']['heroImage'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'heroImage.subheader,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'heroImage.linkText,
                --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.images,image,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,

            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];
    $GLOBALS['TCA']['tt_content']['types']['heroImage']['columnsOverrides']['bodytext']['config']['type'] = 'input';

    // heroImage flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,heroImage'] = $flexformPath . 'flexform_heroImage.xml';
    // ======================= heroImage [end] ==========================================



    // ======================= imageTextLink [begin] ==========================================
    // imageTextLink CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'imageTextLink.title',
            'imageTextLink',
            'content-elements-imageTextLink'
        ],
        'heroImage',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['imageTextLink'] = 'content-elements-imageTextLink';

    // imageTextLink backend fields
    $GLOBALS['TCA']['tt_content']['types']['imageTextLink'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
                header_layout;' . $frontendLanguageFilePrefix . 'header_layout_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'imageTextLink.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'imageTextLink.linkText,
                --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.media,assets,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.images,image,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // imageTextLink flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,imageTextLink'] = $flexformPath . 'flexform_imageTextLink.xml';
    // ======================= imageTextLink [end] ==========================================



    // ======================= bigIconTextButton [begin] ==========================================
    // bigIconTextButton CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'bigIconTextButton.title',
            'bigIconTextButton',
            'content-elements-bigIconTextButton'
        ],
        'imageTextLink',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bigIconTextButton'] = 'content-elements-bigIconTextButton';

    // bigIconTextButton backend fields
    $GLOBALS['TCA']['tt_content']['types']['bigIconTextButton'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
                header_layout;' . $frontendLanguageFilePrefix . 'header_layout_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'bigIconTextButton.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'bigIconTextButton.buttonText,
                --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];
    // bigIconTextButton flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,bigIconTextButton'] = $flexformPath . 'flexform_bigIconTextButton.xml';
    // ======================= bigIconTextButton [end] ==========================================



    // ======================= iconTextButton [begin] ==========================================
    // iconTextButton CType
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

    // iconTextButton backend fields
    $GLOBALS['TCA']['tt_content']['types']['iconTextButton'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'iconTextButton.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'iconTextButton.buttonText,
                --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // iconTextButton flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,iconTextButton'] = $flexformPath . 'flexform_iconTextButton.xml';
    // ======================= iconTextButton [end] ==========================================



    // ======================= button [begin] ==========================================
    // button CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'button.title',
            'button',
            'content-elements-button'
        ],
        'iconTextButton',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['button'] = 'content-elements-button';

    // button backend fields
    $GLOBALS['TCA']['tt_content']['types']['button'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $contentElementLanguageFilePrefix . 'button.header_label,
                --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // button flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,button'] = $flexformPath . 'flexform_button.xml';
    // ======================= button [end] ==========================================



    // ======================= BootstrapSlider [begin] ==========================================
    // BootstrapSlider CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'bootstrap.slider.title',
            'contentElementBootstrapSlider',
            'content-elements-contentElementSlider'
        ],
        'button',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contentElementBootstrapSlider'] = 'content-elements-contentElementSlider';

    // BootstrapSlider backend fields
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $contentElementLanguageFilePrefix . 'bootstrap.slider.tabs.slides,image,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // BootstrapSlider flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,contentElementBootstrapSlider'] = $flexformPath . 'flexform_bootstrapSlider.xml';

    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['appearance']['collapseAll'] = 0;
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'] = '--div--;,tx_themet3kit_slide_btn_txt, --palette--;;imageoverlayPalette, --palette--;;filePalette';
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['1']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['2']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['3']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['4']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['5']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    // ======================= BootstrapSlider [end] ==========================================


    // ======================= contentElementSlider [begin] ==========================================
    // contentElementSlider CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'slider.title',
            'contentElementSlider',
            'content-elements-contentElementSlider'
        ],
        'contentElementBootstrapSlider',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contentElementSlider'] = 'content-elements-contentElementSlider';

    // contentElementSlider backend fields
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $contentElementLanguageFilePrefix . 'slider.tabs.slides,image,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // contentElementSlider flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,contentElementSlider'] = $flexformPath . 'flexform_slider.xml';
    // ======================= contentElementSlider [end] ==========================================


    // Override foreign_types for contentElementSlider so we can add a custom palette
    // columnsOverrides doens't seem to be correct if irre children are collapsed when tt_content record is opened
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['appearance']['collapseAll'] = 0;
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'] = '--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;sliderPalette, --palette--;;imageoverlayPalette, --palette--;;filePalette';
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['1']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['2']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['3']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['4']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];
    $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['5']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['contentElementSlider']['columnsOverrides']['image']['config']['foreign_types']['0']['showitem'];



    // ======================= quote [begin] ==========================================
    // quote CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'quote.title',
            'quote',
            'content-elements-quote'
        ],
        'contentElementSlider',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['quote'] = 'content-elements-quote';

    // quote backend fields
    $GLOBALS['TCA']['tt_content']['types']['quote'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $contentElementLanguageFilePrefix . 'quote.header,
                --linebreak--,bodytext;' . $contentElementLanguageFilePrefix . 'quote.bodytext,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'quote.linkText,
                --linebreak--,header_link;' . $frontendLanguageFilePrefix . 'header_link_formlabel,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // quote flexform
    // ======================= quote [end] ==========================================



    // ======================= logoCarousel [begin] ==========================================
    // logoCarousel CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'logoCarousel.title',
            'logoCarousel',
            'content-elements-logoCarousel'
        ],
        'quote',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['logoCarousel'] = 'content-elements-logoCarousel';

    // logoCarousel backend fields
    $GLOBALS['TCA']['tt_content']['types']['logoCarousel'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,
            --div--;' . $contentElementLanguageFilePrefix . 'logoCarousel.tabs.logos,image,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageMaxSize,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,logoCarousel'] = $flexformPath . 'flexform_logoCarousel.xml';

    // logoCarousel flexform
    // ======================= logoCarousel [end] ==========================================



    // ======================= responsiveVideo [begin] ==========================================
    // responsiveVideo CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'responsiveVideo.title',
            'responsiveVideo',
            'content-elements-responsiveVideo'
        ],
        'logoCarousel',
        'after'
    );
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['responsiveVideo'] = 'content-elements-responsiveVideo';


    // responsiveVideo backend fields
    $GLOBALS['TCA']['tt_content']['types']['responsiveVideo'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,

            --div--;' . $contentElementLanguageFilePrefix . 'responsiveVideo.tabs.video,assets,
            --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // responsiveVideo flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,responsiveVideo'] = $flexformPath . 'flexform_responsiveVideo.xml';
    // ======================= responsiveVideo [end] ==========================================



    // ======================= fullWidthImage [begin] ==========================================
    // fullWidthImage CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'fullWidthImage.title',
            'fullWidthImage',
            'content-elements-fullWidthImage'
        ],
        'responsiveVideo',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['fullWidthImage'] = 'content-elements-fullWidthImage';

    // fullWidthImage backend fields
    $GLOBALS['TCA']['tt_content']['types']['fullWidthImage'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,

            --div--;' . $contentElementLanguageFilePrefix . 'fullWidthImage.tabs.image,image,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    $GLOBALS['TCA']['tt_content']['types']['fullWidthImage']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config'] = [
        'cropVariants' => [
            'default' => [
                'title' => $contentElementLanguageFilePrefix . 'imageManipulation.default',
                'selectedRatio' => 'NaN',
                'allowedAspectRatios' => [
                    '8:1' => [
                        'title' => '8:1', 'value' => 8 / 1
                    ],
                    '5:1' => [
                        'title' => '5:1', 'value' => 5 / 1
                    ],
                    '16:9' => [
                        'title' => '16:9', 'value' => 16 / 9
                    ],
                    '4:3' => [
                        'title' => '4:3', 'value' => 4 / 3
                    ],
                    'NaN' => [
                        'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free', 'value' => 0.0
                    ],
                ],
            ],
            'medium' => [
                'title' => $contentElementLanguageFilePrefix . 'imageManipulation.medium',
                'selectedRatio' => 'NaN',
                'allowedAspectRatios' => [
                    '8:1' => [
                        'title' => '8:1', 'value' => 8 / 1
                    ],
                    '5:1' => [
                        'title' => '5:1', 'value' => 5 / 1
                    ],
                    '16:9' => [
                        'title' => '16:9', 'value' => 16 / 9
                    ],
                    '4:3' => [
                        'title' => '4:3', 'value' => 4 / 3
                    ],
                    'NaN' => [
                        'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free', 'value' => 0.0
                    ],
                ],
            ],
            'small' => [
                'title' => $contentElementLanguageFilePrefix . 'imageManipulation.small',
                'selectedRatio' => 'NaN',
                'allowedAspectRatios' => [
                    '8:1' => [
                        'title' => '8:1', 'value' => 8 / 1
                    ],
                    '5:1' => [
                        'title' => '5:1', 'value' => 5 / 1
                    ],
                    '16:9' => [
                        'title' => '16:9', 'value' => 16 / 9
                    ],
                    '4:3' => [
                        'title' => '4:3', 'value' => 4 / 3
                    ],
                    'NaN' => [
                        'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free', 'value' => 0.0
                    ],
                ],
            ],
        ],
    ];

    // fullWidthImage flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,fullWidthImage'] = $flexformPath . 'flexform_fullWidthImage.xml';
    // ======================= fullWidthImage [end] ==========================================



    // ======================= socialIcons [begin] ==========================================
    // socialIcons CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'socialIcons.title',
            'socialIcons',
            'content-elements-socialIcons'
        ],
        'fullWidthImage',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['socialIcons'] = 'content-elements-socialIcons';

    // socialIcons backend fields
    $GLOBALS['TCA']['tt_content']['types']['socialIcons'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // socialIcons flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,socialIcons'] = $flexformPath . 'flexform_socialIcons.xml';
    // ======================= socialIcons [end] ==========================================



    // ======================= contacts [begin] ==========================================
    // contacts CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'contacts.title',
            'contacts',
            'content-elements-contacts'
        ],
        'socialIcons',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contacts'] = 'content-elements-contacts';

    // contacts backend fields
    $GLOBALS['TCA']['tt_content']['types']['contacts'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // contacts flexform
    // ======================= contacts [end] ==========================================



    // ======================= copyrightText [begin] ==========================================
    // copyrightText CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'copyrightText.title',
            'copyrightText',
            'content-elements-copyrightText'
        ],
        'contacts',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['copyrightText'] = 'content-elements-copyrightText';

    // copyrightText backend fields
    $GLOBALS['TCA']['tt_content']['types']['copyrightText'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // copyrightText flexform
    // ======================= copyrightText [end] ==========================================






    // ======================= divider [begin] ==========================================
    // divider CType

    // divider backend fields
    $GLOBALS['TCA']['tt_content']['types']['div'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header.ALT.div_formlabel,

                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'notes,rowDescription,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // divider flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,div'] = $flexformPath . 'flexform_div.xml';
    // ======================= divider [end] ==========================================


    // ======================= contactCard [begin] ==========================================
    // contactCard CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'contactsCard.title',
            'contactsCard',
            'content-elements-contactsCard'
        ],
        'copyrightText',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contactsCard'] = 'content-elements-contactsCard';

    // contactsCard backend fields
    $GLOBALS['TCA']['tt_content']['types']['contactsCard'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $contentElementLanguageFilePrefix . 'contactsCard.name,
                --linebreak--,subheader;' . $contentElementLanguageFilePrefix . 'contactsCard.job,
                --linebreak--,pi_flexform;' . $contentElementLanguageFilePrefix . 'tt_content.tabs.settings,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.images,image,
                --palette--;' . $contentElementLanguageFilePrefix . 'tt_content.palette.imageSize;imageSize,

            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' .  $coreLanguageFilePrefix .'language,
                --palette--;;language,
            --div--;' .  $coreLanguageFilePrefix .'access,
                --palette--;;hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            --div--;' .  $coreLanguageFilePrefix .'categories,categories,
            --div--;' .  $coreLanguageFilePrefix .'extended,
        '
    ];

    // contactsCard flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,contactsCard'] = $flexformPath . 'flexform_contactsCard.xml';
    // ======================= contactCard [end] ==========================================



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



    // Add additional fields for tt_content
    $additionalColumns = [
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
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'aligning', '', 'after:layout');
});

// gridelements TCA overrides
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns');
