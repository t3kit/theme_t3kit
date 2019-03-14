<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function () {
    $tableToField = [
        'sys_category' => 'slug',
        'tx_news_domain_model_tag' => 'slug',
        'tx_news_domain_model_news' => 'path_segment',
    ];

    foreach ($tableToField as $table => $field) {
        \T3kit\themeT3kit\Utility\TcaUtility::setReplacementsForSlugField(
            $table,
            $field
        );
    }
});
