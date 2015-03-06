// This file generate the "cookie notification" for European Law

// This is the string used with LocalStorage (HTML5)
// We use LocalStorage instead of a simple cookie because the server does not need
// this information (cookies are sent at every request to the server, not localStorage, save bandwith)
const LSCString = "cns";

// don't remake Ajax call when "more info" was showed once
var cookieMoreInfoShown = false;

function acceptCookies()
{
    // Will put a string in localStorage to prevent showing the notification again
    localStorage.setItem(LSCString, 1);
    $("#cookie_notification").html("");
}

function cookiesMoreInfo()
{
    if (!cookieMoreInfoShown) {
        $.get( Routing.generate('cookie_warning_more_info',null), function(data) {
            $( "#main_container" ).prepend(data);
            cookieMoreInfoShown = true;
            $('#cookiesinfo').modal();
        });
    }
    else $('#cookiesinfo').modal();
}

function showCookiesNotification(customMessage, customAcceptBtn, declineUrl, customDeclineBtn, customInfoButn)
{
    // Show only if client did not accepted Cookies (with local storage)
    if (localStorage.getItem(LSCString) != 1)
    {
        $( "#main_container" ).prepend(
            '<div id = "cookie_notification" class = "col-xs-12 col-sm-12 col-md-12 col-lg-12"> ' +
                '<div class = "panel panel-default text-center"> <br />' +
                    '<p>' + customMessage + '</p>' +
                    "<a class = 'btn btn-success' onclick='acceptCookies()'>"+ customAcceptBtn +"</a> " +
                    "<a class = 'btn btn-primary' onclick='cookiesMoreInfo()'>"+ customInfoButn +"</a> " +
                    "<a class = 'btn btn-danger' href='"+ declineUrl + "'>"+ customDeclineBtn +"</a>" +
                '<br /><br /></div>' +
            '</div>'
        );
    }
}