<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {
    $GLOBALS['TCA']['pages']['columns']['tx_csseo_og_description']['config']['default'] = '';
    $GLOBALS['TCA']['pages']['columns']['tx_csseo_tw_description']['config']['default'] = '';

    $GLOBALS['TCA']['pages']['columns']['tx_themes_icon']['config'] = array (
        'type' => 'user',
        'userFunc' => 'T3kit\themeT3kit\UserFunction\IconFontSelector->renderField',
        'cssFile' => 'EXT:theme_t3kit/Resources/Public/IconFonts/style.css',
        'isIcoMoon' => 1,
        'items' => array(
            '0' => array('None', '', ''),
        ),
    );

    $ll = 'LLL:EXT:theme_t3kit/Resources/Private/Language/locallang_db.xlf:';

    $tempColumns = [
        'tx_themet3kit_fixed_post_var_conf' => [
            'label' => $ll .'pages.tx_themet3kit_fixed_post_var_conf',
            'displayCond' => 'FIELD:tx_realurl_exclude:!=:1',
            'exclude' => 1,
            'config' => [
                'type' => 'select',
                'max' => 1,
                'renderType' => 'selectSingle',
                'items' => [
                    [$ll . 'none', '0'],
                    [$ll . 'new_conf', '--div--']
                ],
                'itemsProcFunc' => \T3kit\themeT3kit\Utility\HelperUtility::class . '->getTcaFixedPostVarItems'
            ]
        ]
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);

    $GLOBALS['TCA']['pages']['palettes']['tx_realurl']['showitem'] .= ',--linebreak--,tx_themet3kit_fixed_post_var_conf';
});
