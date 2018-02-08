(function(){
    Date.now = Date.now || function() { return +new Date; };
    function Tracker( options ){
        this.init( options );
        return this;
    };

    Tracker.prototype = {
        /* configurable variables */
        jQuerySrc:  '//code.jquery.com/jquery-1.8.3.min.js',
        track: [],
        filesRegExp: /\.(docx|doc|eps|jpg|png|svg|xls|ppt|pdf|xls|zip|txt|vsd|vxd|js|css|rar|exe|wma|mov|avi|wmv|mp3)$/,
        mailRegExp: /^(javascript:linkTo_UnCryptMailto|mailto:)/,
        debugFlag: 'pxadebug',
        loadJQueryMaxTries: 100,
        loadJQueryDelay: 100,
        whenAvailableInterval: 100,
        triggers: [],
        enabled: 0,
        gtm:0,
        relAsExternal:0,

        /* non configurable variables */
        jQueryScriptOutputted: false,
        loadjQueryTryCount: 0,
        setNoConflict: false,
        has_vimeo_window_event: false,

        init: function( options ){
            // override default values
            this.jQuerySrc = options.jQuerySrc || this.jQuerySrc;
            this.track = options.track || this.track;
            this.filesRegExp = options.filesRegExp || this.filesRegExp;
            this.mailRegExp = options.mailRegExp || this.mailRegExp;
            this.debugFlag = options.debugFlag || this.debugFlag;
            this.loadJQueryMaxTries = options.loadJQueryMaxTries || this.loadJQueryMaxTries;
            this.loadJQueryDelay = options.loadJQueryDelay || this.loadJQueryDelay;
            this.whenAvailableInterval = options.whenAvailableInterval || this.whenAvailableInterval;
            this.triggers = options.triggers || this.triggers;
            this.enabled = options.enabled || this.enabled;
            this.gtm = options.gtm || this.gtm;
            this.relAsExternal = options.relAsExternal || this.relAsExternal;
        },

        debugMode: function(){
            return getUrlVars()[this.debugFlag] == 1 || getCookie(this.debugFlag) == 1;
        },

        log: function(str){
            this.debugMode() && log(str);
        },

        push: function(event, category, action, label, value, nonInteraction){
            var tracker = this;
            if (this.debugMode()) {
                alert(
                    (isEmptyOrUndefined(event) ? '' : 'Event: ' + event + '\n') +
                    (isEmptyOrUndefined(category) ? '' : 'Category: ' + category + '\n') +
                    (isEmptyOrUndefined(action) ? '' : 'Action: ' + action + '\n') +
                    (isEmptyOrUndefined(label) ? '' : 'Label: ' + label + '\n') +
                    (isEmptyOrUndefined(value) ? '' : 'Value: ' + value + '\n') +
                    (isEmptyOrUndefined(nonInteraction) ? '' : 'nonInteraction: ' + nonInteraction + '\n')
                );
            } else {
                if (tracker.enabled == 1 && tracker.gtm === 1 && typeof(dataLayer) === 'object' && typeof(dataLayer.push) === 'function' ) {
                    dataLayer.push({
                        'event': 'GAevent',
                        'eventCategory': category,
                        'eventAction': action,
                        'eventLabel': label
                    });

                }
                else if (tracker.enabled == 1 && typeof(ga) === 'function') {

                    var track = {'hitType' : 'event'};
                    if(typeof category === 'string') track['eventCategory'] = category;
                    if(typeof action === 'string') track['eventAction'] = action;
                    if(typeof label === 'string') track['eventLabel'] = label;
                    if(typeof value === 'string') track['eventValue'] = value;
                    if(typeof nonInteraction === 'boolean' && nonInteraction === true) {
                        ga('set', 'nonInteraction', true);
                    }
                    ga('send', track);

                } else if (tracker.enabled == 1 && typeof(_gaq) != 'undefined'){
                    _gaq.push([event, category, action, label, value, nonInteraction]);
                }
            }
        },

        errorLoadingJQuery: function() {
            // alert('Error loading jQuery');
        },

        startTracking: function() {

            var tracker = this;
            // load jQuery if it's not avaiable
            if(typeof jQuery  == 'undefined'){
                this.loadjQueryTryCount++;
                if(!this.jQueryScriptOutputted){
                    this.jQueryScriptOutputted = true;
                    document.write('<script src="' + this.jQuerySrc + '" type="text/javascript"><\/script>');
                    this.setNoConflict = true;
                }
                this.loadjQueryTryCount < this.loadJQueryMaxTries ? setTimeout(this.startTracking.bind(this), this.loadJQueryDelay) : this.errorLoadingJQuery();

            } else {
                // jQuery loaded
                this.debugMode() && log('Tracking script running in debug mode');
                if(this.setNoConflict) jQuery.noConflict();

                jQuery(function($) {
                    for (var index in tracker.track) {
                        if (tracker.track.hasOwnProperty(index)) {
                            typeof tracker.track[index].func && tracker['track' + tracker.track[index].func]($, tracker.track[index]);
                        }
                    }
                });
            }

        },

        trackCustom: function($) {
            var tracker = this;
            for (i = 0; i < tracker.triggers.length; i++) {
                // TYPO3 pages
                if (isInt(tracker.triggers[i].selector)) {
                    if ($('#T3PageId').size() > 0 && tracker.triggers[i].selector == $('#T3PageId').attr('value')) {
                        var trigger = tracker.triggers[i];
                        if (typeof(trigger.label) != 'undefined' && trigger.label.indexOf('ATTR:') != -1) {
                            var attr = trigger.label.substring(5).toLowerCase();
                            trigger.label = $('#T3PageId').attr(attr);
                        }
                        tracker.push('_trackEvent', trigger.category, trigger.action, trigger.label, trigger.value, trigger.nonInteraction);
                    }
                } else {
                    tracker.log('Track selector: ' + tracker.triggers[i].selector);
                    if (typeof($(tracker.triggers[i].selector).live) == 'function') {
                        // Selectors
                        $(tracker.triggers[i].selector).live('click', {index: i}, function(event) {
                            var trigger = tracker.triggers[event.data.index];
                            var label = trigger.label;
                            if (typeof trigger.label == 'function') {
                                label = trigger.label($(this)) ;
                            }
                            tracker.push('_trackEvent', trigger.category, trigger.action, label, trigger.value, trigger.nonInteraction);
                        });
                    } else {
                        $(document).on('click', tracker.triggers[i].selector, {index: i}, function(event) {
                            var trigger = tracker.triggers[event.data.index];
                            var label = trigger.label;
                            if (typeof trigger.label == 'function') {
                                label = trigger.label($(this)) ;
                            }
                            tracker.push('_trackEvent', trigger.category, trigger.action, label, trigger.value, trigger.nonInteraction);
                        });
                    }
                }
            }
        },

        trackEmail: function($, opts){
            var tracker = this;
            $('a').filter(function() { return tracker.mailRegExp.test(this.href) }).bind('click', function(){
                var mailto;
                var decryptOffset = opts.decryptOffset || 2; // TYPO3 6 uses 3 instead of 2

                // encrypted typo3 mailto that needs to be decrypted
                if (this.href.indexOf('linkTo_UnCryptMailto') != -1 && typeof decryptString == 'function' && typeof decryptCharcode == 'function'){
                    mailto = this.href.split('javascript:linkTo_UnCryptMailto(\'')[1].slice(0, - 3);
                    mailto = decryptString(mailto , decryptOffset);
                } else {
                    mailto = this.href;
                }
                tracker.push('_trackEvent', opts.category, mailto.split('mailto:')[1], document.URL, opts.value, opts.nonInteraction);
            });
        },

        trackFormSubmit: function($, opts){
            var tracker = this;
            $('form').bind('submit', function(e){
                tracker.push('_trackEvent', opts.category, $(this).attr('action'), document.URL, opts.value, opts.nonInteraction);
            });
        },

        trackDownloads: function($, opts){
            var tracker = this;
            $('a').filter(function() { return tracker.filesRegExp.test(this.href.toLowerCase()) }).bind('click', function(){
                var extArr = this.href.split('.');
                var ext = extArr[extArr.length-1].toLowerCase();
                tracker.push('_trackEvent', opts.category, ext, toAbsURL(this.href), opts.value, opts.nonInteraction);
            });
        },

        trackExternalLinks: function($, opts){
            var tracker = this;
            $('a').filter(function() {
                if( typeof($(this).attr('href')) == 'undefined' ) return false;
                if( $(this).data("notracking") ) return false;
                var l = this;
                if ((l.protocol === 'http:' || l.protocol === 'https:') && String.prototype.indexOf.call(l.hostname, document.location.hostname) === -1) {
                    var path = (l.pathname + l.search + ''),
                        utm = String.prototype.indexOf.call(path, '__utm');
                    if (utm !== -1) {
                        path = path.substring(0, utm);
                    }
                    return true;
                }
            }).bind('click', function(e){

                if( $(this).attr('target') == '_blank' || tracker.relAsExternal === 1  || ( typeof $(this).attr('onlick') !== "undefined" && $(this).attr('onclick').indexOf("javascript:") > -1 )){
                    tracker.push('_trackEvent', opts.category, opts.action, this.href, opts.value, opts.nonInteraction);
                } else {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    tracker.push('_trackEvent', opts.category, opts.action, this.href, opts.value, opts.nonInteraction);
                    if ($(this).data('rel') !== 'popup') {
                        setTimeout(function(){
                            location.href = url;
                        }, 250);
                    }
                }
            });
        },

        trackT3Search: function($, opts) {
            var tracker = this;
            if (typeof $(opts.swordCont).size === 'function' && $(opts.swordCont).size() > 0) {
                tracker.push('_trackPageview', '/?q=' + $(opts.swordCont).attr('value'));
            }
        },

        trackT3Print: function($, opts) {
            var tracker = this;
            if (getUrlVars()[opts.trigger] == 1) {
                tracker.push('_trackEvent', opts.category, opts.action, document.URL, opts.value, opts.nonInteraction);
            }
        },

        trackTwitter: function($, opts) {
            var tracker = this;
            whenAvailable('twttr', function(twttr) {
                twttr.ready(function (twttr) {
                    twttr.events.bind('click', function(event) {
                        tracker.push('_trackEvent', opts.category, opts.action, extractParamFromUri(event.target.src, 'url'), opts.value, opts.nonInteraction);
                    });
                });
            });
        },

        trackFacebook: function($, opts){
            var tracker = this;
            whenAvailable('FB', function(FB){
                FB.Event.subscribe("edge.create", function(href, widget) {
                    tracker.push('_trackEvent', opts.category, opts.action, href, opts.value, opts.nonInteraction);
                });
            });
        },

        trackSnapEngage: function($, opts){
            var tracker = this;
            if(typeof SnapABug != 'undefined' && SnapABug.setCallback){
                SnapABug.setCallback('Open', function(type) {
                    tracker.push('_trackEvent', opts.category, opts.action, document.URL, opts.value, opts.nonInteraction);
                });
            }
        },

        trackAddThis: function($, opts){
            var tracker = this;
            whenAvailable('addthis', function(addthis){
                addthis.addEventListener('addthis.menu.share', function(e){
                    if(e.type == 'addthis.menu.share'){
                        tracker.push('_trackEvent', opts.category, e.data.service, document.URL, opts.value, opts.nonInteraction);
                    }
                });
            });
        },

        trackYouTube: function($, opts){
            var tracker = this;
            var force = opts['force'];
            if (force) {
                try {
                    _ytMigrateObjectEmbed();
                }catch (e) {
                    log(e);
                }
            }

            var youtube_videos = [];
            var iframes = document.getElementsByTagName('iframe');
            for (var i = 0; i < iframes.length; i++) {
                if (String.prototype.indexOf.call(iframes[i].src, '//www.youtube.com/embed') > -1) {
                    if (String.prototype.indexOf.call(iframes[i].src, 'enablejsapi=1') < 0) {
                        if (force) {
                            // Reload the video enabling the api
                            if (String.prototype.indexOf.call(iframes[i].src, '?') < 0) {
                                iframes[i].src += '?enablejsapi=1';
                            } else {
                                iframes[i].src += '&enablejsapi=1';
                            }
                        } else {
                            // We can't track players that don't have api enabled.
                            continue;
                        }
                    }
                    youtube_videos.push(iframes[i]);
                }
            }

            if (youtube_videos.length > 0) {
                // this function will be called when the youtube api loads
                window['onYouTubePlayerAPIReady'] = function () {
                    var p;
                    for (var i = 0; i < youtube_videos.length; i++) {
                        p = new window['YT']['Player'](youtube_videos[i]);
                        p.addEventListener('onStateChange', function(event){
                            if(event['data'] == 1){ // 1 = play
                                tracker.push('_trackEvent', opts.category, document.URL, event['target'].getVideoUrl(), opts.value, opts.nonInteraction);
                            }
                        });
                    }
                };
                // load the youtube player api
                var tag = document.createElement('script');
                //XXX use document.location.protocol
                var protocol = 'http:';
                if (document.location.protocol === 'https:') {
                    protocol = 'https:';
                }
                tag.src = protocol + '//www.youtube.com/player_api';
                tag.type = 'text/javascript';
                tag.async = true;
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            }
        },

        trackHTML5Video: function($, opts){
            var tracker = this;
            if(document.addEventListener){ // < ie9
                $('video').each(function(){
                    $(this).get(0).addEventListener('play',function(e){
                        var src = e.target.currentSrc;
                        tracker.push('_trackEvent', opts.category, document.URL, src, opts.value, opts.nonInteraction);
                    }, false);
                });
            }
        },

        trackVimeo: function($, opts){
            var tracker = this;
            var force = opts['force'];
            var iframes = document.getElementsByTagName('iframe');
            var playersSrc = [];
            // vimeo api
            var Froogaloop=function(){function e(a){return new e.fn.init(a)}function h(a,c,b){if(!b.contentWindow.postMessage)return!1;var f=b.getAttribute("src").split("?")[0],a=JSON.stringify({method:a,value:c});"//"===f.substr(0,2)&&(f=window.location.protocol+f);b.contentWindow.postMessage(a,f)}function j(a){var c,b;try{c=JSON.parse(a.data),b=c.event||c.method}catch(f){}"ready"==b&&!i&&(i=!0);if(a.origin!=k)return!1;var a=c.value,e=c.data,g=""===g?null:c.player_id;c=g?d[g][b]:d[b];b=[];if(!c)return!1;void 0!==a&&b.push(a);e&&b.push(e);g&&b.push(g);return 0<b.length?c.apply(null,b):c.call()}function l(a,c,b){b?(d[b]||(d[b]={}),d[b][a]=c):d[a]=c}var d={},i=!1,k="";e.fn=e.prototype={element:null,init:function(a){"string"===typeof a&&(a=document.getElementById(a));this.element=a;a=this.element.getAttribute("src");"//"===a.substr(0,2)&&(a=window.location.protocol+a);for(var a=a.split("/"),c="",b=0,f=a.length;b<f;b++){if(3>b)c+=a[b];else break;2>b&&(c+="/")}k=c;return this},api:function(a,c){if(!this.element||!a)return!1;var b=this.element,f=""!==b.id?b.id:null,d=!c||!c.constructor||!c.call||!c.apply?c:null,e=c&&c.constructor&&c.call&&c.apply?c:null;e&&l(a,e,f);h(a,d,b);return this},addEvent:function(a,c){if(!this.element)return!1;var b=this.element,d=""!==b.id?b.id:null;l(a,c,d);"ready"!=a?h("addEventListener",a,b):"ready"==a&&i&&c.call(null,d);return this},removeEvent:function(a){if(!this.element)return!1;var c=this.element,b;a:{if((b=""!==c.id?c.id:null)&&d[b]){if(!d[b][a]){b=!1;break a}d[b][a]=null}else{if(!d[a]){b=!1;break a}d[a]=null}b=!0}"ready"!=a&&b&&h("removeEventListener",a,c)}};e.fn.init.prototype=e.fn;window.addEventListener?window.addEventListener("message",j,!1):window.attachEvent("onmessage",j);return window.Froogaloop=window.$f=e}();

            // add api=1 to vimeo iframes
            for (var i = 0; i < iframes.length; i++) {
                if (String.prototype.indexOf.call(iframes[i].src, '//player.vimeo.com') > -1) {
                    player_id = 'pxa_vimeo' + i;
                    player_src = iframes[i].src;
                    playersSrc[player_id] = iframes[i].src;
                    separator = '?';
                    if (String.prototype.indexOf.call(player_src, '?') > -1) {
                        separator = '&';
                    }
                    if (String.prototype.indexOf.call(player_src, 'api=1') < 0) {
                        if (force) {
                            // Reload the video enabling the api
                            player_src += separator + 'api=1&player_id=' + player_id;
                        } else {
                            // We won't track players that don't have api enabled.
                            continue;
                        }
                    } else {
                        player_src += separator + 'player_id=' + player_id;
                    }
                    iframes[i].id = player_id;
                    iframes[i].src = player_src;

                    $('#' + player_id).addClass('pxa_vimeo');
                }
            }

            $('.pxa_vimeo').each(function(){
                var player = $f( $(this).get(0) );
                var src = playersSrc[$(this).attr('id')];
                player.addEvent('ready', function(e) {
                    player.addEvent('play', function(){
                        tracker.push('_trackEvent', opts.category, document.URL, src, opts.value, opts.nonInteraction);
                    });
                });
            });

        },
        trackZopim: function($, opts){
            var tracker = this;
            if(typeof $zopim != 'undefined'){
                $zopim(function() {

                    $zopim.livechat.window.onShow(function(){
                        tracker.push('_trackEvent', opts.category, opts.action, document.URL, opts.value, opts.nonInteraction);

                    });
                });
            }
        },
        trackScroll : function($, opts){

            var tracker = this;

            // Default time delay before checking location
            var callBackTime = 500;
            var scrollElement;
            if (typeof opts.callBackTime !== "undefined" && isNaN(parseInt(opts.callBackTime)) === false) {
                callBackTime = opts.callBackTime;
            }

            if (typeof opts.elementSelector !== "undefined" && $(opts.elementSelector).length > 0) {
                scrollElement = $(opts.elementSelector)[0];
            }
            else {
                scrollElement = document.body;
            }


            // Set some flags for tracking & execution
            var timer = 0;


            var twentyFive= false;
            var fifty = false;
            var seventyFive = false;
            var hundred = false;

            // Set some time variables to calculate reading time
            var startTime = new Date();
            var beginning = startTime.getTime();



            // Track the scrolling and track location
            $(window).scroll(function() {
                if (timer) {
                    clearTimeout(timer);
                }

                // Use a buffer so we don't call trackLocation too often.
                timer = setTimeout(function(){

                    var percent =  Math.abs(document.body.scrollTop / (scrollElement.clientHeight - window.innerHeight) * 100);

                    if ( percent >= 25 && !twentyFive) {
                        twentyFive = true;
                        tracker.push('_trackEvent', opts.category, "25", document.URL, opts.value, opts.nonInteraction);

                    }
                    else if (percent >= 50 && !fifty) {
                        fifty = true;
                        tracker.push('_trackEvent', opts.category, "50", document.URL, opts.value, opts.nonInteraction);
                    }
                    else if (percent >= 75 && !seventyFive) {
                        seventyFive = true;
                        tracker.push('_trackEvent', opts.category, "75", document.URL, opts.value, opts.nonInteraction);
                    }
                    else if (percent >= 100 && !hundred) {
                        hundred = true;
                        tracker.push('_trackEvent', opts.category, "100", document.URL, opts.value, opts.nonInteraction);
                    }

                }, callBackTime);
            });

        },
        trackPrint : function($, opts){

            var tracker = this;

            if (typeof window.onbeforeprint !== "undefined") {
                window.onbeforeprint = function(e) {
                    tracker.push('_trackEvent', opts.category, document.URL);
                }
            }
            else if(typeof window.matchMedia === "function") {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function(mql) {
                    if (mql.matches) {
                        tracker.push('_trackEvent', opts.category, document.URL);
                    };
                });
            }

        }

    }

    function whenAvailable(name, callback) {
        window.setTimeout(function() {
            if (window[name]) {
                callback(window[name]);
            } else {
                window.setTimeout(arguments.callee, this.whenAvailableInterval);
            }
        }, this.whenAvailableInterval);
    }

    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function setCookie(c_name,value,exdays){
        var exdate=new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
        document.cookie=c_name + "=" + c_value + "; path=/";
    }

    function getCookie(c_name){
        var i,x,y,ARRcookies=document.cookie.split(";");
        for (i=0;i<ARRcookies.length;i++) {
            x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
            y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
            x=x.replace(/^\s+|\s+$/g,"");
            if (x==c_name){
                return unescape(y);
            }
        }
    }

    function isEmptyOrUndefined(testObj){
        return typeof testObj == 'undefined' || testObj == '';
    }

    function extractParamFromUri(uri, paramName) {
        if (!uri) {
            return;
        }
        var regex = new RegExp('[\\?&#]' + paramName + '=([^&#]*)');
        var params = regex.exec(uri);
        if (params != null) {
            return unescape(params[1]);
        }
        return;
    }

    function log(str){
        window.console && console.log(str);
    }

    function toAbsURL(s) {
        var l = location, h, p, f, i;
        if (/^\w+:/.test(s)) {
            return s;
        }
        h = l.protocol + '//' + l.host;
        if (s.indexOf('/') == 0) {
            return h + s;
        }
        p = l.pathname.replace(/\/[^\/]*$/, '');
        f = s.match(/\.\.\//g);
        if (f) {
            s = s.substring(f.length * 3);
            for (var i = f.length;i>0;i--){
                p = p.substring(0, p.lastIndexOf('/'));
            }

        }
        return h + p + '/' + s;
    }

    function isInt(n) {
        return n % 1 === 0;
    }

    // custom triggers
    function Trigger(selector, category, action, label, value, nonInteraction){
        this.selector = selector;
        this.category = category;
        this.action = action;
        this.label = label;
        this.value = value;
        this.nonInteraction = nonInteraction;
    }
    var triggers = new Array();

    /**
     * Looks for object/embed youtube videos and migrate them to the iframe method
     */
    function _ytMigrateObjectEmbed() {
        var objs = document.getElementsByTagName('object');
        var pars, ifr, ytid;
        var r = /(https?:\/\/www\.youtube(-nocookie)?\.com[^\/]*).*\/v\/([^&?]+)/;

        for (var i = 0; i < objs.length; i++) {
            pars = objs[i].getElementsByTagName('param');
            for (var j = 0; j < pars.length; j++) {
                if (pars[j].name === 'movie' && pars[j].value) {
                    // Replace the object with an iframe
                    ytid = pars[j].value.match(r);
                    if (ytid && ytid[1] && ytid[3]) {
                        ifr = document.createElement('iframe');
                        ifr.src = ytid[1] + '/embed/' + ytid[3] + '?enablejsapi=1';
                        ifr.width = objs[i].width;
                        ifr.height = objs[i].height;
                        ifr.setAttribute('frameBorder', '0');
                        ifr.setAttribute('allowfullscreen', '');
                        objs[i].parentNode.insertBefore(ifr, objs[i]);
                        objs[i].parentNode.removeChild(objs[i]);
                        // Since we removed the object the Array changed
                        i--;
                    }
                    break;
                }
            }
        }

    }



    var t = new Tracker ({
        triggers: triggers,
        track: [
            {'func': 'Custom'},
            {'func': 'Email', 'category': 'Mail'},
            {'func': 'FormSubmit', 'category': 'Form-submit'},
            {'func': 'Downloads', 'category': 'Downloads'},
            {'func': 'ExternalLinks', 'category': 'Outbound links', 'action': 'Click'},
            {'func': 'T3Search', 'swordCont': '.tx-indexedsearch-searchbox-sword'},
            {'func': 'T3Print', 'category': 'Print', 'action': 'Page', 'trigger': 'print'},
            {'func': 'Twitter', 'category': 'Social', 'action':  'Twitter'},
            {'func': 'Facebook', 'category': 'Social', 'action': 'Facebook'},
            {'func': 'SnapEngage', 'category': 'Chat', 'action': 'Snapengage'},
            {'func': 'AddThis', 'category': 'AddThis'},
            {'func': 'YouTube', 'category': 'Video', 'force': true},
            {'func': 'HTML5Video', 'category': 'Video'},
            {'func': 'Vimeo', 'category': 'Video','force': true}
        ],
        enabled: 1
    });


    // site specific tracking
    Tracker.prototype.trackTest = function($, opts){
        var tracker = this;
        //tracker.push('_trackEvent', opts.category, opts.action, opts.label, opts.value, opts.nonInteraction);
    };

    // start tracking
    t.startTracking();

}());
