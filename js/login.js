$(document).ready(function () {

    $("#loginForm").submit(function (e) {
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
            url: "../handler/login.php",
            type: "POST",
            data: $serialization
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response == "user") {
                document.location.href = "../pages/home.php";
            } else if (response == "admin") {
                document.location.href = "../pages/admin.php";
            } else {
                alert("User does not exist!");
            }
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

});