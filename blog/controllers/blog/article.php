<?php

require_once 'includes/file.php';
require_once 'includes/menu.php';
require_once 'includes/theme.php';

$article_id = @$arg[2];

# Get the item
$query = db_select('articles', 'a')->condition('a.id', $article_id);
$query->leftJoin('users', 'u', 'u.uid = a.uid');
$query->leftJoin('category', 'c', 'c.id = a.category');
$query->fields('a');
$query->addField('u', 'name', 'author');
$query->addField('u', 'mail');
$query->addField('c', 'id', 'category_id');
$query->addField('c', 'name', 'category_name');
$article = $query->execute()->fetchAssoc();

# Item not found
if(empty($article))
	show_404();

$article['file_info'] = file_info(array('fid' => $article['picture']));

# Add breadcrumb
breadcrumb_add(array(
	'path' => 'blog',
	'title' => t('Blog'),
));
breadcrumb_add(array(
	'path' => 'blog/category/'.$article['category_id'],
	'title' => $article['category_name'],
));
breadcrumb_add(array(
	'path' => 'blog/article/'.$article['id'],
	'title' => $article['title'],
));

# Show the item
return theme('blog/article', array('article' => $article));
