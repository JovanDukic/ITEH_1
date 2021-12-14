$(document).ready(function () {

    $("#form").submit(function (e) {
        e.preventDefault();
        if ($("#username").val() && $("#password").val() && $("#firstname").val() && $("#lastname").val() && $("#age").val() && $("#gender").val()) {
            if (!$.isNumeric($("#age").val())) {
                alert("Age must be a number!");
                return;
            }
            sendSaveRequest($(this));
        } else {
            alert("All fields are required!");
        }
    });

    $("#usernameBox").click(function () {
        if ($("#usernameBox").is(":checked")) {
            $("#username").prop("disabled", false);
            $("#username").css("background-color", "white");
        } else {
            $("#username").prop("disabled", true);
            $("#username").css("background-color", "rgba(169, 169, 169, 0.8)");
        }
    });

    $("#passwordBox").click(function () {
        if ($("#passwordBox").is(":checked")) {
            $("#password").prop("disabled", false);
            $("#password").css("background-color", "white");
        } else {
            $("#password").prop("disabled", true);
            $("#password").css("background-color", "rgba(169, 169, 169, 0.8)");
        }
    });

    $("#firstnameBox").click(function () {
        if ($("#firstnameBox").is(":checked")) {
            $("#firstname").prop("disabled", false);
            $("#firstname").css("background-color", "white");
        } else {
            $("#firstname").prop("disabled", true);
            $("#firstname").css("background-color", "rgba(169, 169, 169, 0.8)");
        }
    });

    $("#lastnameBox").click(function () {
        if ($("#lastnameBox").is(":checked")) {
            $("#lastname").prop("disabled", false);
            $("#lastname").css("background-color", "white");
        } else {
            $("#lastname").prop("disabled", true);
            $("#lastname").css("background-color", "rgba(169, 169, 169, 0.8)");
        }
    });

    $("#ageBox").click(function () {
        if ($("#ageBox").is(":checked")) {
            $("#age").prop("disabled", false);
            $("#age").css("background-color", "white");
        } else {
            $("#age").prop("disabled", true);
            $("#age").css("background-color", "rgba(169, 169, 169, 0.8)");
        }
    });

    $("#genderBox").click(function () {
        if ($("#genderBox").is(":checked")) {
            $("#gender").prop("disabled", false);
            $("#gender").css("background-color", "white");
        } else {
            $("#gender").prop("disabled", true);
            $("#gender").css("background-color", "rgba(169, 169, 169, 0.8)");
        }
    });

    sendSaveRequest = function ($form) {
        const serialization = $form.serialize();
        console.log("Serialization: " + serialization);

        request = $.ajax({
            url: "../handler/profileHandler.php",
            type: "POST",
            data: serialization
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response == "success") {
                alert("Changes have been saved!");
            } else if (response == "exists") {
                alert("Username is alredy taken!");
            } else if ("nothing") {
                return;
            } else {
                alert("Saving changes has failed!");
            }
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

});