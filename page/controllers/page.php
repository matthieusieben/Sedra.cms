<?php

require_once 'includes/file.php';
require_once 'includes/menu.php';
require_once 'includes/theme.php';

$page_id = @$arg[1];

# Get the item
$query = db_select('pages', 'p')->condition('id', $page_id);
$query->fields('p');
$page = $query->execute()->fetchAssoc();

# Item not found
if(empty($page))
	show_404();

switch (@$arg[0]) {
case 'raw':
	# Show the raw page content
	return theme('page/page', array(
		'page' => $page,
	));

case 'page':
	# Add breadcrumb
	breadcrumb_add(array(
		'path' => 'page/'.$page['id'],
		'title' => $page['title'],
	));

	# Show the item
	return theme('index', array(
		'view' => 'page/page',
		'page' => $page,
	));

default:
	throw new FrameworkException(t('Undefined request <code>@request</code>', array('@request' => @$arg[0])), 500);
}
