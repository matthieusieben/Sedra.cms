<?php

$routes['blog_category'] = array(
	'url' => 'blog/category/:cat',
	'controller' => 'blog/articles',
	'methods' => array('GET'),
	'args' => array(':cat'),
);

$routes['blog_category_rss'] = array(
	'url' => 'blog/category/:cat.rss',
	'controller' => 'blog/rss',
	'methods' => array('GET'),
	'args' => array(':cat'),
);

$routes['blog_index'] = array(
	'url' => 'blog',
	'controller' => 'blog/articles',
	'methods' => array('GET'),
);

$routes['blog_index_rss'] = array(
	'url' => 'blog.rss',
	'controller' => 'blog/rss',
	'methods' => array('GET'),
);
