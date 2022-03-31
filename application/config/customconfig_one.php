<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



if(ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')
{
	$config['jwt_key'] = 'uKLrzsqVNTamCRwIDAQAB';
	$config['authorization_key'] = 'emis_dev';
}
else if(ENVIRONMENT == 'production')
{
	$config['jwt_key'] = 'uKLrzsqVNTamCRwIDAQAB';
	$config['authorization_key'] = 'emis_dev';
}
?>