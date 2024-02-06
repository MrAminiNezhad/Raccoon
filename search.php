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
?>


<!DOCTYPE html>
<html lang="en" dir="rtl">
  <head>
    <link rel="shortcut icon" href="assets/images/raccoon.ico">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $lang['title_serch_page']; ?></title>
    <link rel="stylesheet" href="assets/css/stylee.css" />
  </head>
  <body>
    <div>
      <div class="text_rtl">
        <span>مشخصات سرور</span>
        <!-- <img class="text_rtl_line" src="assets/images/div_2.svg" alt="" /> -->
      </div>
    </div>
    <div class="container">
      <div class="box1">
        <div class="text-container">
          <p><?php echo $lang['config_name']; ?></p>
        </div>
        <div class="text-container2">
          <p><?php echo $client_info['username'] ?></p>
        </div>
      </div>
      <div class="box2">
        <div class="text-container_2_2">
          <p>کپی لینک کوتاه این کانفیگ</p>
        </div>
        <div class="text-container2_2_2" id="copy-text">
          <img src="assets/images/copy.svg" alt="" onclick="copyUrlToClipboard()" style="cursor: pointer;">
        </div>
      </div>
<script>
function copyUrlToClipboard() {
    // گرفتن آدرس صفحه و کپی به کلیپبورد
    var currentUrl = window.location.href;
    navigator.clipboard.writeText(currentUrl)
        .then(function() {
            // نمایش پیام با موفقیت کپی شد
            alert('آدرس با موفقیت کپی شد.');
            console.log('URL copied:', currentUrl);
        })
        .catch(function(err) {
            // نمایش پیام در صورت خطا
            console.error('خطا در کپی آدرس:', err);
        });
}
</script>
      <div class="box3">
        <div class="text-container_3_3">
          <span>کپی لینک اتصال به فیلترشکن</span>
          <span class="x" id="hidden-text"> (جهت دریافت برنامه  های لازم به پایین صفحه مراجعه کنید)</span>
        </div>
        <div class="text-container2_3_3" onclick="copyHiddenText()">
          <img src="assets/images/copy.svg" alt="" />
        </div>
      </div>

      <script>
        function copyHiddenText() {
          var hiddenText = document.getElementById("hidden-text").innerText;

          var dummy = document.createElement("textarea");
          document.body.appendChild(dummy);
          dummy.value = hiddenText;
          dummy.select();
          document.execCommand("copy");
          document.body.removeChild(dummy);

          alert("متن کپی شد: " + hiddenText);
        }
      </script>
    </div>
    <div class="my-container">
      <div class="my-box_l_e">
        <div class="be_r" dir="ltr">
          <p class="be_l_t be_g_s"><?php echo $client_info['status']; ?></p>
          <p class="be_l_t"><?php echo $client_info['expire_time']; ?></p>
          <p class="be_l_t"><?php echo $client_info['total']; ?> <?php echo $lang['gb']; ?></p>
        </div>
        <div class="be_l">
          <p class="be_r_t">
            <span><img class="i_t_c" src="./assets/images/sig.svg" /></span><span><?php echo $lang['config_status']; ?></span>
          </p>
          <p class="be_r_t">
            <span><img class="i_t_c" src="./assets/images/date.svg" /></span><span><?php echo $lang['expiry_date']; ?></span>
          </p>
          <p class="be_r_t">
            <span><img class="i_t_c" src="./assets/images/hagm.svg" /></span><span><?php echo $lang['total']; ?></span>
          </p>
        </div>
      </div>
      <div class="my-box_l_e">
        <div class="be_r" dir="ltr">
          <p class="be_l_t"><?php echo $client_info['traffic_used']; ?> <?php echo $lang['gb']; ?></p>
          <p class="be_l_t"><?php echo $client_info['remaining_traffic']; ?> <?php echo $lang['gb']; ?></p>
          <p class="be_l_t"><?php echo $client_info['remaining_days']; ?><?php echo $lang['day']; ?></p>
        </div>
        <div class="be_l">
          <p class="be_r_t">
            <span><img class="i_t_c" src="./assets/images/c.svg" /></span><?php echo $lang['total_traffic']; ?><span></span>
          </p>
          <p class="be_r_t">
            <span><img class="i_t_c" src="./assets/images/b.svg" /></span><?php echo $lang['baghimande']; ?><span></span>
          </p>
          <p class="be_r_t">
            <span><img class="i_t_c" src="./assets/images/t.svg" /></span><?php echo $lang['remaining_days']; ?><span></span>
          </p>
        </div>
      </div>
      <div class="my-box my2">
        <p class="be_l_t">کد QR</p>
        <center>
          <img class="qr_img" src="./assets/images/con_img/qr_scan.jpg" alt="" />
        </center>
      </div>
      <div class="my-box">
        <div>
          <span class="be_l_t">آمار مصرفی</span>
          <div class="l_text_e_d" dir="ltr">
            <span><img src="assets/images/s.svg" alt="" /></span>
          </div>
        </div>
        <div>
          <div class="bar-container be_l_t" id="barContainer"></div>


<script>
    // درصد های دلخواه خود را اینجا وارد کنید
    var uploadPercentage = <?php echo $client_info['upload'] / $client_info['total'] * 100; ?>;
    var downloadPercentage = <?php echo $client_info['download'] / $client_info['total'] * 100; ?>;
    
    var percentages = [uploadPercentage, downloadPercentage, 100 - uploadPercentage - downloadPercentage];
    
    // متغیرهای متن برای هر بخش
    var textVariables = ["<?php echo $client_info['upload']; ?> GB", "<?php echo $client_info['download']; ?> GB", "<?php echo $client_info['total']; ?> GB"];

    // اجرای کد جاوا اسکریپت بر اساس درصدها
    var container = document.getElementById("barContainer");
    var currentPosition = 0;

    for (var i = 0; i < percentages.length; i++) {
        var bar = document.createElement("div");
        bar.className = "bar";
        bar.style.width = percentages[i] + "%";
        bar.style.left = currentPosition + "%";

        var text = document.createElement("span");
        text.textContent = textVariables[i];
        bar.appendChild(text);

        switch (i) {
            case 0:
                bar.classList.add("first");
                break;
            case 1:
                bar.classList.add("second");
                break;
            case 2:
                bar.classList.add("third");
                break;
            default:
                break;
        }

        container.appendChild(bar);
        currentPosition += percentages[i];
    }
    
    // مقدار باقی‌مانده
    var remaining = <?php echo $client_info['total'] - $client_info['upload'] - $client_info['download']; ?>;
    var remainingBar = document.createElement("div");
    remainingBar.className = "bar remaining";
    remainingBar.style.width = remaining + "%";
    remainingBar.style.left = currentPosition + "%";

    var remainingText = document.createElement("span");
    remainingText.textContent = remaining + " GB remaining";
    remainingBar.appendChild(remainingText);

    container.appendChild(remainingBar);
</script>





        </div>
        <div class="t_c_r_e">
          <span class="be_l_t t_x_e_w"><?php echo $lang['total_traffic']; ?></span>
          <span class="be_l_t"><?php echo $client_info['traffic_used']; ?> <?php echo $lang['gb']; ?></span>
        </div>
      </div>
    </div>
    <div class="new-container">
      <div><p class="text_rtl new-container-text">برنامه های کاربردی</p></div>
      <div class="box_hi_container">
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/android.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">V2RayNg (Android)</span>
          <div dir="ltr">
            <span><a href="https://github.com/2dust/v2rayNG/releases/download/1.8.12/v2rayNG_1.8.12.apk"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/ios.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">V2Box (IOS)</span>
          <div dir="ltr">
            <span><a href="https://apps.apple.com/us/app/v2box-v2ray-client/id6446814690"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/windows.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">V2RayN (Windows)</span>
          <div dir="ltr">
            <span><a href="https://github.com/2dust/v2rayN/releases"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/mac.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">NekoRay (MacOS)</span>
          <div dir="ltr">
            <span><a href="https://github.com/MatsuriDayo/nekoray/releases/tag/2.11"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/android.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">Napsternetv (Android)</span>
          <div dir="ltr">
            <span><a href="https://play.google.com/store/apps/details?id=com.napsternetlabs.napsternetv"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/ios.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">FoXray (IOS)</span>
          <div dir="ltr">
            <span><a href="https://apps.apple.com/us/app/foxray/id6448898396"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>

        <div class="rectangle">
          <span><img class="f_img" src="assets/images/windows.svg" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">Netmod (Wndroid)</span>
          <div dir="ltr">
            <span><a href="https://sourceforge.net/projects/netmodhttp/"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
        <div class="rectangle">
          <span><img class="f_img" src="assets/images/linux.png" alt="دانلود" /></span>
          <span class="asdfl f_t_tt_i">NekoRay (linux)</span>
          <div dir="ltr">
            <span><a href="https://github.com/MatsuriDayo/nekoray/releases"><img class="f_m_img" src="assets/images/down.svg" alt="" /></a></span>
          </div>
        </div>
      </div>
    </div>
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