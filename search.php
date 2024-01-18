<?php
require_once './static/functions.php';
require_once './static/jdf.php';
require './config.php';

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $current_page_url = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    
$status = 'لطفا نام کانفینگ خود را وارد بکنید.';
if (isset($_GET['username'])) {
   $client_info =  client_info($_GET['username']);
} else if (isset($_GET['uuid'])) {

   $client_info = client_info(null, $_GET['uuid']);
}


$selected_language = isset($_GET['lang']) ? $_SESSION['selected_language'] = $_GET['lang'] : (isset($_SESSION['selected_language']) ? $_SESSION['selected_language'] : 'fa');

$lang = $selected_language == 'en' ? require './lang/en.php' : require './lang/fa.php';

if (strlen($crisp) >= 20) $crisp_script = "<script type='text/javascript'>window.\$crisp=[];window.CRISP_WEBSITE_ID='{$crisp}';(function(){d=document;s=d.createElement('script');s.src='https://client.crisp.chat/l.js';s.async=1;d.getElementsByTagName('head')[0].appendChild(s);})();</script>";
if (strlen($goftino) >= 3) $goftino_script ="<script type='text/javascript'> !function(){var i='{$goftino}',d=document,g=d.createElement('script'),s='https://www.goftino.com/widget/'+i,l=localStorage.getItem('goftino_'+i);g.type='text/javascript',g.async=!0,g.src=l?s+'?o='+l:s;d.getElementsByTagName('head')[0].appendChild(g);}(); </script>";
if (strlen($raychat) >= 5) $raychat_script ="<script type='text/javascript'>   window.RAYCHAT_TOKEN = '$raychat';     (function () {       d = document;       s = d.createElement('script');       s.src = 'https://widget-react.raychat.io/install/widget.js';       s.async = 1;       d.getElementsByTagName('head')[0].appendChild(s);     })(); </script>";
?>
<html dir="rtl">

<head>
   <link rel="shortcut icon" href="assets/images/raccoon.ico">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="UTF-8">
   <title><?php echo $lang['title_serch_page']; ?></title>
   <link href="assets/css/style2.css" rel="stylesheet" type="text/css">
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
   <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
   <script src="assets/js/popper.min.js"></script>
</head>

<body style="background-color: #171d34">
   </div>
   <div class="container" style="width: 90%;margin: 20px auto">
      <div class="d-head">
         <p class="p-head"><?php echo $lang['search_status']; ?></p>
      </div>
      <hr style="border-radius: 50px; height: 2px; background-color: #edede9; width: 100%" ;>
      <div class="card" style="background-color: #2b34428a;border-radius: 15px;">
         <div class="card-body" style="display: flex;justify-content: space-between;padding-top: 25px">
            <h5 class="card-title name-conf"><?php echo $lang['config_name']; ?></h5>
            <p class="card-text"><?php echo $client_info['username'] ?> </p>
         </div>
      </div>
      <br>
      <div class="card" style="background-color: #2b34428a;border-radius: 15px;">
         <div class="card-body " style="display: flex;justify-content: space-between">
            <a class="card-link l1">
               <svg style="margin-left: 4px" fill="#f0ebd8" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                  <path d="M576 0c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V32c0-17.7 14.3-32 32-32zM448 96c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V128c0-17.7 14.3-32 32-32zM352 224V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V224c0-17.7 14.3-32 32-32s32 14.3 32 32zM192 288c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V320c0-17.7 14.3-32 32-32zM96 416v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V416c0-17.7 14.3-32 32-32s32 14.3 32 32z" />
               </svg>
               <?php echo $lang['config_status']; ?>
            </a>
            <a class="card-link l1" style="direction: rtl"> <?php echo $client_info['status']; ?> </a>
         </div>
         <div class="card-body " style="display: flex;justify-content: space-between">
            <a class="card-link l1">
               <svg style="margin-left: 4px" fill="#f0ebd8" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                  <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
               </svg>
               <?php echo $lang['expiry_date']; ?>
            </a>
            <a class="card-link l1" style="direction: ltr"> <?php echo $client_info['expire_time']; ?> </a>
         </div>
         <div class="card-body " style="display: flex;justify-content: space-between">
            <a class="card-link l1">
               <svg style="margin-left: 4px" fill="#f0ebd8" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                  <path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z" />
               </svg>
               <?php echo $lang['total']; ?>
            </a>
            <a class="card-link l1" style="direction: rtl"> <?php echo $client_info['total']; ?><?php echo $lang['gb']; ?> </a>
         </div>
      </div>
   </div>
   </div>
   <div class="container">
      <div class="flex-container">
         <div class="flex-item">
            <p class="card-text text-center"> <?php echo $client_info['traffic_used']; ?><?php echo $lang['gb']; ?> </p>
            <p class="card-text car-2 text-center">
               <svg style="margin-left: 4px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                  <path d="M96 0C60.7 0 32 28.7 32 64V448c-17.7 0-32 14.3-32 32s14.3 32 32 32H320c17.7 0 32-14.3 32-32s-14.3-32-32-32V304h16c22.1 0 40 17.9 40 40v32c0 39.8 32.2 72 72 72s72-32.2 72-72V252.3c32.5-10.2 56-40.5 56-76.3V144c0-8.8-7.2-16-16-16H544V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H480V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H432c-8.8 0-16 7.2-16 16v32c0 35.8 23.5 66.1 56 76.3V376c0 13.3-10.7 24-24 24s-24-10.7-24-24V344c0-48.6-39.4-88-88-88H320V64c0-35.3-28.7-64-64-64H96zM216.9 82.7c6 4 8.5 11.5 6.3 18.3l-25 74.9H256c6.7 0 12.7 4.2 15 10.4s.5 13.3-4.6 17.7l-112 96c-5.5 4.7-13.4 5.1-19.3 1.1s-8.5-11.5-6.3-18.3l25-74.9H96c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7l112-96c5.5-4.7 13.4-5.1 19.3-1.1z" />
               </svg>
               <?php echo $lang['total_traffic']; ?>
            </p>
         </div>
         <div class="flex-item">
            <p class="card-text text-center"> <?php echo $client_info['download']; ?><?php echo $lang['gb']; ?></p>
            <p class="card-text car-2  text-center">
               <svg style="margin-left: 4px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                  <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
               </svg>
               <?php echo $lang['download']; ?>
            </p>
         </div>
         <div class="flex-item">
            <p class="card-text car-1 text-center"> <?php echo $client_info['upload']; ?><?php echo $lang['gb']; ?></p>
            <p class="card-text car-2 text-center">
               <svg style="margin-left: 4px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                  <path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
               </svg>
               <?php echo $lang['upload']; ?>
            </p>
         </div>
         <div class="flex-item">
            <p class="card-text text-center"> <?php echo $client_info['remaining_traffic']; ?><?php echo $lang['gb']; ?> </p>
            <p class="card-text car-2 text-center">
               <svg style="margin-left: 4px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                  <path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z" />
               </svg>
               <?php echo $lang['baghimande']; ?>
            </p>
         </div>
         <div class="flex-item">
            <p class="card-text text-center"> <?php echo $client_info['remaining_days']; ?><?php echo $lang['day']; ?> </p>
            <p class="card-text car-2 text-center">
               <svg style="margin-left: 4px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                  <path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM288 437v11H96V437c0-25.5 10.1-49.9 28.1-67.9L192 301.3l67.9 67.9c18 18 28.1 42.4 28.1 67.9z" />
               </svg>
               <?php echo $lang['remaining_days']; ?>
            </p>
         </div>
         <div class="flex-item">
            <p class="card-text text-center"> <?php echo $client_info['total']; ?><?php echo $lang['gb']; ?> </p>
            <p class="card-text car-2 text-center">
               <svg style="margin-left: 4px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                  <path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM288 437v11H96V437c0-25.5 10.1-49.9 28.1-67.9L192 301.3l67.9 67.9c18 18 28.1 42.4 28.1 67.9z" />
               </svg>
               <?php echo $lang['total']; ?>
            </p>
         </div>
      </div>
   </div>
   <div class="container">
    <div class="d-head " style="justify-content: space-between">
        <p class="p-head">لینک کوتاه این کانفیگ</p>
      </div>
      <hr style="border-radius: 50px; height: 2px; background-color: #edede9; width: 100%" ;>

      <div class="search-wrapper cf">
        <input type="text"  value="<?php echo $current_page_url; ?>" id="myInput" readonly style="box-shadow: none">
        <button type="submit" onclick="myFunction()">کپی لینک</button>
    </div>

    <div class="d-head " style="justify-content: space-between">
        <p class="p-head"> <?php echo $lang['linkdownload']; ?> </p>
      </div>
      <hr style="border-radius: 50px; height: 2px; background-color: #edede9; width: 100%" ;>
      <div class="flex-container">
         <a href="https://sourceforge.net/projects/netmodhttp/" class="flex-item1">
            <div>
               NetMod
               <svg style="margin-left: 10px;font-size: 21px;" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 384 512">
                  <path d="M0 93.7l183.6-25.3v177.4H0V93.7zm0 324.6l183.6 25.3V268.4H0v149.9zm203.8 28L448 480V268.4H203.8v177.9zm0-380.6v180.1H448V32L203.8 65.7z" />
               </svg>
            </div>
         </a>
         <a href="https://github.com/InvisibleManVPN/InvisibleMan-XRayClient/releases/" class="flex-item1">
            <div>
               InvisMan
               <svg style="margin-left: 10px;font-size: 21px;" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 384 512">
                  <path d="M0 93.7l183.6-25.3v177.4H0V93.7zm0 324.6l183.6 25.3V268.4H0v149.9zm203.8 28L448 480V268.4H203.8v177.9zm0-380.6v180.1H448V32L203.8 65.7z" />
               </svg>
            </div>
         </a>
         <a href="https://github.com/MatsuriDayo/nekoray/releases" class="flex-item1">
            <div>
               Nekoray
               <svg style="margin-left: 10px;font-size: 21px;" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 384 512">
                  <path d="M0 93.7l183.6-25.3v177.4H0V93.7zm0 324.6l183.6 25.3V268.4H0v149.9zm203.8 28L448 480V268.4H203.8v177.9zm0-380.6v180.1H448V32L203.8 65.7z" />
               </svg>
            </div>
         </a>
         <a href="https://apps.apple.com/us/app/v2box-v2ray-client/id6446814690" class="flex-item1">
            <div>
               V2box
               <svg style="margin-left: 10px;font-size: 21px;" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 384 512">
                  <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z" />
               </svg>
            </div>
         </a>
         <a href="https://apps.apple.com/us/app/foxray/id6448898396" class="flex-item1">
            <div>
               Foxray
               <svg style="margin-left: 10px;font-size: 21px;" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 384 512">
                  <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z" />
               </svg>
            </div>
         </a>
         <a href="https://github.com/2dust/v2rayNG/releases/download/1.8.5/v2rayNG_1.8.5.apk" class="flex-item1">
            <div>
               V2rayNG
               <svg style="margin-left: 10px" fill="#f1faee" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 576 512">
                  <path d="M420.55,301.93a24,24,0,1,1,24-24,24,24,0,0,1-24,24m-265.1,0a24,24,0,1,1,24-24,24,24,0,0,1-24,24m273.7-144.48,47.94-83a10,10,0,1,0-17.27-10h0l-48.54,84.07a301.25,301.25,0,0,0-246.56,0L116.18,64.45a10,10,0,1,0-17.27,10h0l47.94,83C64.53,202.22,8.24,285.55,0,384H576c-8.24-98.45-64.54-181.78-146.85-226.55" />
               </svg>
            </div>
         </a>
      </div>
   </div>
   <?php echo $crisp_script ?? null; ?>
</body>
<script>
function myFunction() {
  // Get the text field
  var copyText = document.getElementById("myInput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
  // Alert the copied text
  alert("Copied the text: " + copyText.value);
}
</script>
</html>
