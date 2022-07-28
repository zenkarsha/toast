<?php

class appController extends View
{
  var $model;
  function __construct ()
  {
    include './system/controller/partial/__construct.php';
  }
}
class generate extends appController
{
  function __construct()
  {
    parent::__construct();

    include './system/class/createImage.php';

    if(strlen($_POST['text']) != strlen(strip_tags($_POST['text']))) exit();

    @$text = clearString($_POST['text']);
    @$directpost = intval($_POST['directpost']);

    $obj = new createImage();
    $obj -> Create($text, $directpost, $this->config, $this->model);
  }
}
class wall extends appController
{
  function __construct()
  {
    parent::__construct();

    $perPage = 6;
    $showcaseList = null;

    $total = $this->model->countTotal('showcase');
    $this->model->commonSelect('showcase',null,'id','DESC','0|'.$perPage);
    while($data = $this->model->getData()) {
      $showcaseList.= viewParser('partial/html/showcaseItem.html',array(
        '$url' => $this->config['site']['path'].$data['url'],
        '$image' => $this->config['site']['path'].'showcase/'.$data['url'].'.png',
        '$title' => $data['text3'].'的懺悔'
      ));
    }
    echo pageCreator($this->config,'default',array(
      '$content' => viewParser('showcase.html',array(
        '$path' => $this->config['site']['path'],
        '$total' => $total,
        '$showcase-list' => $showcaseList
      )),
      '$head-custom' => codePackage(viewParser('partial/stylesheets/showcase.css'),'style'),
      '$foot-custom' => viewParser('partial/html/showcaseModal.html').codePackage(viewParser('partial/javascript/showcase.js', array(
          '$path' => $this->config['site']['path'],
          '$page' => 'wall'
        )),'script')
    ));
  }
}
class hot extends appController
{
  function __construct()
  {
    parent::__construct();

    $perPage = 6;
    $showcaseList = null;

    $total = $this->model->countTotal('showcase');
    $this->model->commonSelect('showcase',null,'view','DESC','0|'.$perPage);
    while($data = $this->model->getData()) {
      $showcaseList.= viewParser('partial/html/showcaseItem.html',array(
        '$url' => $this->config['site']['path'].$data['url'],
        '$image' => $this->config['site']['path'].'showcase/'.$data['url'].'.png',
        '$title' => $data['text3'].'的懺悔'
      ));
    }
    echo pageCreator($this->config,'default',array(
      '$content' => viewParser('hot.html',array(
        '$path' => $this->config['site']['path'],
        '$total' => $total,
        '$showcase-list' => $showcaseList
      )),
      '$head-custom' => codePackage(viewParser('partial/stylesheets/showcase.css'),'style'),
      '$foot-custom' => viewParser('partial/html/showcaseModal.html').codePackage(viewParser('partial/javascript/showcase.js', array(
          '$path' => $this->config['site']['path'],
          '$page' => 'hot'
        )),'script')
    ));

  }
}
class showcaseDetail extends appController
{
  function __construct($url)
  {
    parent::__construct();


    $this->model->checkItem($url);
    $data = $this->model->getData();
    if($data['id']!==null)
    {
      //insert analytics
      if(!isset($_SESSION['showcase'.$data['id']]))
      {
        $ip = getUserIP();
        $_SESSION['showcase'.$data['id']] = $ip;
        $this->model->viewUpdate($data['id']);
      }
      echo pageCreator($this->config,'default',array(
        '$content' => viewParser('showcase-detail.html',array(
          '$path' => $this->config['site']['path'],
          '$url' => $data['url'],
          '$image' => 'showcase/'.$data['url'].'.png'
        )),
        '$og' => viewParser('_og.html', array(
            '$title' => '這裡有一片記憶吐司',
            '$type' => $this->config['og']['type'],
            '$url' => $this->config['site']['path'].$data['url'],
            '$image' => $this->config['site']['path'].'showcase/'.$data['url'].'.png',
            '$sitename' => '記憶吐司產生器',
            '$description' => ''
        )),
        '$head-custom' => codePackage(viewParser('partial/stylesheets/showcase.css'),'style')
      ));
    }
    else
    {
      $url = $this->config['site']['path'];
      header("Location: $url");
    }
  }
}
