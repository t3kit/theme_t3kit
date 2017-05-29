<?php
defined('TYPO3_MODE') or die();

call_user_func(function() {

    $contentElementLanguageFilePrefix = 'LLL:EXT:theme_t3kit/Resources/Private/Language/ContentElements.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
    $cmsLanguageFilePrefix = 'LLL:EXT:cms/locallang_ttc.xlf:';

    // Add additional fields for tt_content
    $additionalColumns = [
        'tx_themet3kit_slide_appearance' => [
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
        'tx_themet3kit_slide_btn_txt' => [
            'exclude' => 0,
            'label' => $contentElementLanguageFilePrefix . 'slider.link.text',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'eval' => 'trim',
            ]
        ]
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $additionalColumns);
});



// add special news palette
$GLOBALS['TCA']['sys_file_reference']['palettes']['sliderPalette'] = [
    'showitem' => 'tx_themet3kit_slide_appearance,tx_themet3kit_slide_btn_txt',
    'canNotCollapse' => true
];
