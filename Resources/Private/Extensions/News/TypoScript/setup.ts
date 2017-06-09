plugin.tx_news {
	settings {
		defaultDetailPid = {$themes.configuration.features.newsDefaultDetailPid}
		newsCarousel.cropMaxCharacters = 136
		card.cropMaxCharacters = 200
		simpleList.cropMaxCharacters = 280
		timeline.cropMaxCharacters = 500
		list {
			media.dummyImage = typo3conf/ext/theme_t3kit/Resources/Public/Extensions/News/images/no_image.png
			publisher.logo = {$themes.configuration.header.logo.main.file}
		}
		detail {
			media.image.lightbox.class = {$styles.content.textmedia.linkWrap.lightboxCssClass}
		}
	}
}
