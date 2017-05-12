<?php

if(!function_exists('show')){
    function show($array = array()){
        echo "<pre>";
        print_r($array);
        exit;
    }
}