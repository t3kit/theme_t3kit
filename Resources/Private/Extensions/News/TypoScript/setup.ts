# **********************************************************
#  EXT:news
# **********************************************************

plugin.tx_news {
  settings {
    thumbnail {
      # 2,3 or 4 columns
      columns = 2
      width = 400
      height = 250
    }
    mediaObject {
      width = 100
      height = 100
    }

    lazyload.enable = 0
    lightbox.enable = 0
    lightbox.slideshow = 0
  }
  _LOCAL_LANG.de {
    dateFormat = %d. %B %Y
  }
}
