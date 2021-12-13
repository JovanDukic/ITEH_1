$(document).ready(function () {

    $("#logout").click(function () {
        sendLogoutRequest();
    });

    sendLogoutRequest = function () {
        request = $.ajax({
            url: "../handler/logout.php",
            type: "POST",
            data: "flag=logout"
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response == "success") {
                document.location.href = "../pages/login.html";
            } else {
                alert("Logging out failed!");
            }
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

});