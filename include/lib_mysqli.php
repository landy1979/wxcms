<?php

/**
 * Created by lzjs208@hotmail.com .
 * User: lzjs208
 * Date: 2016/7/26
 * Time: 10:46
 */
class lib_mysqli
{
  protected $mysqli;
  public $sql;
  protected $rs;
  protected $query_num = 0;
  protected $fetch_mode = MYSQLI_ASSOC;
  protected $cache;
  protected $reload = false;
  protected $cache_mark = true;

  //构造函数：返回一个mysqli对象
  public function __construct($dbhost, $dbuser, $dbpass, $dbname, $dbport, $dbcharset){
    $this->mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
    if(mysqli_connect_errno()){
      $this->mysqli = false;
      echo '连接错误：'.mysqli_connect_error();
      die();
    }else{
      $this->mysqli->set_charset($dbcharset);
    }
  }

  //析构函数：释放结果集和关闭数据库连接
  public function __destruct(){
    $this->free();
    $this->close();
  }

  //事务开始
  public function begin($off=false){
    return $this->mysqli->autocommit($off);
  }
  //事务提交
  public function commit(){
    return $this->mysqli->commit();
  }
  //回退当前事务
  public function rollback(){
    return $this->mysqli->rollback();
  }

  public function mysqli_errno(){
    return $this->mysqli->errno;
  }

  //释放结果集所占资源
  protected function free(){
    @$this->rs->free();
  }

  //关闭数据库连接
  protected function close(){
    $this->mysqli->close();
  }

  //执行sql语句查询
  public function query($sql, $limit = null){
    $sql = $this->get_query_sql($sql, $limit);
    $this->sql[] = $sql;
    $this->rs = $this->mysqli->query($sql);
    if(!$this->rs){
      return 0;
//      echo "<p>错误：".$this->mysqli->error."</p>";
//      echo "<p>sql:".$sql."</p>";
      die();
    }else{
      $this->query_num++;
      return $this->rs;
    }
  }

  //返回由insert、update、delete等语句产生的id
  public function sqlexe($sql='',$_backId=false){
    $result = $this->query($sql) or die($this->mysqli->error);
    if($_backId){
      $id = $this->mysqli->insert_id;
      return $id;
    }else{
      return $result;
    }
  }

  public function delRow($sql, $delsql){
    if($this->getAll($sql)){
      $this->query($delsql);
      return true;
    }else{
      return false;
    }
  }

  public function query_num(){
    return $this->query_num;
  }

  //获取结果集
  protected function fetch(){
    echo $this->mysqli->error;
    return $this->rs->fetch_array($this->fetch_mode);
  }

  //获取单条记录
  public function getRow($sql, $fetch_mode = MYSQLI_ASSOC){
    $this->query($sql, 1);
    $this->fetch_mode = $fetch_mode;
    $row = $this->fetch();
    $this->free();
    return $row;
  }

  //获取所有结果集
  public function getAll($sql, $limit = null, $fetch_mode = MYSQLI_ASSOC){
    $this->query($sql, $limit);
    $all_rows = array();
    $this->fetch_mode = $fetch_mode;
    while($rows = $this->fetch()){
      $all_rows[] = $rows;
    }
    $this->free();
    return $all_rows;
  }

  //缓存行
  public function cache_row($sql, $reload = false){
    $this->reload = $reload;
    $sql = $this->get_query_sql($sql, 1);
    return $this->get_cache($sql, 'getRow');
  }

  //缓存所有结果集
  public function cache_all($sql, $reload = false, $limit = null){
    $this->reload = $reload;
    $sql = $this->get_query_sql($sql, $limit);
    return $this->get_cache($sql, 'getAll');
  }

  //获取查询的sql语句
  public function get_query_sql($sql, $limit = null){
    if (@preg_match("/[0-9]+(,[ ]?[0-9]+)?/is", $limit) && !preg_match("/ LIMIT [0-9]+(,[ ]?[0-9]+)?$/is", $sql)){
      $sql .= " LIMIT ". $limit;
    }
    return $sql;
  }

  //从缓存中获取数据
  protected function get_cache($sql, $method){
    $cache_file = md5($sql, $method);
    $res = $this->cache->get($cache_file);
    if(!$res){      //如果缓存文件过期或不存在的话,返回false;如果缓存文件存在且未过期,返回缓存数据
      $res = $this->$method($sql);    //先从缓存中读取数据,如果缓存中没数据,则从数据库中取数据
      if($res && $this->cache_mark && !$this->reload){
        $this->cache->set($cache_file);       //如果缓存文件过期或不存在,将重新从数据库中查询的数据存入缓存文件
      }
    }
    return $res;
  }

  //获取一条记录
  public function fetcharray($sql, $fetch_mode = MYSQLI_NUM){
    $res = $this->query($sql) or die(mysqli_error());
    $number = mysqli_num_rows($res);
    if($number > 0){
      $row = mysqli_fetch_array($res);
      return $row;
    }else{
      return $number;
    }
  }

  //获取一条记录的一个字段的值
  public function fetchfiled($sql, $fetch_mode = MYSQLI_NUM){
    $res = $this->query($sql) or die(mysqli_error());
    $rows = mysqli_num_rows($res);
    if($rows > 0){
      $num = mysqli_fetch_array($res, $fetch_mode);
      if(!is_array($num)) return null;
      return $num[0];
    }else{
      return null;
    }
  }

  //构造update语句
  public function mkUpdatesql($table='', $column, $where=''){
    $sql = "UPDATE `".$table."` SET ";
    if( is_array($column) ){
      foreach ($column as $col=>$val) {
        $cols = is_int($val) || is_float($val) ? "`{$col}`={$val}," : "`{$col}`='{$val}',";
        $sql .= $cols;
      }
      $sql = rtrim($sql,"\,");
    }else{
      $sql .= $column;
    }
    if( !empty($where) ) $sql .= (" WHERE ".trim($where));
    return $sql;
  }

  //构造insert语句
  public function mkInsertsql($table, $column){
    $f = ''; $v = '';
    $sql = "insert into `".$table."` (";
    if( is_array($column) ){
      foreach ($column as $col=>$val) {
        $f .= "`{$col}`,";
        if( is_int($val) || is_float($val) ){ $v .= "{$val},"; } else { $v .= "'{$val}',"; }
      }
    }
    $f = rtrim($f,"\,");
    $v = rtrim($v,"\,");
    $sql .= "{$f}) values(";
    $sql .= "{$v})";
    return $sql;
  }

  //批量插入
  public function mkBatchInsertsql($table, $column){
    $f = ''; $v = ''; $i = 0;
    $aux = array();
    $sql = "insert into `".$table."`(";
      foreach($column as $co){
        foreach($co as $col=>$val){
          if( $i == 0 )$f .= "`{$col}`,";
          if( is_int($val) || is_float($val) ){ $v .= "{$val},"; } else { $v .= "'{$val}',"; }
        }
        $v = rtrim($v, "\,");
        $aux[] = "(" . $v . ")";
        $v = "";
      $i++;
    }
    $multi = join( "," , $aux );
    $f = rtrim($f, "\,");
    $sql .= "{$f}) values";
    $sql .= $multi;
    return $sql;
  }
}//class end