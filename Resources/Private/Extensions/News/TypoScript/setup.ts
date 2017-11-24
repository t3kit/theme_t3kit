plugin.tx_news.settings.defaultDetailPid = {$themes.configuration.features.newsDefaultDetailPid}
plugin.tx_news.settings.detail.media.image.lightbox.class = {$styles.content.textmedia.linkWrap.lightboxCssClass}

plugin.tx_news.settings.newsCarousel.cropMaxCharacters = 136

plugin.tx_news.settings.card.cropMaxCharacters = 200

plugin.tx_news.settings.simpleList.cropMaxCharacters = 280

plugin.tx_news.settings.timeline.cropMaxCharacters = 500

plugin.tx_news.settings.list.media.dummyImage = EXT:theme_t3kit/Resources/Public/Extensions/News/images/no_image.png

plugin.tx_news.settings.detail.shariff < tt_content.list.20.rxshariff_shariff.settings
plugin.tx_news.settings.detail.shariff {
    # If extension rx_shariff is loaded, define services here for news detail page
    # twitter,facebook,googleplus,linkedin,xing,pinterest,whatsapp,mail,addthis,tumblr,flattr,diaspora,reddit,stumbleupon,threema,info
    services = facebook,twitter,whatsapp
}

plugin.tx_news.settings.detail.showPrevNext = 1
# show a file type icon above the file name
plugin.tx_news.settings.detail.showRelatedFileIcon = 0

# Lightbox data-caption attribute settings for use in Partials/Detail/MediaImage.html
plugin.tx_news.settings {
    detail.media.image.lightbox {
        glue = {$lightbox.dataCaption.glue}
        includeTitle = {$lightbox.dataCaption.includeTitle}
        includeDescription = {$lightbox.dataCaption.includeDescription}
        includeCopyright = {$lightbox.dataCaption.includeCopyright}
        labelCopyright = {$lightbox.dataCaption.labelCopyright}
    }
}
