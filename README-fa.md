<div align="center"><img src="https://raw.githubusercontent.com/MrAminiNezhad/Raccoon/main/demo/logo.png" width="350"></div>

# اسکریپت راکون چیست ؟

راکون یک اسکریپت تحت وب می باشد که قابلیت نصب بر روی انواع هاست php را دارد ، با استفاده از اسکریپت راکون میتوانید یک وبسایت آنلاین جهت نمایش مشخصات سرویس و باقی مانده آن بسازید تا کاربرانتون به راحتی با وارد کردن نام کانفینگ مشخصات سرویس خود را به صورت کامل و آنلاین مشاهده بکنند.

# امکانات راکون

1-قابلیت اتصال به پنل های <a href="https://github.com/alireza0/x-ui">علیرضا</a> , <a href="https://github.com/MHSanaei/3x-ui">ثنایی</a> , <a href="https://github.com/xpanel-cp/XPanel-SSH-User-Management">ایکس پنل</a> ( بدون محدودیت ورژن) <br>
2- نمایش میزان دانلود و اپلود <br>
3- نمایش مجموع مصرف <br>
4- نمایش تاریخ انقضا سرویس <br>
5- نمایش وضعیت فعال یا غیرفعال بودن سرویس <br>
6- نمایش روز های باقی مانده <br>
7- نمایش ترافیک باقی مانده <br>
8- پشتیبانی از چندین زبان <br>
9- قابلیت چت آنلاین بدون نیاز به فیلتر شکن ! <br>
10- قابلیت اضافه کردن چند پنل در یک اسکریپت

# آموزش نصب متنی

جهت نصب کافیست فایل های پروژه را دانلود و به هاست انتقال بدید سپس اطلاعات پنل خود را در فایل config.php قرار بدید <br>
type های پشتیبانی شده: sanaei, alireza,xpanel <br>
سپس برای فعال کردن چت آنلاین وارد سایت crisp.chat شوید و عضو شوید پس از گذراندن مراحل عضویت و ورود به صفحه اول روی چرخ دنده پایین صفحه بزنید و سپس گزینه اول account را انتخاب بکنید و بعد وارد بخش Website Settings شود در این بخش جلوی اسم سایتتان روی settings بزنید و گزینه Setup instructions بزنید و Website ID را کپی و در فایل config.php به جای Your ID وارد نمایید.

# افزایش امنیت
برای وب سرور های apache و litespeed (هاست های cpanel) فقط باید فایل .htaccess در دایرکتوری اصلی اسکریپت باشد.
توجه کنید open-litespeed(لایت‌اسپید رایگان) از .htaccess بطور پیش‌فرض پشتیبانی نمی‌کند.

## برای nginx

```nginx
location = ^/(.db.db|.cookie.txt)$ {
 # Deny access to the db.db file
 deny all;
 # Optionally, you can specify a fallback page or redirect
 # error_page 403 /path/to/fallback-page.html;
 # or
 # return 403;
}
```

## برای lighttpd

```lighttpd
$HTTP["url"] =~ "^/(.db.db|.cookie.txt)$" {
    url.access-deny = ( "" )
}
```

# آموزش تصویری

<div align="center">
جهت نصب بر روی سرور با کمک aapanel توسط تیم عزیز <a href="https://www.youtube.com/@sixtininelearn"> SIXTININE LERN </a> <br> <br> <br>

[![Raccoon web panel ](https://i.ibb.co/K9j8cnm/photo-2023-11-17-18-41-03.jpg)](https://www.youtube.com/watch?v=ci_APcSKmfY "Raccoon web panel - Click to Watch!")
<br><br>

</div>

# پیش نمایش

<div align="center"><img src="https://raw.githubusercontent.com/MrAminiNezhad/Raccoon/main/demo/Raccoon_demo (1).png" width="700"></div>
<div align="center"><img src="https://raw.githubusercontent.com/MrAminiNezhad/Raccoon/main/demo/Raccoon_demo (2).png" width="700"></div>

# با تشکر از

<a href="https://github.com/ILYAGVC"> ILYAGVC </a> <br>
<a href="https://github.com/thezass/"> Thezass </a> <br>
<a href="https://github.com/alirezax5"> alirezax5 </a>

# حمایت از پروژه

جهت حمایت از پروژه و ارائه بروز رسانی های بیشتر از پروژه حمایت بکنید <br>
Trx Wallet: TQhwK6q94GgpUZSsHBjiUWc6xAHz5Df9mW
<br>
