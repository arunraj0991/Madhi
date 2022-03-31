<?php

class MYLOG
{
	

	
	// Create the logger
	public static function logFunction($dynamic = null) //$msg,$data,$log_type
	{
		$channel = $dynamic ? $dynamic : 'man_logger';
		$log_folder = $dynamic ? 'request_logs' : 'syslogs';
		include_once APPPATH.'/vendor/autoload.php';
		$logger = new  \Monolog\Logger($channel);
		$streamHandler = new \Monolog\Handler\StreamHandler(APPPATH.$log_folder.'/ssa_app_'.date('Y-m-d').'.html', $logger::DEBUG);
		$streamHandler->setFormatter(new \Monolog\Formatter\HtmlFormatter());
		$browserHanlder = new \Monolog\Handler\BrowserConsoleHandler($logger);
		$logger->pushProcessor(new \Monolog\Processor\WebProcessor());
		
		if(!$dynamic)
		{
			$logger->pushProcessor(new \Monolog\Processor\IntrospectionProcessor());
			$logger->pushProcessor(new \Monolog\Processor\ProcessIdProcessor());
			$logger->pushProcessor(new \Monolog\Processor\UidProcessor());
			//$logger->pushProcessor(new \Monolog\Processor\HostnameProcessor());
			$logger->pushProcessor(new \Monolog\Processor\MemoryUsageProcessor());
			$logger->pushProcessor(new \Monolog\Processor\MemoryPeakUsageProcessor());
		}
		$logger->pushHandler($streamHandler);
		
		return $logger;
		//$CI =&get_instance();
		
	if(true)
	{		
		switch($log_type)
		{
			case 'INFO':
						$logger->info($msg, $data);
						break;
			case 'WARN':
						$logger->warning($msg, $data);
						break;
			case 'ERROR':
						$logger->error($msg, $data);
						break;
			default:	
					$logger->info($msg, $data);
		}
	}
	}
	

}

?>