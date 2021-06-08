<?php

class Controller
{
	public function view($view, $data = [])
	{
		require_once '../../app_sipat/views/' . $view . '.php';
	}

	public function model($model)
	{
		require_once '../../app_sipat/models/' . $model . '.php';
		return new $model;
	}

	public function helper($helper)
	{
		require_once '../../app_sipat/helper/' . $helper . '.php';
		return new $helper;
	}

	public function api($api)
	{
		require_once '../../app_sipat/api/' . $api . '.php';
		return new $api;
	}
}
