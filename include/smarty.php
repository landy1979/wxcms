<?php
include APP_PATH . '/include/smarty/libs/Smarty.class.php';

$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 60;
$smarty->setTemplateDir(APP_PATH . '/tpl');
$smarty->setCompileDir(APP_PATH . '/tpl_c');
//$smarty->setCacheDir(APP_PATH . '/tpl_cache');
$smarty->allow_php_templates = true;
// $smarty->php_handling = PHP_ALLOW;
$smarty->left_delimiter = '{{';
$smarty->right_delimiter = '}}';
$smarty->assign('title','龙马潭区妇幼保健院');
$smarty->assign('APP_PATH','http://' . $_SERVER['HTTP_HOST']);
$smarty->assign('APP_WAP','http://' . $_SERVER['HTTP_HOST'] . '/wap');
?>