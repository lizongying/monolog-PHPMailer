<?php
/**
 * Author: Michael
 * Date: 2016/3/18
 * Time: 11:28
 */

namespace Monolog\Handler;
use Monolog\Handler\AbstractProcessingHandler;
require dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'\phpmailer\phpmailer\PHPMailerAutoload.php';

class PHPMailerHandler extends AbstractProcessingHandler
{
    private $to;

    public function __construct($to = '', $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->to = $to;
    }

    protected function write(array $record)
    {
        $mail = new \PHPMailer;

//        $mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.exmail.qq.com;';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'user@example.com';                 // SMTP username
        $mail->Password = 'secret';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('from@example.com', 'Mailer');
//        $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress($this->to);               // Name is optional
        $mail->addReplyTo('from@example.com', 'Mailer');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $record['channel'].'-'.$record['level_name'].' '.$record['message'];
        $mail->Body    = $record['formatted'];
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
//        if(!$mail->send()) {
//            echo '邮件发送错误信息: ' . $mail->ErrorInfo;
//        } else {
//            echo '邮件已发送成功';
//        }
    }
}