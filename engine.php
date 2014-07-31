<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/

// Get the request path
$requesturi = explode('?' , $_SERVER['REQUEST_URI']);
$requesturi = $requesturi[0];
$path       = explode('/' , $requesturi);

// ---it---inizio base url
// Set the base_url automatically if none was provided
$base_url = '';
if ($base_url == '')
{
	if (isset($_SERVER['HTTP_HOST']))
	{
		$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$base_url .= '://'. $_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	}

	else
	{
		$base_url = 'http://localhost/';
	}
}
// ---it---fine

// ---it---inizio sistema path considerando directory di base
$base_dir = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/');
if ($base_dir)
{
	$path = array_slice($path, 1);
}
// ---it---fine