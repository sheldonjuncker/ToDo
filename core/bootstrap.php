<?php  

use Core\App;
use Core\Database\QueryBuilder;
use Core\Database\Connection;

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
	Connection::make(App::get('config')['database'])
));

function date2utc($timestamp, $format = 'Y-m-d H:i:s', $zone = 'America/New_York') 
{
    $class = \Carbon\Carbon::class;
    $timestamp = $timestamp instanceof $class ? $timestamp->format($format) : $timestamp;
    $date = \Carbon\Carbon::createFromFormat($format, $timestamp, $zone);
    $date->setTimezone('UTC');
    return $date;
}

function view($name, $data) 
{
	return [
			'view_page' => "app/views/{$name}.view.php",
			'view_data' => $data
		];
}

function is_view($data) 
{
	return array_key_exists('view_page', $data);
}

function redirect($path) 
{
	header("Location: {$path}");
}

?>