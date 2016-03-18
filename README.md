# monolog-PHPMailer
monolog with PHPMailer

#说明
原来的邮件通知依赖php的邮件类，使用不是很方便。为此加入一个 PHPMailer，更加灵活。示例中使用SMTP发送邮件。

#使用
*更新<br>
<code>cd</code>进入monolog-PHPMailer目录
```
$composer update
```
*配置邮件
```
monolog-PHPMailer/vendor/monolog/monolog/src/Monolog/Handler/PHPMailerHandler.php
```
*访问
```
monolog-PHPMailer/example.php
```

##感谢
感谢monolog、PHPMailer。
