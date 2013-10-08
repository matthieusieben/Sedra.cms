<?php

require_once 'includes/menu.php';
require_once 'includes/theme.php';
require_once 'models/blog.php';

# Get the item
$article = blog_get_article_by_id($args['id']);

# Item not found
if(!$article) show_404();

# Add breadcrumb
breadcrumb_add(array(
	'path' => 'blog',
	'title' => t('Blog'),
));
if($article['category']) {
	breadcrumb_add(array(
		'path' => 'blog/category/'.$article['category_id'],
		'title' => $article['category_name'],
	));
}
breadcrumb_add(array(
	'path' => 'blog/article/'.$article['id'],
	'title' => $article['title'],
));

# Show the item
return theme('blog/page/article', $article);
