$(document).ready(function () {

    $("#testForm").submit(function (e) {
        e.preventDefault();
        sendRequset($(this));
    });

    sendRequset = function ($form) {
        const $serialization = $form.serialize();
        console.log("Serialization: " + $serialization);

        request = $.ajax({
            url: "../handler/test.php",
            type: "POST",
            data: $serialization
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response == "success") {
                alert("Test has been created!");
            } else {
                alert("Testing has failed!");
            }
            console.log(response);
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };


});