# use cs_seo sitetitle constant set from theme siteName
page.headerData.654.30.40 {
  data >
  value = {$plugin.tx_csseo.sitetitle}
}

# set cs_seo news detailPid to themes.configuration.features.newsDefaultDetailPid
plugin.tx_csseo.sitemap.extensions.news.detailPid = {$themes.configuration.features.newsDefaultDetailPid}

# In case of using development mode, unset page.meta.robots.if, added in cs_seo, also modify robots.txt to Disallow: /
[globalVar = LIT:1 = {$themes.configuration.isDevelopment}]
    page.meta.robots.if >

    pageCsSeoRobotsTxt.10 = TEXT
    pageCsSeoRobotsTxt.10.value (
User-agent: *
Disallow: /
)
[global]

# Disable title generation on news pages
[globalVar = GP:tx_news_pi1|news > 0]
    page.headerData.654 >
    page.meta.description >
    config.titleTagFunction >
    config.noPageTitle = 0
[global]
