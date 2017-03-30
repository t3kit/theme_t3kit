/*global mainSearchInputList:true*/

// data for search suggest. For css styling
$(document).ready(function() {
    for (var key in mainSearchInputList) {
        if (mainSearchInputList.hasOwnProperty(key)) {
            mainSearchInputList[key]._list = ['map', 'home', 'content', 'Newsletter', 'subscription', 'tabs', 'accordion', 'carousel', 'icons', 'design', 'pxa', 'Pixelant', 'core', 't3layout', 'FElayout', 'bootstrap', 'pxa', 'search', 'contact', 'news', 'language', 'site', 'Pixalant', 'RTE', 'images', 'link', 'tablae', 'form', 'file', 'community', 'documentation', 'demo', 'customizer'];
        }
    }
});

