# use cs_seo sitetitle constant set from theme siteName
page.headerData.654.30.40 {
  data >
  value = {$plugin.tx_csseo.sitetitle}
}

# set cs_seo news detailPid to themes.configuration.features.newsDefaultDetailPid
plugin.tx_csseo.sitemap.extensions.news.detailPid = {$themes.configuration.features.newsDefaultDetailPid}

# In case of using development mode, unset page.meta.robots.if, added in cs_seo
[globalVar = LIT:1 = {$themes.configuration.isDevelopment}]
    page.meta.robots.if >
[global]

# Disable title generation on news pages
[globalVar = GP:tx_news_pi1|news > 0] || [globalVar = GP:tx_news_pi1|overwriteDemand|categories > 0] || [globalVar = GP:tx_news_pi1|overwriteDemand|tags > 0]
    page.headerData.654 >
    page.meta.description >
    config.titleTagFunction >
[globalVar = GP:tx_news_pi1|overwriteDemand|year > 0] && [globalVar = GP:tx_news_pi1|overwriteDemand|month > 0]
    page.headerData.654 >
    page.meta.description >
    config.titleTagFunction >
[global]
