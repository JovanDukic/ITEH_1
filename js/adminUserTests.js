$(document).ready(function () {

    var val = "";

    $("#table1").on("click", "a", function () {
        sendDeleteRequest($(this).closest("tr").find('td:eq(0)').text());
    });

    $("#search").keyup(function () {
        reset();
        sendSearchRequest($("#search").val(), $("#filterValue").val());
    });

    $("#sortDate").click(function () {
        if ($("#sortDate").is(":checked")) {
            val += ":date";
        } else {
            val = val.replace(":date", "");
        }
        sendSortRequest(val);
    });

    $("#sortType").click(function () {
        if ($("#sortType").is(":checked")) {
            val += ":type";
        } else {
            val = val.replace(":type", "");
        }
        sendSortRequest(val);
    });

    $("#sortAmbulance").click(function () {
        if ($("#sortAmbulance").is(":checked")) {
            val += ":ambulance";
        } else {
            val = val.replace(":ambulance", "");
        }
        sendSortRequest(val);
    });

    $("#sortResult").click(function () {
        if ($("#sortResult").is(":checked")) {
            val += ":result";
        } else {
            val = val.replace(":result", "");
        }
        sendSortRequest(val);
    });

    sendDeleteRequest = function ($testID) {
        request = $.ajax({
            url: "../handler/adminDeleteUserTest.php",
            type: "POST",
            data: "testID=" + $testID,
            dataType: "json",
            success: function (data) {
                console.log(data);
                alert("Test has been deleted!");
                fillTable(data);
            },
            error: function (jqXHR, exception) {
                alert("Error occurred!");
            }
        });
    };

    sendSortRequest = function ($flag) {
        request = $.ajax({
            url: "../handler/sort.php",
            type: "POST",
            data: "flag=" + $flag,
            dataType: "json",
            success: function (data) {
                console.log(data);
                fillTable(data);
            },
            error: function (jqXHR, exception) {
                alert("Sort has failed!");
            }
        });
    }

    sendSearchRequest = function ($text, $filter) {
        request = $.ajax({
            url: "../handler/search.php",
            type: "POST",
            data: "text=" + $text + "&filter=" + $filter,
            dataType: "json",
            success: function (data) {
                console.log(data);
                fillTable(data);
            },
            error: function (jqXHR, exception) {
                alert("Search has failed!");
            }
        });
    };

    convert = function (testID) {
        switch (testID) {
            case 1:
                return "quick";
            case 2:
                return "pcr";
            default:
                return "error";
        }
    };

    fillTable = function (data) {
        $("#table1 > tbody").html("");
        data.forEach(element => {
            $('#table1').append(
                "<tr>" +
                "<td>" + element["ID"] + "</td>" +
                "<td>" + element["userID"] + "</td>" +
                "<td>" + element["date"] + "</td>" +
                "<td>" + convert(element["testID"]) + "</td>" +
                "<td>" + element["ambulance"] + "</td>" +
                "<td>" + element["result"] + "</td>" +
                "<td><a href = " + "'#'" + " class =" + "'delete'" + ">DELETE</a></td>" +
                "</tr>"
            );
        });
    }

    reset = function () {
        $("#sortDate").prop("checked", false);
        $("#sortType").prop("checked", false);
        $("#sortAmbulance").prop("checked", false);
        $("#sortResult").prop("checked", false);
    };

});