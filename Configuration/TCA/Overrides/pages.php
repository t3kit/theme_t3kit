<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {
    $GLOBALS['TCA']['pages']['columns']['tx_themes_icon']['config'] = array(
        'type' => 'user',
        'userFunc' => 'T3kit\themeT3kit\UserFunction\IconFontSelector->renderField',
        'cssFile' => 'EXT:theme_t3kit/Resources/Public/IconFonts/style.css',
        'isIcoMoon' => 1,
        'items' => array(
            '0' => array('None', '', ''),
        ),
    );

    \T3kit\themeT3kit\Utility\TcaUtility::setReplacementsForSlugField(
        'pages'
    );
});
