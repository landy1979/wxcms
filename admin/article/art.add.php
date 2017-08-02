<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_ADM . "/inc/smarty.php";
include APP_ADM . "/inc/db.fun.php";

$act = geturl("act");
$msg = array();

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "save"){
  $title = convert(getPost("title"));
  $shorttitle = convert(getPost("shorttitle"));
  $cat = convert(getPost("pcat"));
  $keyword = convert(getPost("keyword"));
  $linkurl = convert(getPost("linkurl"));
  $source = convert(getPost("source"));
  $writer = convert(getPost("writer"));
  $writer = !$writer ? "佚名" : $writer;
  $shortbody = convert(getPost("shortbody"));
  $click = mt_rand(1,100);
  $addtime = convert(getPost("addtime"));
  $addtime = strtotime($addtime);
  $content = convert(getPost("content"));
  $wapcontent = convert(getPost("wapcontent"));

  $shortbody = strlen($shortbody) == 0 ? csubstr(replacepic($content),0,200) : $shortbody;

  if(empty($title)){
    $msg["status"] = 1;
    $msg["m"] = "文章标题不能为空！";
    die(json_encode($msg));
  }
  if(intval($cat) == 0){
    $msg["status"] = 1;
    $msg["m"] = "请选择文章栏目！";
    die(json_encode($msg));
  }
  if(empty($content) || is_null($content)){
    $msg["status"] = 1;
    $msg["m"] = "请输入文章内容！";
    die(json_encode($msg));
  }

  $paths = getPost("paths");
  $pics = getPost("pics");
  $orders = getPost("orders");

  $paths = rtrim($paths, "|");
  $pics = rtrim($pics, "|");
  $orders = rtrim($orders, "|");

  if($pics){ $ispic = 1; } else { $ispic = 0; }
  if($pics){ $titlepic = getFirstPic($paths) . getFirstPic($pics); }

  $paths = explode("|", $paths);
  $pics = $pics ? explode("|", $pics) : array();
  $orders = explode("|", $orders);

  $len = count($pics);

  $data = array(
    "title"       => $title,
    "shorttitle"  => $shorttitle,
    "catid"       => intval($cat),
    "keyword"     => $keyword,
    "linkurl"     => $linkurl,
    "source"      => $source,
    "writer"      => $writer,
    "shortbody"   => $shortbody,
    "ispic"       => intval($ispic),
    "titlepic"    => $titlepic,
    "isallow"     => 1,
    "click"       => intval($click),
    "addtime"     => time()
  );

  $db->begin();

  $sql = $db->mkInsertsql("article", $data);

  $nId = $db->sqlexe($sql,true);

  $picArray = array();

  for($i=0;$i<$len;$i++){
    $tmp = array(
      "art_id"  => $nId,
      "path"    => $paths[$i],
      "picname" => $pics[$i],
      "orders"  => intval($orders[$i])
    );
    $picArray[] = $tmp;
  }

  if($len > 0){ $db->sqlexe( $db->mkBatchInsertsql("pic_info", $picArray) ); }

  $enclosure = array();

  $tmp = array(
    "art_id"  => $nId,
    "body"    => $content,
    "wapbody" => $wapcontent
  );

  $enclosure = $tmp;

  if($content || $wapcontent){ $db->sqlexe( $db->mkInsertsql("art_body", $enclosure) ); }

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "文章添加成功！";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败！";
    die(json_encode($msg));
  }
}

//===========================================
$smarty->assign("cats",getCatalog(0));
$smarty->display("article/art.add.tpl");

?>