# **********************************************************
#  EXT:news
# **********************************************************

plugin.tx_news {
  view {
    # cat=plugin.tx_news/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:theme_t3kit/Resources/Private/Extensions/News/Templates/
    # cat=plugin.tx_news/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:theme_t3kit/Resources/Private/Extensions/News/Partials/
    # cat=plugin.tx_news/file; type=string; label=Path to layouts (FE)
    layoutRootPath = EXT:theme_t3kit/Resources/Private/Extensions/News/Layouts/
  }

  settings {
    # cat=plugin.tx_news/file; type=string; label=Path to CSS file
    cssFile = EXT:theme_t3kit/Resources/Public/Extensions/News/Css/News.css
  }
}