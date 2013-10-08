<?php

require_once 'includes/menu.php';
require_once 'includes/pagination.php';
require_once 'includes/theme.php';
require_once 'models/blog.php';

$category = $args['category'];
$page = val($_GET['page'], 0);
$limit = val($_GET['limit'], 5);

list($articles, $count, $category_name) = blog_get_articles_by_category($category, $page, $limit);

if(empty($articles) && $page !== 0)
	return show_404();

if(isset($category) && !$category_name)
	return show_404();

breadcrumb_add(array(
	'path' => router_path('blog_index'),
	'title' => t('Blog'),
));
if($category_name)
breadcrumb_add(array(
	'path' => router_path('blog_category', array('cat' => $category)),
	'title' => $category_name,
));

return theme('blog/page/articles', array(
	'title' => t('Blog'),
	'articles' => $articles,
	'pagination' => pagination(
		$count,
		$page*$limit,
		'blog?page=!page',
		$limit,
		'full'
	),
));
