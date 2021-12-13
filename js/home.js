$(document).ready(function () {

    var val = "";

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
            fail: function () {
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
            fail: function () {
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
        $("#table > tbody").html("");
        data.forEach(element => {
            $('#table').append(
                "<tr>" +
                "<td>" + element["ID"] + "</td>" +
                "<td>" + element["userID"] + "</td>" +
                "<td>" + element["date"] + "</td>" +
                "<td>" + convert(element["testID"]) + "</td>" +
                "<td>" + element["ambulance"] + "</td>" +
                "<td>" + element["result"] + "</td>" +
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