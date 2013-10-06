<?php

require_once 'includes/theme.php';

return theme('index', array(
	'html' => load_controller('blog/index', array('raw')),
));
