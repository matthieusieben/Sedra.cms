<?php

$routes['blog_index'] = array(
	'url' => 'blog',
	'controller' => 'blog/articles',
	'methods' => array('GET'),
);

$routes['blog_category'] = array(
	'url' => 'blog/category/:id',
	'controller' => 'blog/articles',
	'args' => array('category' => ':id'),
	'methods' => array('GET'),
);

$routes['blog_article'] = array(
	'url' => 'blog/article/:id',
	'controller' => 'blog/article',
	'args' => array('id' => ':id'),
	'methods' => array('GET'),
);

$routes['blog_index_rss'] = array(
	'url' => 'blog.rss',
	'controller' => 'blog/rss',
	'methods' => array('GET'),
);

$routes['blog_category_rss'] = array(
	'url' => 'blog/category/:id.rss',
	'controller' => 'blog/rss',
	'methods' => array('GET'),
	'args' => array('category' => ':id'),
);
