tx_seo_xmlsitemaps.10.sysLanguageHrefLangMappings {
    # sys_language_uid = hreflang
    0 = en
    1 = sv
    2 = de
}
#
# Limit allowed doktypes to only Standard pages
# (only affects page selection if set)
tx_seo_xmlsitemaps.10.allowedDoktypes = 1


# Disable title generation on news pages
[globalVar = GP:tx_news_pi1|news > 0] || [globalVar = GP:tx_news_pi1|overwriteDemand|categories > 0] || [globalVar = GP:tx_news_pi1|overwriteDemand|tags > 0]
    plugin.tx_seobasics.10 >
    config.noPageTitle = 0
[globalVar = GP:tx_news_pi1|overwriteDemand|year > 0] && [globalVar = GP:tx_news_pi1|overwriteDemand|month > 0]
    plugin.tx_seobasics.10 >
    config.noPageTitle = 0
[global]
