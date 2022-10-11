<?php
/**
 * 文件
 */
namespace library;

class File{
    /**
     * 得到可读文件大小
     * @param Integer $byte 字节数
     * @return String 可读字节大小
     */
    function getSizeReadable($byte){
        $readable = '';
        
        if($byte < 1024){
            $readable = $byte.'B';
        }else if($byte < 1024 * 1024){
            $readable  = floor($byte / 1024).'KB';
        }else if($byte < 1024 * 1024 * 1024){
            $readable  = round($byte / 1024 / 1024, 1).'MB';
        }else if($byte < 1024 * 1024 * 1024 * 1024){
            $readable  = round($byte / 1024 / 1024 / 1024, 2).'GB';
        }
        
        return $readable;
    }
}
