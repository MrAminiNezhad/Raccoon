<?php

error_reporting(E_ERROR);

$panel = require  __DIR__ . '/config.php';
$crisp = $panel['crisp'];

session_start();

$selected_language = isset($_GET['lang']) ? $_SESSION['selected_language'] = $_GET['lang'] : (isset($_SESSION['selected_language']) ? $_SESSION['selected_language'] : 'fa');

$lang = $selected_language == 'en' ? require 'lang/en.php' : require 'lang/fa.php';
if (strlen($crisp) >= 20) {
    $crisp_script = "<script type='text/javascript'>window.\$crisp=[];window.CRISP_WEBSITE_ID='{$panel['crisp']}';(function(){d=document;s=d.createElement('script');s.src='https://client.crisp.chat/l.js';s.async=1;d.getElementsByTagName('head')[0].appendChild(s);})();</script>";
} else {
    $crisp_script = ""; 
}
?>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $lang['title_index_page']; ?></title>
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="home-header-section">
    <figure class="banner-right-img left_icon img">
      <img src="assets/images/header-right-img.png" alt="" class="star">
    </figure>
    <header class="header">
      <div class="main-header">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg navbar-light p-0">
            <a class="navbar-brand pt-0" href="index.html">
              <img src="assets/images/whiz-cyber-logo.png" alt="" class="img-fluid diverge-logo">
            </a>
          </nav>
        </div>
      </div>
    </header>
    <div class="home-banner-section overflow-hidden position-relative">
      <center>
        <div class="logo">
          <p><?php echo $lang['search_bar']; ?></p>
        </div>
        <form action="search.php" method="get">
          <div class="bar">
            <input class="searchbar" type="text" title="Search" id="search_query" name="id" required>
          </div>
          <div class="buttons">
            <button class="button" type="submit"><?php echo $lang['button_search']; ?></button>
          </div>
        </form>
        <div class="banner-container-box">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 mb-md-0 mb-4 text-md-left text-center order-lg-1 order-2"></div>
              <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 order-lg-2 order-1">
                <div class="banner-img-content position-relative">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="footer-section">
    <div class="footer-bar text-center">
      <div class="row">
        <div class="footer-bar-content w-100">
          <p><?php echo $lang['select_lang']; ?>
            <a href="?lang=fa">ðŸ‡®ðŸ‡·</a>
            <a href="?lang=en">ðŸ‡ºðŸ‡¸</a>
          </p>
          <p class="text-size-16 mb-0">Coded By<a href="https://github.com/MrAminiNezhad">MrAminiNezhad</a> Ã‚Â© 2023. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/animations.js"></script>
  <?php echo $crisp_script; ?>
</body>

</html>
