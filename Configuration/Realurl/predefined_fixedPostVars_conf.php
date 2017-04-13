<?php

$init = function () {
    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['theme_t3kit'])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['theme_t3kit'] = [];
    }

    $configuration = &$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['theme_t3kit'];

    // predefine configuration for news item single view
    $configuration['fixedPostVars'][] = [
        'title' => 'News single view',
        'key' => 'news_single_view',
        'configuration' => [
            [
                'GETvar' => 'tx_news_pi1[action]',
                'noMatch' => 'bypass'
            ],
            [
                'GETvar' => 'tx_news_pi1[controller]',
                'noMatch' => 'bypass'
            ],
            [
                'GETvar' => 'tx_news_pi1[news]',
                'lookUpTable' => [
                    'table' => 'tx_news_domain_model_news',
                    'id_field' => 'uid',
                    'alias_field' => 'IF(path_segment!="",path_segment,title)',
                    'addWhereClause' => ' AND NOT deleted',
                    'useUniqueCache' => 1,
                    'useUniqueCache_conf' => [
                        'strtolower' => 1,
                        'spaceCharacter' => '-'
                    ],
                    'languageGetVar' => 'L',
                    'languageExceptionUids' => '',
                    'languageField' => 'sys_language_uid',
                    'transOrigPointerField' => 'l10n_parent',
                    'autoUpdate' => 1,
                    'expireDays' => 180
                ]
            ]
        ]
    ];

    // predefine configuration for news category menu
    $configuration['fixedPostVars'][] = [
        'title' => 'Article category',
        'key' => 'categories_item',
        'configuration' => [
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][categories]',
                'lookUpTable' => [
                    'table' => 'sys_category',
                    'id_field' => 'uid',
                    'alias_field' => 'title',
                    'addWhereClause' => ' AND NOT deleted',
                    'useUniqueCache' => 1,
                    'useUniqueCache_conf' => [
                        'strtolower' => 1,
                        'spaceCharacter' => '-'
                    ]
                ]
            ]
        ]
    ];

    // predefine configuration for news tags menu
    $configuration['fixedPostVars'][] = [
        'title' => 'Article tag',
        'key' => 'tags_item',
        'configuration' => [
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][tags]',
                'lookUpTable' => [
                    'table' => 'tx_news_domain_model_tag',
                    'id_field' => 'uid',
                    'alias_field' => 'title',
                    'addWhereClause' => ' AND NOT deleted',
                    'useUniqueCache' => 1,
                    'useUniqueCache_conf' => [
                        'strtolower' => 1,
                        'spaceCharacter' => '-'
                    ]
                ]
            ]
        ]
    ];

    // predefine configuration for news date menu
    $configuration['fixedPostVars'][] = [
        'title' => 'Article date',
        'key' => 'date_item',
        'configuration' => [
            [
                'GETvar' => 'tx_news_pi1[controller]',
                'noMatch' => 'bypass',
            ],
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][year]'
            ],
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][month]',
            ],
            [
                'GETvar' => 'tx_news_pi1[overwriteDemand][day]',
                'noMatch' => 'bypass',
            ]
        ]
    ];
};

$init();
unset($init);
