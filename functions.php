<?php

     error_reporting(E_ERROR);

function url_encode_full ($value) {
     return implode("", array_map(function($i) { return sprintf("%%%X", ord($i)); }, str_split($value)));
}
