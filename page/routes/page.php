<?php

$routes['page'] = array(
	'url' => 'page/(?<id>\d+)',
	'methods' => array('GET'),
	'controller' => 'page',
	'args' => array('$id'),
);
