#worktime2
一款轻量级研发项目管理工具，主要针对中小互联网敏捷开发团队，页面清爽简单，功能精简好用。

##使用框架 laravel 5.1
相关文档可以参考<br>
http://laravel-china.org/docs/5.1<br>
http://www.golaravel.com/laravel/docs/5.1/<br>

##php 的要求
自行安装吧<br>
PHP >= 5.5.9 - OpenSSL PHP 扩展 - PDO PHP 扩展 - Mbstring PHP 扩展 - Tokenizer PHP 扩展<br>

##nginx 配置
在 Nginx 中，将下面的指令放到站点配置文件中就可以实现美化链接的功能
```Java
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

##基本配置
.env 文件可以修改数据库配置<br>
mysql 里面要先创建一个数据库<br>
执行命令创建数据库表 php artisan migrate<br>
chmod 777 -R storage<br>
开发环境下，也可以使用php自带的webserver 命令：php artisan serve --port=8080<br>

##开始使用
php artisan serve --port=8080<br>
http://localhost:8080

##联系我
email: aoktian@foxmail.com

