<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_ADM . "/inc/smarty.php";
include APP_ADM . "/inc/db.fun.php";

$id = geturl("id");
$id = !empty($id) ? intval($id) : exit();

$sql = $db->sqlexe("select a.*,b.body,b.wapbody from `article` as a inner join `art_body` as b where a.id=".$id." and a.id=b.art_id");
 if(mysqli_num_rows($sql) > 0){
  $row = mysqli_fetch_array($sql);
  if($row["ispic"] == 1){                    //如果文章有图片，查找图片表中的图片路径
    $tmpPic = $db->getAll("select * from `pic_info` where art_id=".$id);
  }
}
$catid = $row["catid"];

$res = is_array($row) || !is_null($row) ? $row : array();

$picArr = array();

if(is_array($tmpPic) || !is_null($tmpPic)){         //如果文章有图片，重新组合数组
  foreach($tmpPic as $k=>$v){
    $picArr[] = array(
        "art_id"  => $v["art_id"],
        "path"    => $v["path"],
        "picname" => $v["picname"],
        "orders"  => $v["orders"],
        "picpath" => "../../" . $v["path"] . $v["picname"]
    );
  }
}

$act = geturl("act");
$msg = array();

/*------------------------------------------------------ */
//-- 修改文章保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "edsave"){
  $art_id = convert(getPost("art_id"));
  $title = convert(getPost("title"));
  $shorttitle = convert(getPost("shorttitle"));
  $cat = convert(getPost("pcat"));
  $keyword = convert(getPost("keyword"));
  $linkurl = convert(getPost("linkurl"));
  $source = convert(getPost("source"));
  $writer = convert(getPost("writer"));
  $shortbody = convert(getPost("shortbody"));
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
    "addtime"     => $addtime
  );

  $db->begin();

  $sql = $db->mkUpdatesql("article", $data, "id=".intval($art_id));
  $db->sqlexe($sql);

  $db->sqlexe("delete from `pic_info` where art_id=".intval($art_id));

  $piclosure = array();

  for($i=0;$i<$len;$i++){
    $tmp = array(
      "art_id"  => intval($art_id),
      "path"    => $paths[$i],
      "picname" => $pics[$i],
      "orders"  => intval($orders[$i])
    );
    $piclosure[] = $tmp;
  }

  if($len > 0){ $db->sqlexe( $db->mkBatchInsertsql("pic_info", $piclosure) ); }

  $enclosure = array();

  $tmp = array(
    "body"    => $content,
    "wapbody" => $wapcontent
  );

  $enclosure = $tmp;

  if($content || $wapcontent){ $db->sqlexe( $db->mkUpdatesql("art_body", $enclosure, "art_id=".intval($art_id)) ); }

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "文章修改成功！";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败！";
    die(json_encode($msg));
  }
}

//===========================================================
//print_r($res);

$smarty->assign("cats",getCatalog(0,0,$catid));
$smarty->assign("res",$res);
$smarty->assign("pics",$picArr);
$smarty->display("article/art.edit.tpl");

?>