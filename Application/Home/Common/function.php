<?php

function sysMenu_merge($arr,$pid=0){
    $tmparr = array();
    foreach( $arr as $v => $value ) {
        if( $value ['pid'] == $pid ) {
            unset ( $arr[$v] );
            $value['sub'] = sysMenu_sec_merge( $arr , $value['id']);
            $tmparr[] = $value;
        }
    }
    return $tmparr;
}

function sysMenu_sec_merge($arr,$pid=0){
    $tmparr = array();
    foreach( $arr as $v => $value ) {
        if( $value ['pid'] == $pid ) {
            $tmparr[] = $value;
            unset ( $arr[$v] );
        }
    }
    return $tmparr;
}

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




