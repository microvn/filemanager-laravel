# FileManager Code Base

This code base for Filemanager base on Laravel + Elfinder with Authenticate

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects.

## About ElFinder Package

This is package <a href="https://github.com/Studio-42/elFinder">ElFinder</a> use on Code base.

## Install 

<b>1. Edit middleware handle authenticate</b>

Open file uploadFile.php on App/Http/Middleware and Edit 

$userId = "CALLFUNCTION_HANDLE_USER_HERE"; // Any Function return userId; can set = 1 if a user;

$namespace = 'PATH_NAME_OF_PROJECT';

Uncomment Override Config if use;

<b>2. Edit config</b>

Open file config/elfinder.php and edit info in key <b>roots</b>


## Security Vulnerabilities

If you discover a security vulnerability within Project, please send an e-mail to microvn.gm@gmail.com
