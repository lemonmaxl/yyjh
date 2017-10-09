<?php

function nodeShow($arr,$pid,$level=0,$delimiter = '──'){
    $tmparr = array();
    foreach( $arr as $v => $value ) {
        if( $value ['pid'] == $pid ) {
            $value ['level'] = $level + 1;
            $value ['delimiter'] = str_repeat( $delimiter , $level );
            $tmparr[] = $value;
            unset ( $arr[$v] );
            $tmparr = array_merge( $tmparr , nodeShow( $arr , $value ['id'],$value ['level']));
        }
    }
    return $tmparr;
}




