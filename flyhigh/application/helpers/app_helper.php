<?php
function getSrc($name=''){
    return base_url().'extras/src/'.$name;
}
function getSrcImg($name=''){
    return base_url().'extras/src/imgs/'.$name;
}

function getSrcLIb($name=''){
    return base_url().'extras/src/libs/'.$name;
}


function debug($data=''){
    $debug_backtrace = debug_backtrace();
    $file = 'File: ';
    $line = 'Line: ';
    if(is_array($debug_backtrace)){
        $file .= $debug_backtrace[0]['file'];
        $line .= $debug_backtrace[0]['line'];
    }
    echo $file;
    echo '<br>';
    echo $line;
    echo '<br><pre>';
    if(is_array($data)){
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else{
        print_r($data);
    }
    echo '</pre><br>';
    // die;
}
