<?php
/**
 * Author: Michael
 * Date: 2016/3/16
 * Time: 17:34
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\PHPMailerHandler;
use Monolog\Formatter\LineFormatter;
require 'vendor/autoload.php';

class MyLog
{
	function one()
	{
		// the default date format is "Y-m-d H:i:s"
		$dateFormat = "Y n j, g:i a";
		// the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
		$output = "%datetime% > %level_name% > %message% %context% %extra%\n";
		// finally, create a formatter
		$formatter = new LineFormatter($output, $dateFormat);
		
		// Create some handlers
		$stream = new StreamHandler(__DIR__.'/log/'.date('Y-m-d H-i-s').'.log', Logger::DEBUG);
		$stream->setFormatter($formatter);
		$firephp = new FirePHPHandler();

		// Create the main logger of the app
		$logger = new Logger('my_logger');
		$logger->pushHandler($stream);
		$logger->pushHandler($firephp);
		
		// Create a logger for the security-related stuff with a different channel
		$securityLogger = new Logger('security');
		$securityLogger->pushHandler($stream);
		$securityLogger->pushHandler($firephp);

		// You can now use your logger
		$logger->addInfo('My logger is now ready');
		$logger->addDebug('Adding a new user', array('username' => 'Seldaek'));
	}

	function two()
	{
		// the default date format is "Y-m-d H:i:s"
		$dateFormat = "Y n j, g:i a";
		// the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
		$output = "%datetime% > %level_name% > %message% %context% %extra%\n";
		// finally, create a formatter
		$formatter = new LineFormatter($output, $dateFormat);

		// Create some handlers
		$to = 'to@example.com';
		$mail = new PHPMailerHandler($to, Logger::DEBUG);
		$mail->setFormatter($formatter);
		$logger = new Logger('my_logger');
		$logger->pushHandler($mail);
		$logger->addDebug('Adding a new user', array('username' => 'Seldaek'));
	}

};

$my_logger = new MyLog();
//$my_logger->one();
$my_logger->two();

