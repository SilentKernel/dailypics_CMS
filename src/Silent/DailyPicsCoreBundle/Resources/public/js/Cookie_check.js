// This file generate the "cookie notification" for European Law

// This is the string used with LocalStorage (HTML5)
// We use LocalStorage instead of a simple cookie because the server does not need
// this information (cookies are sent at every request to the server, not localStorage, save bandwith)
const LSCString = "cns";

// don't remake Ajax call when "more info" was showed once
var cookieMoreInfoShown = false;

// GAfunction
var _gaq = _gaq || [];

function prepareGA(gaID) {
    if (gaID != ""){
        _gaq.push(['_setAccount', gaID]);
        _gaq.push(['_trackPageview']);
    }
}

function loadGA()
{
    if (_gaq.length == 2) {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    }
}

function acceptCookies(lang)
{
    // Will put a string in localStorage to prevent showing the notification again
    localStorage.setItem(LSCString, 1);
    loadGA();
    loadTwitter(lang);
    loadGPlus();
    var cookieNotificationPanel = $("#cookie_notification_panel");
    cookieNotificationPanel.fadeOut('slow',function(){
        cookieNotificationPanel.remove();
    })
}

function cookiesMoreInfo()
{
    if (!cookieMoreInfoShown) {
        $.get( Routing.generate('quote_cms_core_cookie_more_infos',null), function(data) {
            $( "#main_container" ).prepend(data);
            cookieMoreInfoShown = true;
            $('#cookiesinfo').modal();
        });
    }
    else $('#cookiesinfo').modal();
}

function showCookiesNotification(customMessage, customAcceptBtn, declineUrl, customDeclineBtn, customInfoButn, gaID, lang)
{
    // Preparing GA (not loaded at this time
    prepareGA(gaID);

    // Show only if client did not accepted Cookies (with local storage)
    if (localStorage.getItem(LSCString) != 1)
    {
        $( "#main_container" ).prepend(
            '<div id="cookie_notification_panel" class = "panel panel-default panel-body text-center"> '+
            '<p>' + customMessage + '</p>' +
            "<a class = 'btn btn-success' onclick='acceptCookies(\"" + lang + "\")'>"+ customAcceptBtn +"</a> " +
            "<a class = 'btn btn-primary' onclick='cookiesMoreInfo()'>"+ customInfoButn +"</a> " +
            "<a class = 'btn btn-danger' href='"+ declineUrl + "'>"+ customDeclineBtn +"</a>" +
            '</div>'
        );
    }
    else
    {
        loadGA();
        loadTwitter(lang);
        loadGPlus();
    }
}