<?php
declare(strict_types=1);

namespace T3kit\themeT3kit\Hooks\Solr;

use TYPO3\CMS\Core\Exception\SiteNotFoundException;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class PageIndexerDataUrlModifier
 * @package T3kit\themeT3kit\Hooks\Solr
 */
class PageIndexerDataUrlModifier implements \ApacheSolrForTypo3\Solr\IndexQueue\PageIndexerDataUrlModifier
{
    /**
     * @var SiteFinder
     */
    protected $siteFinder = null;

    /**
     * Initialize
     */
    public function __construct()
    {
        $this->siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
    }

    /**
     * Modifies the given data url
     *
     * @param string $pageUrl the current data url.
     * @param array $urlData An array of url data
     * @return string the final data url
     */
    public function modifyDataUrl($pageUrl, array $urlData)
    {
        $pageId = (int)$urlData['pageId'];
        try {
            $this->siteFinder->getSiteByPageId($pageId);

            // If config exist apply typolink
            $url = GeneralUtility::makeInstance(ContentObjectRenderer::class)->typolink_URL([
                'parameter' => $pageId,
                'language' => $urlData['language'],
                'forceAbsoluteUrl' => true,
            ]);

            return empty($url) ? $pageUrl : $url;
        } catch (SiteNotFoundException $exception) {
            return $pageUrl;
        }
    }
}
