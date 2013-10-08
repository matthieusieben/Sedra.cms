<?php

require_once 'includes/file.php';

function blog_get_article_by_id($id) {
	$query = db_select('articles', 'a')->condition('a.id', $id);
	$query->leftJoin('users', 'u', 'u.uid = a.uid');
	$query->leftJoin('category', 'c', 'c.id = a.category');
	$query->fields('a');
	$query->addField('u', 'name', 'author');
	$query->addField('u', 'mail');
	$query->addField('c', 'id', 'category_id');
	$query->addField('c', 'name', 'category_name');
	$query->condition('published', date("Y-m-d H:i:s"), '<');
	$article = $query->execute()->fetchAssoc();
	if($article) {
		$article['file_info'] = file_info(array('fid' => $article['picture']));
		$article['view'] = 'blog/article/full';
	}
	return $article;
}

function blog_get_articles_by_category($category = NULL, $page = 0, $limit = 10) {
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
	$query->condition('published', date("Y-m-d H:i:s"), '<');
	if(isset($category)) $query->condition('a.category', $category);

	$result = $query->execute();
	while($article = $result->fetchAssoc()) {
		$article['view'] = 'blog/article/teaser';
		$article['path'] = router_path('blog_article', array('id' => $article['id']));
		$article['file_info'] = file_info(array('fid' => $article['picture']));
		$articles[] = $article;
	}

	$count = count($articles);
	if($count >= $limit || $page !== 0) {
		$cq = db_select('articles');
		$cq->condition('published', date("Y-m-d H:i:s"), '<');
		if(isset($category)) $cq->condition('a.category', $category);
		$count = $cq->countQuery()->execute()->fetchField();
	}

	if(isset($category))
		$category_name = @$articles[0]['category_name'] ?: blog_get_category_name($category);
	else
		$category_name = NULL;

	return array($articles, $count, $category_name);
}

function blog_get_category_name($id) {
	return db_select('category', 'c')->fields('c', array('name'))->condition('id', $id)->execute()->fetchField();
}