<?php
/**********************************
 * @类名 PageClass
 * @参数 $page           当前页
 *      $pagesize       每页记录
 *      $recordcount    总记录
 *      $url            页面地址
 *      $showpage       面显示格式：显示链接的页数为2*$showpage + 1如$showpage=2页面显示[首页][上一页]1 2 3 4 5[下一页][尾页]
 **********************************/
class PageClass
{
  private $page;                   //当前页
  private $pagesize;               //每页显示记录
  private $recordcount;            //记录总数
  private $pageNumber;             //总页数
  private $url;                    //当前url
  private $showpage;               //页面显示格式
  private $di;
  private $de;

  function __construct($page = 1, $pagesize = 1, $recordcount = 1, $url, $showpage = 2){
    $this->recordcount = $this->numeric($recordcount);
    $this->pagesize    = $this->numeric($pagesize);
    $this->page        = $this->numeric($page);
    $this->pageNumber  = ceil($recordcount / $pagesize);
    $this->url         = $url;
    if($this->recordcount < 0) $this->recordcount = 0;
    if($this->page < 1) $this->page = 1;
    if($this->pageNumber < 1) $this->pageNumber = 1;
    if($this->page > $this->pageNumber) $this->page = $this->pageNumber;

//    $this->limit = ( $this->page - 1 ) * $this->pagesize;
    $this->di = $this->page - $showpage;
    $this->de = $this->page + $showpage;

    if($this->di < 1){
      $this->de = $this->de + (1 - $this->di);
      $this->di = 1;
    }

    if($this->de > $this->pageNumber){
      $this->di = $this->di - ($this->de - $this->pageNumber);
      $this->de = $this->pageNumber;
    }

    if($this->di < 1) $this->di = 1;
  }

  public function numeric($num){
    if(strlen($num)){
      $pattern = "/^[0-9]+$/";
      if(!preg_match($pattern, $num)){
        $num = 1;
      }else{
        $num = intval($num);
      }
    }else{
      $num = 1;
    }
    return $num;
  }

  //地址替换
  public function page_replace($page){
    return str_replace("{page}", $page, $this->url);
  }

  public function firstPage(){
    if($this->page != 1){
      return "<a href='" . $this->page_replace(1) . "&rn=".$this->recordcount."'>首页</a>";
    }else{
      return "<span>首页</span>";
    }
  }
  //上一页
  public function prevPage(){
    if($this->page != 1){
      return "<a href='" . $this->page_replace($this->page - 1) . "&rn=".$this->recordcount."' title='上一页'><</a>";
    }else{
      return "<span><</span>";
    }
  }
  //下一页
  public function nextPage(){
    if($this->page != $this->pageNumber){
      return "<a href='" . $this->page_replace($this->page + 1) . "&rn=".$this->recordcount."' title='下一页'>></a>";
    }else{
      return "<span>></span>";
    }
  }
  //尾页
  public function lastPage(){
    if($this->page != $this->pageNumber){
      return "<a href='" . $this->page_replace($this->pageNumber) . "&rn=".$this->recordcount."' title='尾页'>尾页</a>";
    }else{
      return "<span>尾页</span>";
    }
  }
  //输出
  public function showPage($id = 'page'){
    $str  = "<div id=" . $id ." class='page'>";
//    $str .= $this->firstPage();
    $str .= $this->prevPage();
    if($this->di > 1){
      $str .= "<span class='pagination'>...</span>";
    }
    for($i = $this->di; $i <= $this->de; $i++){
      if($i == $this->page){
        $str .= "<a href='" . $this->page_replace($i) . "&rn=".$this->recordcount."' title='第" . $i . "页' class='cur'>" . $i ."</a>";
      }else{
        $str .= "<a href='" . $this->page_replace($i) . "&rn=".$this->recordcount."' title='第" . $i . "页'>" . $i . "</a>";
      }
    }
    if($this->de < $this->pageNumber){
      $str .= "<span class='pagination'>...</span>";
    }
    $str .= $this->nextPage();
//    $str .= $this->lastPage();
    $str .= "<span class='pageRemark'>共<b>" . $this->pageNumber . "</b>页<b>" . $this->recordcount . "条数据</b></span>";
    $str .= "</div>";

    return $str;
  }
}

?>