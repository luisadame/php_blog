<?php

	use App\Http\Router as Router;

	new Router;
	
	Router::set('/', 'MainController@index');
	Router::set('/new-post', 'MainController@newPost');
	Router::match('#/edit/(?<id>[0-9]+)#', ['id'], 'MainController@editPost');


	Router::set('/store-post', 'PostController@create');
	Router::match('#/post/(?<id>[0-9]+)#', ['id'], 'PostController@read');
	Router::match('#/delete/(?<id>[0-9]+)#', ['id'], 'PostController@delete');
	Router::set('/update-post', 'PostController@update');

	Router::request();