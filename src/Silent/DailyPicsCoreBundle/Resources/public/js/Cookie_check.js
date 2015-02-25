// This file generate the "cookie notification" for European Law

// This is the string used with LocalStorage (HTML5)
// We use LocalStorage instead of a simple cookie because the server does not need
// this information (cookies are sent at every request to the server, not localStorage, save bandwith)
const LSCString = "cns";

function acceptCookie()
{
    // Will put a string in localStorage to prevent showing the notification again
    localStorage.setItem(LSCString, 1);
    $("#cookie_notification").html("");
}

function declineCookie()
{
    // redirect client on an other website (will be customisable when it will be done)
    window.location.replace("https://google.com");
}

// This function will get parameters later
// to allow people to change the message from parameters.yml,
// we will also allow webmaster to add a "more info" link
function showCookieNotification()
{
    // Show only if client did not accepted Cookies (with local storage)
    if (localStorage.getItem(LSCString) != 1)
    {
        $( "#main_container" ).prepend
        (
            '<div id = "cookie_notification" class = "col-xs-12 col-sm-12 col-md-12 col-lg-12"> ' +
                '<div class = "alert alert-dismissible alert-info text-center">' +
                    "Ce site utilise les cookies pour fonctionner, acceptez vous l'utilisation des cookies ?" +
                    "<br />" +
                    "<a class = 'btn btn-success' onclick='acceptCookie()'>J'accepte</a> " +
                    "<a class = 'btn btn-danger' onclick='declineCookie()'>Je refuse</a>" +
            '</div>' +
            '</div>'
        );
    }
}

// to be removed soon
showCookieNotification();