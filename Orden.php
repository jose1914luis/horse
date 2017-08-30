<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orden
 *
 * @author josegh
 */
class Orden {

    private $apikey = '';
    private $apisecret = '';
    
    public function __construct($k, $s) {
        
        $this->apikey = $k;
        $this->apisecret = $s;
    }

    public function obtenerOrden() {

        $nonce = time();
        $uri = 'https://bittrex.com/api/v1.1/market/getopenorders?apikey=' . $this->apikey . '&nonce=' . $nonce;
        $sign = hash_hmac('sha512', $uri, $this->apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:' . $sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
    }

    public function optenerResumen() {

        $uri = 'https://bittrex.com/api/v1.1/public/getmarketsummaries';
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
    }

    public function getTiket($coin) {
        $uri = 'https://bittrex.com/api/v1.1/public/getticker?market=BTC-' . $coin;
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
    }

    public function buyOrder($coin, $buyask, $quantity) {
        $nonce = time();
        $uri = 'https://bittrex.com/api/v1.1/market/buylimit?apikey=' . $this->apikey . '&nonce=' . $nonce . '&market=BTC-' . $coin . "&quantity=" . $quantity . "&rate=" . $buyask;        
        $sign = hash_hmac('sha512', $uri, $this->apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:' . $sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
    }
    
    public function sellOrder($coin, $sellask, $quantity) {
        $nonce = time();
        $uri = 'https://bittrex.com/api/v1.1/market/selllimit?apikey=' . $this->apikey . '&nonce=' . $nonce . '&market=BTC-' . $coin . "&quantity=" . $quantity . "&rate=" . $sellask;        
        $sign = hash_hmac('sha512', $uri, $this->apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:' . $sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
    }
    
    public function balance($coin) {
        $nonce = time();
        $uri = 'https://bittrex.com/api/v1.1/account/getbalance?apikey=' . $this->apikey . '&nonce=' . $nonce . '&currency=' . $coin;        
        $sign = hash_hmac('sha512', $uri, $this->apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:' . $sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
    }
    
    public function calcelOrder($uuid) {
        $nonce = time();
        $uri = 'https://bittrex.com/api/v1.1/market/cancel?apikey=' . $this->apikey . '&nonce=' . $nonce . '&uuid=' . $uuid;        
//        print_r($uri);
        $sign = hash_hmac('sha512', $uri, $this->apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:' . $sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
//        return $uri;
    }
    
     public function getOpenOrder($uuid) {
        $nonce = time();
        $uri = 'https://bittrex.com/api/v1.1/account/getorder?apikey=' . $this->apikey . '&nonce=' . $nonce . '&uuid=' . $uuid;        
//        print_r($uri);
        $sign = hash_hmac('sha512', $uri, $this->apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:' . $sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $execResult = curl_exec($ch);
        return $execResult;
//        return $uri;
    }

}
