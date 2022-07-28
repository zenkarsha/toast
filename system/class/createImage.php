<?php
class createImage
{
  function Create($text, $directpost, $config, $model)
  {
    include_once './system/function/systemFunction.php';

    $template = 1;
    switch ($template) {
      case 1:
        $fontsize = 30;
        $font = './font/SourceHanSansTW-Light.ttf';
        $image = imagecreatefromjpeg('images/basemap.jpg');
        break;
      case 2:
        $fontsize = 9;
        $font = './font/SourceHanSansTW-Regular.ttf';
        $image = imagecreatefromjpeg('images/basemap2.jpg');
        break;
    }

    //color
    $fontcolor = imagecolorallocate($image, 150, 101, 69);

    //text
    if($text == null) $text = '2x3 = 6
5x2 = 10
6x6 = 36
7x9 = 63';

    if(strlen($text) > 56) $text = utf8_substr($text,0,56);
    $text = autoWrap($text, 4);

    switch ($template) {
      case 1:
        imagettftext($image, $fontsize, 28, 88, 178, $fontcolor, $font, $text);
        break;
      case 2:
        imagettftext($image, $fontsize, 18, 414, 242, $fontcolor, $font, $text);
        break;
    }
    imageflip($image, IMG_FLIP_HORIZONTAL);

    //create image
    switch ($directpost) {
      case 1:
        ob_start();
        imagepng($image,null,9,null);
        $image = ob_get_contents();
        ob_end_clean();
        @imagedestroy($image);
        print '<img src="data:image/png;base64,'.base64_encode($image).'"/>';
        break;

      case 2:
        header('Content-Type: image/png');
        $filename = base62(strrev(time()/930+514)).genRandomString(3);
        $save = "./showcase/".$filename.".png";
        imagepng($image,$save,9,null);

        $ip = getUserIP();
        $device = $_SERVER['HTTP_USER_AGENT'];
        $model->itemInsert($filename,$ip,$text,$device);

        $url = $config['site']['path'].$filename;
        header("Location: $url");
        break;

      default:
        header('Content-Type: image/png');
        header("Content-Transfer-Encoding: binary");
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' .$config['application']['download-filename']);
        imagepng($image, null, 9, null);

        @imagedestroy($image);
        break;
    }
  }
}
