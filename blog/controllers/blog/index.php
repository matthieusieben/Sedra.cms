<?php

require_once 'includes/file.php';
require_once 'includes/menu.php';
require_once 'includes/pagination.php';
require_once 'includes/theme.php';

$category = @$arg[1];
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
if($category) $query->condition('c.id', $category);

$result = $query->execute();
while($article = $result->fetchAssoc()) {
	$article['path'] = 'blog/article/'.$article['id'];
	$article['file_info'] = file_info(array('fid' => $article['picture']));
	$articles[] = $article;
}

switch (@$arg[0]) {
case 'raw':
	return theme('blog/articles', array(
		'articles' => $articles,
	));

case 'blog':
	if(empty($articles) && $page !== 0)
		show_404();

	$count = count($articles);
	if($count >= $limit || $page !== 0) {
		$count = db_select('articles')->countQuery()->execute()->fetchField();
	}

	breadcrumb_add(array(
		'path' => 'blog/index',
		'title' => t('Blog'),
	));
	if($category)
	breadcrumb_add(array(
		'path' => 'blog/category/'.$category,
		'title' => $articles[0]['category_name'],
	));

	return theme('blog/index', array(
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

default:
	throw new FrameworkException(t('Undefined request <code>@request</code>', array('@request' => @$arg[0])), 500);
}
