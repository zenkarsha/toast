<?php

class ajaxController extends View
{
  var $model;
  function __construct ()
  {
    include './system/controller/partial/__construct.php';
  }
}
class ajaxWall extends ajaxController
{
  function __construct()
  {
    parent::__construct();

    $perPage = 6;
    $showcaseList = null;

    if(isset($_POST['page']))
    {
      $total = $this->model->countTotal('showcase');
      $page = ($_POST['page']+1) * $perPage;

      if($total < $page)
      {
        echo '';
      }
      else
      {
        if(($page + $perPage) > $total)
          $limit = $page.'|'.($total-$page+1);
        else
          $limit = $page.'|'.$perPage;

        $this->model->commonSelect('showcase',null,'id','DESC',$limit);
        while($data = $this->model->getData()) {
          $showcaseList.= viewParser('partial/html/showcaseItem.html',array(
            '$url' => $this->config['site']['path'].$data['url'],
            '$image' => $this->config['site']['path'].'showcase/'.$data['url'].'.png',
            '$title' => $data['text3'].'的懺悔'
          ));
        }
        echo $showcaseList;
      }
    }
  }
}
class ajaxHot extends ajaxController
{
  function __construct()
  {
    parent::__construct();

    $perPage = 6;
    $showcaseList = null;

    if(isset($_POST['page']))
    {
      $total = $this->model->countTotal('showcase');
      $page = ($_POST['page']+1) * $perPage;

      if($total < $page)
      {
        echo '';
      }
      else
      {
        if(($page + $perPage) > $total)
          $limit = $page.'|'.($total-$page+1);
        else
          $limit = $page.'|'.$perPage;

        $this->model->commonSelect('showcase',null,'view','DESC',$limit);
        while($data = $this->model->getData()) {
          $showcaseList.= viewParser('partial/html/showcaseItem.html',array(
            '$url' => $this->config['site']['path'].$data['url'],
            '$image' => $this->config['site']['path'].'showcase/'.$data['url'].'.png',
            '$title' => $data['text3'].'的懺悔'
          ));
        }
        echo $showcaseList;
      }
    }
  }
}
