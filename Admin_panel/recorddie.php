<?php

function recorddie($line,$file,$q){
    $fp = fopen('request.log', 'a');
    if (!isset($q)){
        $q="";
    }
    $t=time();
    $tformatted=date(DATE_RFC2822);
    $p=print_r($_POST,true);
    fwrite($fp, "$tformatted  Die called in $file on line $line with query $q and post variables $p\n");
    fclose($fp);    
    return;
}
?>