var site = 'https://www.syntaxonline.nl/portal/gms'

$(function () {
    $("#melding-mk").load("includes/mk-meldingen.php");//insert the new messages into a div in your html
    $("#status-mk").load("includes/mk-status.php");//insert the new messages into a div in your html
    $("#urgent-mk").load("includes/mk-urgent.php");//insert the new messages into a div in your html
    $("#eenheid-beide").load("includes/eenheid-beide.php");//insert the new messages into a div in your html
    $("#eigen_kanaal").load("includes/eigen_kanaal.php");//insert the new messages into a div in your html
    $("#eenheid-2").load("includes/eenheid-2.php");//insert the new messages into a div in your html
    $("#eenheid-3").load("includes/eenheid-3.php");//insert the new messages into a div in your html
    $("#eenheid-4").load("includes/eenheid-4.php");
    $("#accept").load("includes/give-district.php");
    $("#meldingmaken").load("includes/meldingmaken.php");//insert the new messages into a div in your html
    $("#kladblok").load("includes/kladblok.php");//insert the new messages into a div in your html
    $("#code-9").load("includes/code-9.php");
    $("#KoppelMelding").load("includes/koppelmelding.php");

    //OC
    $("#OC-meldingen").load("includes/OC/meldingen.php");
    $("#OC-eenheden").load("includes/OC/politie-eenheden.php");
    $("#OC-code9").load("includes/OC/code-9.php");
    $("#OC-accept").load("includes/OC/politie-accept.php");
    $("#OC-status").load("includes/OC/status.php");
    //AC

    //CPA


    $("#openable-chatbutton").click(function () {
        $("#openable-chat").fadeToggle("slow", "linear");
    });

    setInterval(function () {
        loadLog();
        $("#status-mk").load("includes/mk-status.php");//insert the new messages into a div in your html
        $("#urgent-mk").load("includes/mk-urgent.php");//insert the new messages into a div in your html
        $("#eenheid-beide").load("includes/eenheid-beide.php");//insert the new messages into a div in your html
        $("#eigen_kanaal").load("includes/eigen_kanaal.php");//insert the new messages into a div in your html
        $("#eenheid-2").load("includes/eenheid-2.php");//insert the new messages into a div in your html
        $("#eenheid-3").load("includes/eenheid-3.php");//insert the new messages into a div in your html
        $("#code-9").load("includes/code-9.php");//insert the new messages into a div in your html
        $("#accept").load("includes/give-district.php");//insert the new messages into a div in your html
        $("#eenheid-4").load("includes/eenheid-4.php");
        //OC
        $("#OC-meldingen").load("includes/OC/meldingen.php");
        $("#OC-eenheden").load("includes/OC/politie-eenheden.php");
        $("#OC-code9").load("includes/OC/code-9.php");
        $("#OC-accept").load("includes/OC/politie-accept.php");
        $("#OC-status").load("includes/OC/status.php");

    }, 5000);

    setInterval(function () {
        $("#melding-mk").load("includes/mk-meldingen.php");//insert the new messages into a div in your html

    }, 10000);

    setInterval(function () {
        $("#code-9").load("includes/code-9.php");
        $("#KoppelMelding").load("includes/koppelmelding.php");

    }, 10000);

    //store the element
    var $cache = $('.statusLock');

//store the initial position of the element
    var vTop = $cache.offset().top - parseFloat($cache.css('margin-top').replace(/auto/, 0));
    $(window).scroll(function (event) {
        // what the y position of the scroll is
        var y = $(this).scrollTop();

        // whether that's below the form
        if (y >= vTop) {
            // if so, ad the fixed class
            $cache.addClass('stuck');
        } else {
            // otherwise remove it
            $cache.removeClass('stuck');
        }
    });


    //CHAT

    //Load the file containing the chat log
    function loadLog() {
        var oldscrollHeight = $("#messages").prop("scrollHeight") - 20; //Scroll height before the request
        $.ajax({
            url: site + "/log.html",
            cache: false,
            success: function (html) {
                $("#messages").html(html); //Insert chat log into the #chatbox div

                //Auto-scroll
                var newscrollHeight = $("#messages").prop("scrollHeight") - 20; //Scroll height after the request
                if (newscrollHeight > oldscrollHeight) {
                    $("#messages").animate({scrollTop: newscrollHeight}, 1000); //Autoscroll to bottom of div
                }
            },
        });
    }

    //If user submits the form
    $("#submitChat").click(function () {
        var clientmsg = $("#usermsg").val();
        $.post("postChat.php", {text: clientmsg});
        $("#usermsg").attr("value", "");
        $('#usermsg').val('');
        return false;

    });

    $('#usermsg').keypress(function (e) {
        if (e.which == 13) {
            var clientmsg = $("#usermsg").val();
            $.post("postChat.php", {text: clientmsg});
            $("#usermsg").attr("value", "");
            $('#usermsg').val('');
            return false;
            return false;    //<---- Add this line
        }
    });


});

function changestatus(status, id) {

    $.ajax({
        url: site + '/includes/change-status.php',
        data: {content: status, id: id},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#status-mk").load("includes/mk-status.php");//insert the new messages into a div in your html
            $("#urgent-mk").load("includes/mk-urgent.php");//insert the new messages into a div in your html
        }
    });

}
function mklog() {
    mySound = new sound("../geluiden/Radio_gms_beschikbaar.wav");
    mySound.play();
}

function setstatus(status, uid, mid) {

    $.ajax({
        url: site + '/includes/set-status.php',
        data: {status: status, uid: uid, mid: mid},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#melding-mk").load("includes/mk-meldingen.php");//insert the new messages into a div in your html
            $("#eenheid-beide").load("includes/eenheid-beide.php");//insert the new messages into a div in your html
        }
    });

}

function openKoppelen() {
    $("#koppelDialog").dialog({width: 500});
}

function KoppelMelding() {
    $("#KoppelMelding").dialog({width: 500});
}


function moveInc(uid, kanaal) {

    $.ajax({
        url: site + '/includes/move-user.php',
        data: {uid: uid, kanaal: kanaal},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            setlog(0, "Gebruiker Gemoved!", "U heeft zojuist een gebruiker gemoved!");
        }
    });

}

function setlog(uid, titel, bericht) {

    $.ajax({
        url: site + '/includes/set-log.php',
        data: {uid: uid, titel: titel, bericht: bericht},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#melding-mk").load("includes/mk-meldingen.php");//insert the new messages into a div in your html
            $("#status-mk").load("includes/mk-status.php");//insert the new messages into a div in your html
        }
    });

}

function koppelMelding(melding, uid) {

    $.ajax({
        url: site + '/includes/koppel-melding.php',
        data: {melding: melding, uid: uid},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#melding-mk").load("includes/mk-meldingen.php");
            $("#KoppelMelding").load("includes/koppelmelding.php");
        }
    });

}

function setDistrict(district, uid) {

    $.ajax({
        url: site + '/includes/set-district.php',
        data: {district: district, uid: uid},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#accept").load("includes/give-district.php");
        }
    });

}

function setMelding(melding, district) {

    $.ajax({
        url: site + '/includes/makemelding.php',
        data: {melding: melding, district: district},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            location.reload();
        }
    });

}

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}

function acceptgrip() {
    var grip = $("#grip").val();
    var uid = $("#uid").val();

    if (grip == '' || uid == '') {
        alert("Sommige velden zijn niet ingevult!");
    } else {
        // Returns successful data submission message when the entered information is stored in database.
        $.post("includes/submit-grip.php", {
            grip: grip,
            uid: uid
        }, function (data) {
            $("#code-9").load("includes/code-9.php");
            $("#eenheid-beide").load("includes/eenheid-beide.php");//insert the new messages into a div in your html
            $("#eenheid-2").load("includes/eenheid-2.php");//insert the new messages into a div in your html
            $("#eenheid-3").load("includes/eenheid-3.php");//insert the new messages into a div in your html
        });


    }
}

function submitMelding() {
    var melding = $("#melding").val();
    var meldinginfo = $("#meldinginfo").val();
    var locatie = $("#locatie").val();
    var prio = $("#prio option:selected").val();
    var district = $("input[name=\"district\"]:checked").val();

    if (melding == '' || district == '' || locatie == '') {
        alert("Sommige velden zijn niet ingevult!");
    } else {
        // Returns successful data submission message when the entered information is stored in database.
        $.post("includes/makemelding.php", {
            melding: melding,
            meldinginfo: meldinginfo,
            district: district,
            locatie: locatie,
            prio: prio
        }, function (data) {
            $("#melding-mk").load("includes/mk-meldingen.php");
            $("#meldingmaken").load("includes/meldingmaken.php");
        });


    }
}

function maakaantekening() {
    var aantekening = $("#aantekening").val();
    var mid = $("#mid").val();

    if (aantekening == '' || mid == '') {
        alert("Sommige velden zijn niet ingevult!");
    } else {
        // Returns successful data submission message when the entered information is stored in database.
        $.post("includes/make-aantekening.php", {
            aantekening: aantekening,
            mid: mid
        }, function (data) {
            $("#kladblok").load("includes/kladblok.php");
            $('#aantekening-form')[0].reset();
        });


    }
}

function setprio(object) {
    $.ajax({
        url: 'includes/setPrio.php',
        data: {prio: object.value, mid: object.id},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#melding-mk").load("includes/mk-meldingen.php");
        }
    });
}

function setporto(object) {
    $.ajax({
        url: 'includes/setPorto.php',
        data: {porto_kanaal: object.value, mid: object.id},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            $("#melding-mk").load("includes/mk-meldingen.php");
        }
    });
}

function denygrip() {
    var uid = $("#uid").val();

    if (uid == '') {
        alert("Sommige velden zijn niet ingevult!");
    } else {
        // Returns successful data submission message when the entered information is stored in database.
        $.post("includes/denygrip.php", {
            uid: uid
        }, function (data) {
            $("#code-9").load("includes/code-9.php");
        });


    }
}

function delMelding(mid) {

    $.ajax({
        url: site + '/includes/delete-melding.php',
        data: {mid: mid},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#melding-mk").load("includes/mk-meldingen.php");
        }
    });

}

function deleteKladblok(id) {

    $.ajax({
        url: site + '/includes/del-kladblok.php',
        data: {id: id},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            $("#melding-mk").load("includes/mk-meldingen.php");
        }
    });
}

function searchUser() {
    var voor = document.getElementById('db_firstname').value;
    var achter = document.getElementById('db_lastname').value;
    var resultDiv = document.getElementById('result');

    $.ajax({
        url: site + '/includes/user-database.php',
        data: {voornaam: voor, achternaam: achter},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            while (result.firstChild) {
                result.removeChild(result.firstChild);
            }

            if (Array.isArray(JSON.parse(response))) return document.getElementById('result_text').innerHTML = 'Er waren geen resultaten.';

            var keys = Object.keys(JSON.parse(response));

            if (keys.length === 1) {
                document.getElementById('result_text').innerHTML = 'Er was 1 resultaat.';
            } else {
                document.getElementById('result_text').innerHTML = 'Er waren ' + keys.length + ' resultaten';
            }

            loop(0);

            function loop(loop_number) {
                var result = JSON.parse(response)[keys[loop_number]];

                var div = document.createElement('div');
                //div.style.border = '1px solid black';
                //div.style.borderRadius = '10px';
                div.classList.add('panel');
                div.classList.add('panel-default');
                div.style.textAlign = 'center';
                div.style.marginTop = '10px';

                var h3 = document.createElement('h3');
                h3.innerHTML = result['firstname'] + ' ' + result['lastname'];

                var dateofbirth = document.createElement('p');
                dateofbirth.innerHTML = result['date_of_birth'];

                if (result['licenses'].length > 0) {
                    var licenses = document.createElement('p');
                    licenses.innerHTML = '<b>Licenses:</b> ' + result['licenses'].join(', ');
                }

                var billsection = document.createElement('div');

                if (result['bills'].length > 0) {
                    var bills = document.createElement('h4');
                    bills.innerHTML = 'Boetes: ';

                    billsection.appendChild(bills);

                    result['bills'].forEach(function (bill) {
                        var bill_el = document.createElement('p');
                        bill_el.innerHTML = bill.label + ': €' + bill.amount;
                        billsection.appendChild(bill_el);
                    });
                }

                var warrantbox = document.createElement('div');

                var warrant = document.createElement('p');
                if (result.warrants.length === 0) warrant.innerHTML = '<b>Gezocht:</b> <span style="color: red;">Negatief</span>';
                if (result.warrants.length >= 1) warrant.innerHTML = '<b>Gezocht:</b> <span style="color: green;">Positief</span>';

                warrantbox.appendChild(warrant);
                if (result.warrants.length >= 1) {
                    var why = document.createElement('p');
                    why.innerHTML = '<b>Waarom?</b>';
                    warrantbox.appendChild(why);
                }

                result['warrants'].forEach(function (warrant) {
                    var war = document.createElement('p');
                    war.innerHTML = warrant.crimes;
                    warrantbox.appendChild(war);
                });

                if (result['cars'].length >= 1) {
                    var cars = document.createElement('p');
                    cars.innerHTML = '<b>Eigenaar van auto\'s:</b> ' + result['cars'].join(', ');
                }

                div.appendChild(h3);
                div.appendChild(dateofbirth);
                if (result['licenses'].length > 0) div.appendChild(licenses);
                if (result['bills'].length > 0) div.appendChild(billsection);
                div.appendChild(warrantbox);
                if (result['cars'].length >= 1) div.appendChild(cars);
                resultDiv.appendChild(div);

                loop_number++

                if (keys.length !== loop_number) loop(loop_number);
            }


        }
    });

}
