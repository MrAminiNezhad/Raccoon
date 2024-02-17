<div align="center"><img src="https://raw.githubusercontent.com/MrAminiNezhad/Raccoon/main/demo/logo.png" width="350"></div>
<div align="center">
برای توضیحات <a href="https://github.com/MrAminiNezhad/Raccoon/blob/main/README-fa.md"> فارسی اینجا بزنید </a>
</div>
<br><br>


# What is Raccoon Script?

Raccoon is a web-based script that can be installed on various PHP hosting platforms. Using the Raccoon script, you can create an online website to display the details of a service and its remaining balance. This allows your users to easily view their service details by entering their configuration name in a complete and online format.

# Features of Raccoon

1- Ability to connect to <a href="https://github.com/alireza0/x-ui">alireza</a> and <a href="https://github.com/MHSanaei/3x-ui">sanaei</a> and <a href="https://github.com/xpanel-cp/XPanel-SSH-User-Management">xpanel</a> panels (without version limitations) <br>
2- Display download and upload amounts <br>
3- Display total consumption <br>
4- Display the service expiration date <br>
5- Display the active or inactive status of the service <br>
6- Display the remaining days <br>
7- Display remaining traffic <br>
8- Support for multiple languages <br>
9- Online chat feature<br>
10- Support for using multi panels in one script <br>

# Installation Guide

To install, simply download the project files and transfer them to your hosting. Then, put your panel information in the config.php file. <br>
Supported types: sanaei, alireza,xpanel <br>
Then, to activate the online chat, enter the crisp.chat site and become a member. After going through the membership process and entering the first page, click on the bottom gear and then select the first account option and then enter the Website Settings section in this front section. Click the name of your site on settings and click Setup instructions and copy the Website ID and enter it in the config.php file instead of Your ID.

# security options
for apache and litespeed(not open-litespeed) just keep .htaccess file in directory of script
(.htaccess file doesn't work in open-litespeed by default)

## for nginx

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

## for lighttpd

```lighttpd
$HTTP["url"] =~ "^/(.db.db|.cookie.txt)$" {
    url.access-deny = ( "" )
}

```

# Video installation tutorial

<div align="center">
To install on the server with the help of aapanel by the dear team <a href="https://www.youtube.com/@sixtininelearn"> SIXTININE LERN </a> <br> <br> <br>

[![Raccoon web panel ](https://i.ibb.co/K9j8cnm/photo-2023-11-17-18-41-03.jpg)](https://www.youtube.com/watch?v=ci_APcSKmfY "Raccoon web panel - Click to Watch!")


</div>

# Preview

<div align="center"><img src="https://raw.githubusercontent.com/MrAminiNezhad/Raccoon/main/demo/Raccoon_demo (1).png" width="700"></div>
<div align="center"><img src="https://raw.githubusercontent.com/MrAminiNezhad/Raccoon/main/demo/Raccoon_demo (2).png" width="700"></div>

# Thanks To

<a href="https://github.com/ILYAGVC"> ILYAGVC </a> <br>
<a href="https://github.com/thezass/"> Thezass </a> <br>
<a href="https://github.com/alirezax5"> alirezax5 </a>

# Donation

Trx Wallet: TQhwK6q94GgpUZSsHBjiUWc6xAHz5Df9mW
