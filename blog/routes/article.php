<?php

$routes['blog_article'] = array(
	'url' => 'blog/article/(?<id>\d+)',
	'methods' => array('GET'),
	'controller' => 'blog/article',
	'args' => array('article', '$id'),
);
