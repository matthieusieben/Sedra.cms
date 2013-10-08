<?php

require_once 'models/blog.php';
require_once 'libraries/FeedWriter/FeedTypes.php';

switch (@$_GET['output']) {
case '':
case 'atom':
	$BlogFeed = new ATOMFeedWriter;
	break;

case 'rss':
case 'rss1':
	$BlogFeed = new RSS1FeedWriter;
	break;

case 'rss2':
	$BlogFeed = new RSS2FeedWriter;
	break;

default:
	return show_404();
}

$category = $args['category'];

list($articles, $count, $category_name) = blog_get_articles_by_category($category, 0, 10);

if(isset($category) && !$category_name)
	return show_404();

$BlogFeed->setTitle(t('@site\'s blog', array('@site' => config('site.name'))));
$BlogFeed->setLink(router_url('blog_index'));
if($category) {
	$BlogFeed->setDescription(t('RSS feed of @site\'s "@category" blog.', array('@site' => config('site.name'), '@category' => $category_name)));
} else {
	$BlogFeed->setDescription(t('RSS feed of @site\'s blog.', array('@site' => config('site.name'))));
}

foreach ($articles as $article) {
	$newItem = $BlogFeed->createNewItem();
	$newItem->setTitle($article['title']);
	$newItem->setAuthor($article['author']);
	$newItem->setLink(url('blog/article/'.$article['id']));
	$newItem->setDate($article['published']);
	$newItem->setDescription($article['body']);

	$BlogFeed->addItem($newItem);
}

ob_start();
$BlogFeed->generateFeed();
return ob_get_clean();
