<?php

function hourTransform($ora='') {
    $h = $ora;
    $e = explode(":",$h);
    $t = ltrim($e[0],"0");
    $result = intval($t);
    return $result;
}