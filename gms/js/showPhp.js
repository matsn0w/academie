var site = 'https://www.syntaxonline.nl/portal/gms'
var site = 'https://www.syntaxonline.nl/portal' // Wanneer je code 10 gaat

var Timer = setInterval(function () {

    $("#meldingen").load("includes/show-meldingen.php");//insert the new messages into a div in your html
    $(".checkingemeld").load("includes/checkingemeld.php");
    $("#kladblok").load("includes/show-kladblok.php");
    $("#statustab").load("includes/color-tabs.php");
    $("#infoboxstatus").load("includes/getStatus-eenheid.php");
}, 3000);

$(document).ready(function () {
    Timer;
    $("#meldingen").load("includes/show-meldingen.php");//insert the new messages into a div in your html
    $(".checkingemeld").load("includes/checkingemeld.php");
    $("#kladblok").load("includes/show-kladblok.php");
    $("#statustab").load("includes/color-tabs.php");
    $("#infoboxstatus").load("includes/getStatus-eenheid.php");
});


function alertsite(data) {
    $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">" + data + "</div>");
    setTimeout(function () {
        $('.alert').remove();
    }, 5000);
}

function changeIncGroep(uid, incid) {

    $.ajax({
        url: site + '/includes/gesprek-mover.php',
        data: {uid: uid, incid: incid},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Succesvol van gespreksgroep gewisseld!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });

}

function saveVrij() {
    $.ajax({
        url: site + '/includes/status.php?status=1',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">U bent weer beschikbaar</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
            $("#infoboxstatus").load("includes/getStatus-eenheid.php");
        }
    });
}

function saveTP() {
    $.ajax({
        url: site + '/includes/status.php?status=2',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">U bent ter plaatse</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
            $("#infoboxstatus").load("includes/getStatus-eenheid.php");
        }
    });
}

function saveTR() {
    $.ajax({
        url: site + '/includes/status.php?status=3',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">U doet een transportje</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
            $("#infoboxstatus").load("includes/getStatus-eenheid.php");
        }
    });
}

function spraak() {
    $.ajax({
        url: site + '/includes/spraak.php?type=1',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Spraakaanvraag ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function urgent() {
    $.ajax({
        url: site + '/includes/spraak.php?type=2',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\"><strong>URGENT</strong> Spraakaanvraag ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function tijdelijk() {
    $.ajax({
        url: site + '/includes/tijdelijk.php',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Tijdelijk uit-game!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function definitief() {
    $.ajax({
        url: site + '/includes/definitief.php',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Definitief uit-game!</div>");
            location.href = site2;
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function code4() {
    $.ajax({
        url: site + '/includes/spraak.php?type=3',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Code 4 verzonden!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function info() {
    $.ajax({
        url: site + '/includes/spraak.php?type=4',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Informatie aanvraag ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function asscollega() {
    $.ajax({
        url: site + '/includes/spraak.php?type=5',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\"><strong>URGENTE</strong> Assistentie collega Ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function politieverzoek() {
    $.ajax({
        url: site + '/includes/spraak.php?type=6',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Verzoek politie ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function brandweerverzoek() {
    $.ajax({
        url: site + '/includes/spraak.php?type=7',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Verzoek brandweer ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function ambulanceverzoek() {
    $.ajax({
        url: site + '/includes/spraak.php?type=8',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Verzoek ambulance ingediend!</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}

function toggleMelding() {
    $('#melding-maken').toggle("slow");
}

function sitrap() {
    $.ajax({
        url: site + '/includes/spraak.php?type=9',
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Sitrap aanvraag verzonden</div>");
            setTimeout(function () {
                $('.alert').remove();
            }, 5000);
        }
    });
}
