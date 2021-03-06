<?php

/**
 * @param $value
 * @param $length
 * @param $starter
 * @return mixed
 */
function custom($value, $length = 7, $starter = 1) {
    return $starter . str_pad($value, $length, '0', STR_PAD_LEFT);
}

/**
 * @param $value
 * @param $length
 */
function customRound($value, $length = 2) {
    return round($value, $length);
}
