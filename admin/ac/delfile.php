<?php
require dirname(__DIR__) . '/inc/config.php';
require dirname(__DIR__) . '/inc/session.php';
require dirname(__DIR__) . '/inc/checksession.php';
include APP_ADM . '/inc/commFunction.php';
include APP_ADM . '/inc/del_file.php';
include APP_PATH . '/include/fn_post.php';

$path	= convert(geturl("f"));

if( empty($path) ){ exit("0"); }

deleteFile( $path );

?>