<?php

class View
{
	var $model;
	function __construct()
	{
    include './system/controller/partial/__construct.php';
	}
}
class pageLoader extends View
{
  function __construct($pagename)
  {
    parent::__construct();

    $url = $this->config['site']['path'].'__'.$pagename.'?'.time();
    echo file_get_contents($url);

  }
}
class index extends View
{
  function __construct()
  {
    parent::__construct();

    echo pageCreator($this->config,'default',array(
      '$content' => viewParser('index.html',array(
        '$title' => $this->config['site']['title'],
        '$description' => $this->config['site']['description'],
        '$path' => $this->config['site']['path'],
        '$copyright' => $this->config['site']['copyright']
      ))
    ));
  }
}
class og extends View
{
  function __construct()
  {
    parent::__construct();

    echo json_encode($this->config['og']);
  }
}
