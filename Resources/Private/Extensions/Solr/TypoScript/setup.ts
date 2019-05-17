
# Solr
# Notes:
# The scheduler task is disabled by default

# enable solr
plugin.tx_solr.enabled = {$themes.configuration.features.enableSolr}

# Solr default ts setup
plugin.tx_solr.search.faceting = 1
plugin.tx_solr.search.spellchecking = 1

plugin.tx_solr.search.results.resultsHighlighting = 1
plugin.tx_solr.search.results.resultsHighlighting.wrap = <mark>|</mark>
plugin.tx_solr.search.sorting = 1
plugin.tx_solr.search.targetPage = {$themes.configuration.features.searchTargetPage}


plugin.tx_solr.solr {
    read.path = /solr/{$themes.configuration.features.solrBaseCoreName}_{$themes.languages.default.isoCodeShort}/
    write.path < .read.path
}

[globalVar = GP:L > 0]
    plugin.tx_solr.solr {
        read.path = /solr/{$themes.configuration.features.solrBaseCoreName}_{$themes.languages.current.isoCodeShort}/
        write.path < .read.path
    }
[end]

# Add teaser to search query
plugin.tx_solr.search.query.queryFields := addToList(abstract^39.0)
plugin.tx_solr.index.queue {
    news.fields.content.cObject {
        5 = TEXT
        5 {
            field = teaser
            noTrimWrap = || |
            stdWrap.wrap = | [...]
        }
    }
}

plugin.tx_solr {
    view {
        pluginNamespace = tx_solr

        templateRootPaths {
            50 = EXT:theme_t3kit/Resources/Private/Extensions/Solr/Templates
        }
        partialRootPaths {
            50 = EXT:theme_t3kit/Resources/Private/Extensions/Solr/Partials
        }
        layoutRootPaths {
            50 = EXT:theme_t3kit/Resources/Private/Extensions/Solr/Layouts
        }
    }

    _LOCAL_LANG {
        sv {
            faceting_resultsNarrowedBy = Sökning begränsad på
        }
    }
}

## TEST
#plugin.tx_solr.general.dateFormat.date =
## Just to check pagination with many pages
#plugin.tx_solr.search.results.resultsPerPageSwitchOptions = 2,10,25,50
#plugin.tx_solr.search.results.pagebrowser.pagesBefore = 2
#plugin.tx_solr.search.results.pagebrowser.pagesAfter = 2

## Test to enable solr features to see if template is correct
plugin.tx_solr.statistics = 0
#plugin.tx_solr.search.frequentSearches = 1
#plugin.tx_solr.search.lastSearches = 1
#plugin.tx_solr.logging.query.searchWords = 1

## Fix query for latest
#plugin.tx_solr.search.frequentSearches.select.ADD_WHERE = AND num_found > 0

## Solr tools
plugin.tx_solr.search.results.showDocumentScoreAnalysis = 0
#plugin.tx_solr.search.frequentSearches.select.ORDER_BY =
#plugin.tx_solr.search.frequentSearches.select.ADD_WHERE =

## Test to add more filters
plugin.tx_solr.search.faceting.facets.category.field = category_stringM
plugin.tx_solr.search.faceting.facets.category.label = TEXT
plugin.tx_solr.search.faceting.facets.category.label.data = LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:category

plugin.tx_solr.search.faceting.facets.type {
    renderingInstruction = CASE
    renderingInstruction {
        key.field = optionValue
        # pages
        pages = TEXT
        pages.value = {LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:pages}
        pages.insertData = 1
        # tx_news
        tx_news_domain_model_news = TEXT
        tx_news_domain_model_news.value = {LLL:EXT:news/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news}
        tx_news_domain_model_news.insertData = 1
    }
}

plugin.tx_solr.index.queue.pages.fields.category_stringM = SOLR_RELATION
plugin.tx_solr.index.queue.pages.fields.category_stringM {
    localField = categories
    multiValue = 1
}


# Additional when solr is enabled
[globalVar = LIT:1 = {$themes.configuration.features.enableSolr}]

    config.index_enable = 1

[global]

## Docker configuration
[applicationContext = Development/Docker, Production/Docker]
    # set solr host to t3kit_solr
    plugin.tx_solr.solr {
        read.host = t3kit_solr
        write.host = t3kit_solr
    }
[global]

# enable suggest on devices with touch support
#page.jsInline {
#  1910 = TEXT
#  1910.value = var forceEnableSuggest = false;
#}


<INCLUDE_TYPOSCRIPT: source="DIR:EXT:theme_t3kit/Resources/Private/Extensions/Solr/TypoScript/IndexConfiguration/" extensions="typoscript">
<INCLUDE_TYPOSCRIPT: source="DIR:EXT:theme_t3kit/Resources/Private/Extensions/Solr/TypoScript/Includes/" extensions="typoscript">
