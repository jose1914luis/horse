var ITERATION = 10;
var TIME = 350;
$(function () {

    $('#txttotal').val((TIME * ITERATION) / 1000);
    $('#txtmili').change(function () {
        TIME = parseInt($('#txtmili').val());
        $('#contenido').append("Time was changed to: " + TIME + " miliseconds<br>");
        $('#txttotal').val((TIME * ITERATION) / 1000);
        $('#contenido').append("Total seconds: " + (TIME * ITERATION) / 1000 + "s <br>");
    });
    $('#txtite').change(function () {
        ITERATION = parseInt($('#txtite').val());
        $('#contenido').append("Iterations was changed to: " + ITERATION + " Iterations<br>");
        $('#txttotal').val((TIME * ITERATION) / 1000);
        $('#contenido').append("Total seconds: " + (TIME * ITERATION) / 1000 + "s <br>");
    });

    if (!$('#chosell').is(':checked')) {
        $('#txtosell').attr('readonly', true);
    }

    $("#chosell").change(function () {
        $('#txtosell').attr('readonly', !$('#chosell').is(':checked'));
    });
    $("#txtcoin").keypress(function (e) {
        if (e.which == 13) {
            make_pump();
        }
    });


});

function make_pump() {

    window.open("https://bittrex.com/Market/Index?MarketName=BTC-" + $("#txtcoin").val(), $("#txtcoin").val(), 'width=1000,height=1000,left=1000,resizable=yes,scrollbars=yes');
    var Last;


    var buyuuid;
    var count = 0;
    var count2 = 0;
    var tmpava;
    var selluuid;
    var check = function (make) {

        console.log(make);
        switch (make) {
            case 1:
                $.post("services_pump.php", {operation: "tiket", coin: $("#txtcoin").val(), apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                        .done(function (data) {
                            console.log(data);
                            var obj = JSON.parse(data);
                            $('#contenido').empty();

                            $('#contenido').append("Getting coin information:<br>");
                            Last = parseFloat(obj.result.Last);
                            $('#contenido').append("Last price: " + obj.result.Last + "<br>");
                            var ask = parseFloat(obj.result.Ask);
                            var buy = parseFloat($("#txtbuy").val());
                            var buyask = buy * ask;
                            $('#contenido').append("Buy price: " + buyask + "<br>");
                            var amount = parseFloat($("#txtamount").val());
                            amount = amount / buyask;
                            $('#contenido').append("Total coins to buy: " + amount + "<br>");
                            /*Buy Order*/
                            $.post("services_pump.php", {operation: "buyOrder", coin: $("#txtcoin").val(), buyask: buyask, amount: amount, apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                                    .done(function (data) {
                                        var obj = JSON.parse(data);
                                        if (obj.success == true) {
                                            buyuuid = obj.result.uuid;
                                            $('#contenido').append("--------Buy Order Complete--------" + "<br>");

                                            check(2);
                                        } else {
                                            $('#contenido').append("Error:" + data + "<br>");
                                        }
                                    }); //<--
                        }
                        );
                break;
            case 2:
                $('#contenido').append("Checking if buy order was executed." + "<br>");
                //$.post("services_pump.php", {operation: "balance", coin: 'sc'})
                $.post("services_pump.php", {operation: "balance", coin: $("#txtcoin").val(), apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                        .done(function (data) {
                            var obj = JSON.parse(data);
                            tmpava = parseFloat(obj.result.Available) || 0;
//                                                    console.log(tmpava);
                            if (obj.success == true && tmpava > 0) {
                                $('#contenido').append("--------Buy Order Executed!!!!--------" + "<br>");
                                /*Sell Order*/
                                var sell = parseFloat($("#txtsell").val());
                                var sellast = Last * sell;
                                $('#contenido').append("Sell Price: " + sellast + "<br>");
                                //$.post("services_pump.php", {operation: "sellOrder", coin: 'sc', sellask: sellast, amount: tmpava})
                                $.post("services_pump.php", {operation: "sellOrder", coin: $("#txtcoin").val(), sellask: sellast, amount: tmpava, apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                                        .done(function (data) {

                                            var obj = JSON.parse(data);
                                            if (obj.success == true) {
                                                $('#contenido').append("--------Sell Order Complete--------" + "<br>");
                                                selluuid = obj.result.uuid;


                                                check(3);


                                            } else {
                                                $('#contenido').append("Error:" + data + "<br>");
                                            }
                                        });
                            } else {
                                //checker: buy
                                if ($('#chbuy').is(':checked')) {

                                    count = count + 1;
                                    if (count < ITERATION) {

                                        setTimeout(function () {
                                            check(2);
                                        }, TIME);

                                    } else {
                                        $.post("services_pump.php", {operation: "calcel", uuid: buyuuid, apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                                                .done(function (data) {
                                                    var obj = JSON.parse(data);
                                                    if (obj.success == true) {
                                                        $('#contenido').append("--------Buy Order Canceled!!!!--------" + "<br>");
                                                        //check if sell order was execute. 

                                                    } else {
                                                        $('#contenido').append("Error:" + data + "<br>");
                                                    }
                                                });
                                    }
                                } else {
                                    $('#contenido').append("Check buy order is disabled." + "<br>");
                                }
                            }
                        });
                break;
            case 3:
                $('#contenido').append("Checking if sell order was execute." + "<br>");

                $.post("services_pump.php", {operation: "order", uuid: selluuid, apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                        .done(function (data) {
                            var obj = JSON.parse(data);
                            if (obj.success && obj.result.IsOpen) {
                                count2 = count2 + 1;

                                if ($('#chsell').is(':checked')) {

                                    if (count2 > ITERATION) {
                                        //cancel order and sell new order to the same price or lest
                                        $.post("services_pump.php", {operation: "calcel", uuid: selluuid, apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                                                .done(function (data) {
                                                    var obj = JSON.parse(data);
                                                    if (obj.success == true) {
                                                        $('#contenido').append("--------Sell Order Canceled!!!!--------" + "<br>");

                                                        if ($('#chsell').is(':checked')) {
                                                            //new order losing 8%. 
                                                            var stop = parseFloat($('#txtosell').val());
                                                            var sellastopt = Last * stop;
                                                            $('#contenido').append("Sell Order to: " + sellastopt + " - " + tmpava + "<br>");
                                                            //$.post("services_pump.php", {operation: "sellOrder", coin: 'sc', sellask: sellastopt, amount: tmpava})
                                                            $.post("services_pump.php", {operation: "sellOrder", coin: $("#txtcoin").val(), sellask: sellastopt, amount: tmpava, apik: $('#txtapik').val(), apis: $('#txtapis').val()})
                                                                    .done(function (data) {
                                                                        var obj = JSON.parse(data);
                                                                        if (obj.success == true) {
                                                                            $('#contenido').append("--------Sorry. Sell Order Lossing 10%(" + sellastopt + ") Complete!!!!--------" + "<br>");
//
                                                                        } else {
                                                                            $('#contenido').append("Error:" + data + "<br>");
                                                                        }
                                                                    });
                                                        }


                                                    } else {
                                                        $('#contenido').append("Error:" + data + "<br>");
                                                    }
                                                });
                                    } else {
                                        setTimeout(function () {
                                            check(3);
                                        }, TIME);
                                    }
                                } else {
                                    $('#contenido').append("Check sell order is disabled." + "<br>");
                                }
                            } else {

                                $('#contenido').append("PUMP was completed... Congratulation!!<br>");
                            }
                        });
                break;
        }
    };

    check(1);
}