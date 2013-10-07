<?php

$routes['blog_article'] = array(
	'url' => 'blog/article/:id',
	'methods' => array('GET'),
	'controller' => 'blog/article',
	'args' => array(':id'),
);
