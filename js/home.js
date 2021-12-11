$(document).ready(function () {

    $("#search").keyup(function () {
        sendRequset($("#search").val());
    });

    sendRequset = function ($text) {
        request = $.ajax({
            url: "../handler/search.php",
            type: "POST",
            data: "text=" + $text
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

});