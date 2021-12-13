$(document).ready(function () {

    $("#form").submit(function () {
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
            } else {
                alert("Saving changes has failed!");
            }
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

});