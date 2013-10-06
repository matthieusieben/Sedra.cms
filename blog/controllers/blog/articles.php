<?php

require_once 'includes/file.php';
require_once 'includes/menu.php';
require_once 'includes/pagination.php';
require_once 'includes/theme.php';

$category = @$arg[0];
$page = val($_GET['page'], 0);
$limit = val($_GET['limit'], 5);

$articles = array();
$query = db_select('articles', 'a')->orderBy('published', 'DESC');
$query->leftJoin('users', 'u', 'u.uid = a.uid');
$query->leftJoin('category', 'c', 'c.id = a.category');
$query->fields('a');
$query->addField('u', 'name', 'author');
$query->addField('u', 'mail');
$query->addField('c', 'id', 'category_id');
$query->addField('c', 'name', 'category_name');
$query->range($page*$limit, $limit);
if($category) $query->condition('a.category', $category);

$result = $query->execute();
while($article = $result->fetchAssoc()) {
	$article['path'] = router_create_path('blog_article', array('id' => $article['id']));
	$article['file_info'] = file_info(array('fid' => $article['picture']));
	$articles[] = $article;
}

switch (@$arg[1]) {
case 'raw':
	return theme('blog/articles', array(
		'articles' => $articles,
	));

default:
	if(empty($articles) && $page !== 0)
		show_404();

	$count = count($articles);
	if($count >= $limit || $page !== 0) {
		$cq = db_select('articles');
		if($category) $cq->condition('a.category', $category);
		$count = $cq->countQuery()->execute()->fetchField();
	}

	breadcrumb_add(array(
		'path' => router_create_path('blog_index'),
		'title' => t('Blog'),
	));
	if($category)
	breadcrumb_add(array(
		'path' => router_create_path('blog_category', array('cat' => $category)),
		'title' => $articles[0]['category_name'],
	));

	return theme('blog/list', array(
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
}