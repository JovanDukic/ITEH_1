$(document).ready(function () {

    $("#registrationForm").submit(function (e) {
        e.preventDefault();
        if ($("#username").val() && $("#password").val()) {
            sendRequset($(this));
        } else {
            alert("All fields are required!");
        }
    });

    sendRequset = function ($form) {
        const $serialization = $form.serialize();
        console.log("Serialization: " + $serialization);

        request = $.ajax({
            url: "handler/login.php",
            type: "POST",
            data: $serialization
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response == "success") {
                alert("You have been registered!");
            } else {
                alert("Registration failed!");
            }
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

});