<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
abstract class App
{
	public static function render()
	{
		echo "var app = angular.module('".$array_ini['app']."',[]);";
	}
}