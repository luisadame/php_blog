<?php
	
	use App\Config\Config as Config;

	new Config;

	require Config::get('routes_path');
