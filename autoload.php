<?php

require("constants.php");

spl_autoload_register(function($class) {
    require  BASE_URL . str_replace("\\", "/", $class) . ".php";
});