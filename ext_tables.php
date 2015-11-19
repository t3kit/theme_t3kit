<?php

if (TYPO3_MODE === 'BE') {
	/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
	$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
	$iconRegistry->registerIcon(
		'content-elements-accordion',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/accordion.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-contentElementSlider',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/slider.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-bigIconTextButton',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/bigIconTextButton.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-iconTextButton',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/iconTextButton.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-imageTextLink',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/imageTextLink.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-logoCarousel',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/logoCarousel.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-quote',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/quote.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-tabs',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/ContentElements/tabs.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-container',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/StructuredContentElements/advGridContainer.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-column',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/StructuredContentElements/advGridColumn.svg']
	);
	$iconRegistry->registerIcon(
		'content-elements-columns',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:theme_t3kit/Resources/Public/Icons/StructuredContentElements/columns.svg']
	);
}
