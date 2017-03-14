<?php
defined('TYPO3_MODE') or die();

call_user_func(function() {

    $coreLanguagePrefix = 'LLL:EXT:lang/locallang_core.xlf:';
    $languagePrefix = 'LLL:EXT:theme_t3kit/Resources/Private/Language/locallang.xlf:';

    $additionalColumns = [
        'default_save_button' => [
            'exclude' => 0,
            'label' => $languagePrefix . 'be_users.default_save_button',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'maxitems' => 1,
                'items' => [
                    [$coreLanguagePrefix . 'rm.saveDoc', '_savedok'],
                    [$coreLanguagePrefix . 'rm.saveCloseDoc', '_saveandclosedok'],
                    [$coreLanguagePrefix . 'rm.saveDocShow', '_savedokview'],
                    [$coreLanguagePrefix . 'rm.saveNewDoc', '_savedoknew'],
                ],
            ]
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_users', $additionalColumns);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'default_save_button', '', 'after:lang');
});
