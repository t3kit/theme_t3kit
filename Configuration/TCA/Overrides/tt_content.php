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


    // Example how to configure the backend fields for our new content element
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

    // ======================= Hero Image [begin] ==========================================
    //  Hero Image CType
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

    // Hero Image backend fields
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

    // Hero Image flexform
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,heroImage'] = $flexformPath . 'flexform_heroImage.xml';
    // ======================= Hero Image [end] ==========================================



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
        'heroImage',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bigIconTextButton'] = 'content-elements-bigIconTextButton';

    // bigIconTextButton backend fields
    $GLOBALS['TCA']['tt_content']['types']['bigIconTextButton'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
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
        'iconTextButton',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['imageTextLink'] = 'content-elements-imageTextLink';

    // imageTextLink backend fields
    $GLOBALS['TCA']['tt_content']['types']['imageTextLink'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
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


    // TODO change button.header_label
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
        'imageTextLink',
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
        'button',
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



    // ======================= BootstrapSlider [begin] ==========================================
    // TODO change name (contentElementBootstrapSlider & content-elements-contentElementSlider)
    // BootstrapSlider CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $contentElementLanguageFilePrefix . 'bootstrap.slider.title',
            'contentElementBootstrapSlider',
            'content-elements-contentElementSlider'
        ],
        'quote',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contentElementBootstrapSlider'] = 'content-elements-contentElementSlider';

    // BootstrapSlider backend fields
    // TODO (bootstrap.slider.tabs.slides,image)
    $GLOBALS['TCA']['tt_content']['types']['contentElementBootstrapSlider'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
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
    // ======================= BootstrapSlider [end] ==========================================



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
        'contentElementBootstrapSlider',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['logoCarousel'] = 'content-elements-logoCarousel';

    // logoCarousel backend fields
    $GLOBALS['TCA']['tt_content']['types']['logoCarousel'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,

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

    // logoCarousel flexform
    // ======================= logoCarousel [end] ==========================================



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
        'logoCarousel',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['socialIcons'] = 'content-elements-socialIcons';

    // socialIcons backend fields
    $GLOBALS['TCA']['tt_content']['types']['socialIcons'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,
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
        'socialIcons',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['copyrightText'] = 'content-elements-copyrightText';

    // copyrightText backend fields
    $GLOBALS['TCA']['tt_content']['types']['copyrightText'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,

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
        'copyrightText',
        'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['contacts'] = 'content-elements-contacts';

    // contacts backend fields
    $GLOBALS['TCA']['tt_content']['types']['contacts'] = [
        'showitem' => '
            --div--;' .  $coreLanguageFilePrefix .'general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                header;' . $frontendLanguageFilePrefix . 'header_formlabel,

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





    // TODO check all image and media fields and enable crop fn
    // TODO imageSize;imageMaxSize

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

    // TODO rename !!!
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

    // TODO check if needed
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



    //
    // Flexforms
    //

    // "divider"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,div'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_div.xml';


    // "contentElementSlider"
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,contentElementSlider'] = 'FILE:EXT:theme_t3kit/Configuration/FlexForms/flexform_slider.xml';




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
