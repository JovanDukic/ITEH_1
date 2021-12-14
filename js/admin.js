$(document).ready(function () {

    var val = "";
    var flag = false;

    $("#table tbody").on("click", "td", function () {
        $col = $(this).index();
        if ($col != 5) {
            sendLoadUserTestRequest($(this).closest("tr").find('td:eq(0)').text());
        }
    });

    $("#table").on("click", "a", function () {
        sendDeleteRequest($(this).closest("tr").find('td:eq(0)').text());
    });

    $("#search").keyup(function () {
        reset();
        sendSearchRequest($("#search").val(), $("#filterValue").val());
    });

    $("#sortFirstname").click(function () {
        if ($("#sortFirstname").is(":checked")) {
            val += ":firstname";
        } else {
            val = val.replace(":firstname", "");
        }
        sendSortRequest(val);
    });

    $("#sortLastname").click(function () {
        if ($("#sortLastname").is(":checked")) {
            val += ":lastname";
        } else {
            val = val.replace(":lastname", "");
        }
        sendSortRequest(val);
    });

    $("#sortAge").click(function () {
        if ($("#sortAge").is(":checked")) {
            val += ":age";
        } else {
            val = val.replace(":age", "");
        }
        sendSortRequest(val);
    });

    $("#sortGender").click(function () {
        if ($("#sortGender").is(":checked")) {
            val += ":gender";
        } else {
            val = val.replace(":gender", "");
        }
        sendSortRequest(val);
    });

    sendSortRequest = function ($flag) {
        console.log($flag);
        request = $.ajax({
            url: "../handler/adminSort.php",
            type: "POST",
            data: "flag=" + $flag,
            dataType: "json",
            success: function (data) {
                fillTable(data);
            },
            error: function (jqXHR, exception) {
                alert("Sort has failed!");
            }
        });
    }

    sendSearchRequest = function ($text, $filter) {
        request = $.ajax({
            url: "../handler/adminSearch.php",
            type: "POST",
            data: "text=" + $text + "&filter=" + $filter,
            dataType: "json",
            success: function (data) {
                fillTable(data);
            },
            error: function (jqXHR, exception) {
                alert("Search has failed!");
            }
        });
    };

    sendDeleteRequest = function ($userID) {
        request = $.ajax({
            url: "../handler/adminDeleteUser.php",
            type: "POST",
            data: "userID=" + $userID,
            dataType: "json",
            success: function (data) {
                alert("User has been deleted!");
                fillTable(data);
            },
            error: function (jqXHR, exception) {
                alert("Error occurred!");
            }
        });
    };

    sendLoadUserTestRequest = function ($userID) {
        request = $.ajax({
            url: "../handler/adminLoadUserTests.php",
            type: "POST",
            data: "userID=" + $userID
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response == "success") {
                document.location.href = "../pages/adminUsersTests.php";
            } else {
                alert("Loading error!");
            }
        });

        request.fail(function (jqXHR, textStatus, error) {
            alert("Error has occurred: " + error);
        });
    };

    fillTable = function (data) {
        $("#table > tbody").html("");
        data.forEach(element => {
            $('#table').append(
                "<tr>" +
                "<td>" + element["ID"] + "</td>" +
                "<td>" + element["firstname"] + "</td>" +
                "<td>" + element["lastname"] + "</td>" +
                "<td>" + element["age"] + "</td>" +
                "<td>" + element["gender"] + "</td>" +
                "<td><a href = " + "'#'" + " class =" + "'delete'" + ">DELETE</a></td>" +
                "</tr>"
            );
        });
    }

    reset = function () {
        $("#sortFirstname").prop("checked", false);
        $("#sortLastname").prop("checked", false);
        $("#sortAge").prop("checked", false);
        $("#sortGender").prop("checked", false);
    };

});