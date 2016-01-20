
# Solr
# Notes:
# The scheduler task is disabled by default

# enable solr
plugin.tx_solr.enabled = {$themes.configuration.features.enableSolr}

# Solr default ts setup
plugin.tx_solr.suggest = 1
plugin.tx_solr.search.faceting = 1
plugin.tx_solr.search.spellchecking = 1
plugin.tx_solr.search.results.resultsHighlighting = 1
plugin.tx_solr.search.sorting = 1
plugin.tx_solr.search.targetPage = {$themes.configuration.features.searchTargetPage}
plugin.tx_solr.solr.path = /solr/{$themes.configuration.siteName}_{$themes.languages.default.isoCode}/

# Change solr core if language other than default
[globalVar = GP:L > 0]
    plugin.tx_solr.solr.path = /solr/{$themes.configuration.siteName}_{$themes.languages.current.isoCode}/
[global]


# Additional when solr is enabled
[globalVar = LIT:1 = {$themes.configuration.features.enableSolr}]

    config.index_enable = 1

    lib.searchbox >
    lib.searchbox < plugin.tx_solr_PiSearch_Search

[global]

