<?php

class Model
{
	public $dataAccess;

	function __construct($dataAccess)
	{
		$this->dataAccess=$dataAccess;
	}
	function getData()
	{
		if ($data=$this->dataAccess->getRow())
			return $data;
		else
			return false;
	}

	//read
	function commonSelect($table,$where=null,$order=null,$sort=null,$limit=null)
	{
    if($where!==null)
    {
      $where=explode('|',$where);
      $whereScript=' WHERE `'.$where[0].'` = \''.$where[1].'\' ';
    }
		if($order!==null) $orderScript=' ORDER BY `'.$order.'` '.$sort.' ';
		if($limit!==null)
		{
			$limit=explode('|',$limit);
			$limitScript=' LIMIT '.$limit[0].','.$limit[1].' ';
		}

		$sql = "SELECT * FROM `$table`".$whereScript.$orderScript.$limitScript;
		$this->dataAccess->fetch($sql);
	}
  function checkItem($url)
  {
    $sql = "SELECT * FROM `showcase` WHERE `url` = '$url'";
    $this->dataAccess->fetch($sql);
  }

  //insert
  function itemInsert($url,$ip,$text,$device)
  {
    $sql = "INSERT INTO `showcase` (`id`, `url`, `ip`, `text`, `device`, `view`, `time`) VALUES ( '', '$url', '$ip', '$text', '$device','',NOW())";
    $this->dataAccess->fetch($sql);
  }

  //delete
  function commonDelete($table,$id)
  {
    $sql = "DELETE FROM `$table` WHERE `id` = '$id'";
    $this->dataAccess->fetch($sql);
  }

  //search
  function search($keyword)
  {
    $sql = "SELECT * FROM `showcase` WHERE `title` LIKE '%$keyword%' OR `tag` LIKE '%$keyword%'";
    $this->dataAccess->fetch($sql);
  }

  //count
  function countTotal($table)
  {
    $sql = "SELECT count(*) as total FROM $table";
    $res=mysql_query($sql);
    $data=mysql_fetch_assoc($res);
    return $data[total];
  }

  //update
  function viewUpdate($id)
  {
    $sql = "UPDATE `showcase` SET view = view + 1 WHERE `id` = $id";
    $this->dataAccess->fetch($sql);
  }
}

?>
