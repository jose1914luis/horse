
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include './Orden.php';

$operation = filter_input(INPUT_POST, 'operation');
$apik = filter_input(INPUT_POST, 'apik');
$apis = filter_input(INPUT_POST, 'apis');


$orden = new Orden($apik, $apis);
switch ($operation) {
    case "tiket":
        $coin = filter_input(INPUT_POST, 'coin');
        $datos = $orden->getTiket($coin);
//        $resumen = json_decode($datos);
        echo $datos;
        break;
    case "buyOrder":
        $coin = filter_input(INPUT_POST, 'coin');
        $amount = filter_input(INPUT_POST, 'amount');
        $buyask = filter_input(INPUT_POST, 'buyask');
        $datos = $orden->buyOrder($coin, $buyask, $amount);
        echo $datos;
//        echo $resumen->result->uuid;
        break;
    case "sellOrder":
        $coin = filter_input(INPUT_POST, 'coin');
        $amount = filter_input(INPUT_POST, 'amount');
        $buyask = filter_input(INPUT_POST, 'sellask');
        $datos = $orden->sellOrder($coin, $buyask, $amount);
        echo $datos;
//        echo $resumen->result->uuid;
        break;
    case "balance":
        $coin = filter_input(INPUT_POST, 'coin');
        $datos = $orden->balance($coin);
        echo $datos;
        break;
    case "calcel":
        $uuid = filter_input(INPUT_POST, 'uuid');
        $datos = $orden->calcelOrder($uuid);
        echo $datos;
        break;
    case "order":
        $uuid = filter_input(INPUT_POST, 'uuid');
        $datos = $orden->getOpenOrder($uuid);
        echo $datos;
        break;

    default:
        break;
}
//        $datos = $orden->optenerResumen();
////        print_r($datos);
//        $resumen = json_decode($datos);
//
//        /* optener las monedas las cuales sus ordenes de compra son mayores a sus ordenes de venta.
//          Osea una posibilidad de que estan siendo pumpeadas */
//        foreach ($resumen->result as $key) {
//
//            if (explode("-", $key->MarketName)[0] == "BTC" && explode("-", $key->MarketName)[1] != "ANS") {
//                if ($key->OpenBuyOrders > $key->OpenSellOrders) {
//                    echo $key->MarketName;
//                    echo ": " . $key->OpenBuyOrders . " - " . $key->OpenSellOrders;
//                    echo " - Last: " . number_format($key->Last, 8, '.', ',');
//                    echo " -  Fecha: " . $key->TimeStamp;
//                    echo '<br>';
//                }
//            }
//        }