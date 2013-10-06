<?php

require_once 'libraries/FeedWriter/FeedTypes.php';

switch (@$arg[2]) {
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

$BlogFeed->setTitle(t('@site blog', array('@site' => config('site.name'))));
$BlogFeed->setLink(url('blog'));
$BlogFeed->setDescription(t('This is the RSS feed of @site blog.', array('@site' => config('site.name'))));

$query = db_select('articles', 'a')->orderBy('published', 'DESC');
$query->fields('a');
$query->leftJoin('users', 'u', 'u.uid = a.uid');
$query->addField('u', 'name', 'author');
$query->range(0, 10);

$result = $query->execute();
while($article = $result->fetchAssoc()) {
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
