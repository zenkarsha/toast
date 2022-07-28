<?php

class Controller
{
  var $view;
  function Controller()
  {
    //INCLUDE CONFIG
    include_once './system/config/systemConfig.php';
    $this->config = $config;
    $this->parent = $config['site']['parent'];

    //INCLUDE FUNCTION
    include_once './system/function/systemFunction.php';
    include_once './system/function/customFunction.php';

    //DEAL WITH URL
    $this->url = explodeUrl($this->config['site']['path']);

    //USERAGENT
    $this->useragent = mobileDetect();
    include_once './system/controller/defaultController.php';
    switch($this->url[1])
    {
      // default
      case 'index':
        $this->view = new pageLoader($this->url[1]);
        break;

      case 'wall':
        $this->view = new pageLoader($this->url[1]);
        break;

      case 'hot':
        $this->view = new pageLoader($this->url[1]);
        break;

      case 'og':
        $this->view = new og();
        break;

      // application actions
      case 'generate':
        include_once './system/controller/appController.php';
        $this->view=new generate();
        break;

      case '__index':
        include_once './system/controller/appController.php';
        $this->view = new index();
        break;

      case '__wall':
        include_once './system/controller/appController.php';
        $this->view=new wall();
        break;

      case '__hot':
        include_once './system/controller/appController.php';
        $this->view=new hot();
        break;

      //ajax
      case 'ajax-wall':
        include_once './system/controller/ajaxController.php';
        $this->view=new ajaxWall();
        break;

      case 'ajax-hot':
        include_once './system/controller/ajaxController.php';
        $this->view=new ajaxHot();
        break;

      default:
        include_once './system/controller/appController.php';
        $this->view = new index();
        break;
    }
  }
}

?>
