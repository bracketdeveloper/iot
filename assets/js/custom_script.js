
$("#username").keypress(function () {
    const usernameRequiredErrorEl = document.getElementById('username-required-span');

    if (!usernameRequiredErrorEl.hasAttribute("hidden")) {
        usernameRequiredErrorEl.setAttribute("hidden", "")
    }
});

$("#password").keypress(function () {
    const passwordRequiredErrorEl = document.getElementById('password-required-span');

    if (!passwordRequiredErrorEl.hasAttribute("hidden")) {
        passwordRequiredErrorEl.setAttribute("hidden", "")
    }
});

$("#email").keypress(function () {
    const emailRequiredErrorEl = document.getElementById('email-required-span');
    const emailInvalidErrorEl = document.getElementById('email-invalid-span');

    if (!emailRequiredErrorEl.hasAttribute("hidden")) {
        emailRequiredErrorEl.setAttribute("hidden", "")
    }
    if (!emailInvalidErrorEl.hasAttribute("hidden")) {
        emailInvalidErrorEl.setAttribute("hidden", "")
    }
});

$("#fifa-id").keypress(function () {
    removeErrorMsg('fifa-id-required-span')
});

$("#name").keypress(function () {
    removeErrorMsg('name-required-span')
});

$("#image").change(function (evt) {
    removeErrorMsg('image-required-span')
});

$("#club").keypress(function () {
    removeErrorMsg('club-required-span')
});

$("#father-name").keypress(function () {
    removeErrorMsg('father-name-required-span')
});

$("#mother-name").keypress(function () {
    removeErrorMsg('mother-name-required-span')
});

$("#primary-nationality").keypress(function () {
    removeErrorMsg('primary-nationality-required-span')
});
$("#secondary-nationality").keypress(function () {
    removeErrorMsg('secondary-nationality-required-span')
});
$("#tertiary-nationality").keypress(function () {
    removeErrorMsg('tertiary-nationality-required-span')
});

$("#date-of-birth").change(function () {
    removeErrorMsg('date-of-birth-required-span')
});

$("#height").keypress(function () {
    removeErrorMsg('height-required-span')
});
$("#weight").keypress(function () {
    removeErrorMsg('weight-required-span')
});
$("#sprint-10-meter").keypress(function () {
    removeErrorMsg('sprint-10-meter-required-span')
});
$("#sprint-20-meter").keypress(function () {
    removeErrorMsg('sprint-20-meter-required-span')
});
$("#sprint-50-meter").keypress(function () {
    removeErrorMsg('sprint-50-meter-required-span')
});
$("#dribble-course").keypress(function () {
    removeErrorMsg('dribble-course-required-span')
});
$("#dribble-course-main").keypress(function () {
    removeErrorMsg('dribble-course-main-required-span')
});
$("#dribble-course-off").keypress(function () {
    removeErrorMsg('dribble-course-off-required-span')
});
$("#long-ball-precision").keypress(function () {
    removeErrorMsg('long-ball-precision-required-span')
    removeErrorMsg('long-ball-precision-invalid-span')
});
$("#flexibility").keypress(function () {
    removeErrorMsg('flexibility-required-span')
});
$("#jump-standing").keypress(function () {
    removeErrorMsg('jump-standing-required-span')
});
$("#jump-running").keypress(function () {
    removeErrorMsg('jump-running-required-span')
});
$("#strength").keypress(function () {
    removeErrorMsg('strength-required-span')
});
$("#endurance").keypress(function () {
    removeErrorMsg('endurance-required-span')
    removeErrorMsg('endurance-invalid-span')
});
$("#technique").keypress(function () {
    removeErrorMsg('technique-required-span')
    removeErrorMsg('technique-invalid-span')
});
$("#determination").keypress(function () {
    removeErrorMsg('determination-required-span')
    removeErrorMsg('determination-invalid-span')
});
$("#tactical-sense").keypress(function () {
    removeErrorMsg('tactical-sense-required-span')
    removeErrorMsg('tactical-sense-invalid-span')
});
$("#agility").keypress(function () {
    removeErrorMsg('agility-required-span')
});
$("#reflex-hand").keypress(function () {
    removeErrorMsg('reflex-hand-required-span')
});
$("#reflex-leg").keypress(function () {
    removeErrorMsg('reflex-leg-required-span')
});

function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to logout?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#30d630',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "?action=logout"
        }
    })
    return false
}

function showHidePassword() {
    var profilePasswordEl = document.getElementById("profile-password");
    var isHide = false;

    if (profilePasswordEl.type === "password") {
        profilePasswordEl.type = "text";
        isHide = false;
    } else {
        profilePasswordEl.type = "password";
        isHide = true;
    }

    const showHidePasswordIconEl = document.getElementById("btn-show-hide-password");
    if (isHide) {
        showHidePasswordIconEl.removeAttribute("class");
        showHidePasswordIconEl.setAttribute("class", 'fa fa-eye-slash col-1');
    } else {
        showHidePasswordIconEl.removeAttribute("class");
        showHidePasswordIconEl.setAttribute("class", 'fa fa-eye col-1');

    }
}

function removeErrorMsg(errorMessageSpanID) {
    const emailRequiredErrorEl = document.getElementById(errorMessageSpanID);

    if (!emailRequiredErrorEl.hasAttribute("hidden")) {
        emailRequiredErrorEl.setAttribute("hidden", "")
    }
}

function saveGraphSinglePlayer(fifaId, name, attribute) {
    html2canvas(document.getElementById("chartContainer"))
        .then(function (canvas) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            anchorTag.download = fifaId + "_" + name + "_" + attribute + "_graph_" + Math.floor((Math.random() * 10000)) + ".jpg";
            anchorTag.href = canvas.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
        });
}

function saveGraphPlayerVsPlayer(fifaId1, name1, fifaId2, name2, attribute) {
    html2canvas(document.getElementById("chartContainer"))
        .then(function (canvas) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            anchorTag.download = fifaId1 + "_" + name1 + "_vs_" + fifaId2 + "_" + name2 + "_" + attribute + "_graph_" + Math.floor((Math.random() * 10000)) + ".jpg";
            anchorTag.href = canvas.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
        });
}

function saveGraphClubVsClub(club1, club2, ageYear, attribute) {
    html2canvas(document.getElementById("chartContainer"))
        .then(function (canvas) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            anchorTag.download = club1 + "_vs_" + club2 + "_" + ageYear +"_"  + attribute + "_graph_" + Math.floor((Math.random() * 10000)) + ".jpg";
            anchorTag.href = canvas.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
        });
}

function saveGraphPlayerVsClub(player, club, attribute) {
    html2canvas(document.getElementById("chartContainer"))
        .then(function (canvas) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            anchorTag.download = player + "_vs_" + club +"_"  + attribute + "_graph_" + Math.floor((Math.random() * 10000)) + ".jpg";
            anchorTag.href = canvas.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
        });
}

$("#player").change(function () {
    removeErrorMsg('player-required-span')
});

$("#player-1").change(function () {
    removeErrorMsg('player-1-required-span')
    var player1Val = $('#player-1 option:selected').val();
    var player2Val = $('#player-2 option:selected').val();
    if(player1Val == player2Val){
        Swal.fire({
            icon: 'error',
            title: 'Player Selection Error',
            text: 'Kindly select different player to compare',
        })
        $('#player-1').prop('selectedIndex',0);
    }

});

$("#player-2").change(function () {
    removeErrorMsg('player-2-required-span')
    var player1Val = $('#player-1 option:selected').val();
    var player2Val = $('#player-2 option:selected').val();
    if(player1Val == player2Val){
        Swal.fire({
            icon: 'error',
            title: 'Player Selection Error',
            text: 'Kindly select different player to compare',
        })
        $('#player-2').prop('selectedIndex',0);
    }
});

$("#player-attribute").change(function () {
    removeErrorMsg('player-attribute-required-span')
});

$("#age-year").change(function () {
    removeErrorMsg('age-year-required-span')
});

$("#club").change(function () {
    removeErrorMsg('club-required-span')
});

$("#club-1").change(function () {
    removeErrorMsg('club-1-required-span')
    var club1Val = $('#club-1 option:selected').val();
    var club2Val = $('#club-2 option:selected').val();
    if(club1Val == club2Val){
        Swal.fire({
            icon: 'error',
            title: 'Club Selection Error',
            text: 'Kindly select different club to compare',
        })
        $('#club-1').prop('selectedIndex',0);
    }
    else if(club1Val != "" && club2Val != ""){
        $('#age-year').html('<option value="" selected disabled>Select Age</option>');
        var formData = new FormData();
        formData.append('club_1', club1Val);
        formData.append('club_2', club2Val);
        $.ajax({
            url: "model/ajax_process.php?action=get_clubs_common_years",
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
        }).done(function (data) {
            /* successful code is 1*/

            if (data == "1") {
                Swal.fire({
                    icon: 'error',
                    title: 'Age Year Error',
                    text: 'There is no common age year in ' + club1Val +" and " + club2Val,
                }).then((result) => {
                    $('#club-2').prop('selectedIndex',0);
                })
            }else{
                var duce = jQuery.parseJSON(data);
                let uniqueChars = [...new Set(duce)];
                for (var i = 0; i < uniqueChars.length; i++) {
                    $('#age-year').append('<option value="' +
                        uniqueChars[i] +'">'+ uniqueChars[i] +'</option>');
                }
            }
        });
    }
});

$("#club-2").change(function () {
    removeErrorMsg('club-2-required-span')
    var club1Val = $('#club-1 option:selected').val();
    var club2Val = $('#club-2 option:selected').val();
    if(club1Val == club2Val){
        Swal.fire({
            icon: 'error',
            title: 'Club Selection Error',
            text: 'Kindly select different club to compare',
        })
        $('#club-2').prop('selectedIndex',0);
    }
    else if(club1Val != "" && club2Val != ""){
        $('#age-year').html('<option value="" selected disabled>Select Age</option>');
        var formData = new FormData();
        formData.append('club_1', club1Val);
        formData.append('club_2', club2Val);
        $.ajax({
            url: "model/ajax_process.php?action=get_clubs_common_years",
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
        }).done(function (data) {
            /* successful code is 1*/

            if (data == "1") {
                Swal.fire({
                    icon: 'error',
                    title: 'Age Year Error',
                    text: 'There is no common age year in ' + club1Val +" and " + club2Val,
                }).then((result) => {
                    $('#club-2').prop('selectedIndex',0);
                })
            }else{
                var duce = jQuery.parseJSON(data);
                let uniqueChars = [...new Set(duce)];
                for (var i = 0; i < uniqueChars.length; i++) {
                    $('#age-year').append('<option value="' +
                        uniqueChars[i] +'">'+ uniqueChars[i] +'</option>');
                }
            }
        });
    }
});

$("#player-age").change(function () {
    removeErrorMsg('player-age-required-span')
});