<?php

hook_register('site data', function(&$__data) {
	global $language;
	global $controller;
	switch ($controller) {
	case 'account':
	case 'scaffolding':
		break;

	default:
		if($language === 'en')
			$__data['aside'] = load_controller('page', array('raw', 4));
		else if($language === 'fr')
			$__data['aside'] = load_controller('page', array('raw', 5));
		break;
	}
});
