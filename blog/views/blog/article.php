<?php require 'views/head.php' ?>
<?php require 'views/body.php' ?>
<?php require 'views/header.php' ?>

<article role="article">
	<header>
		<?php $published = strtotime($article['published']) ?>
		<time pubdate datetime="<?php echo date('c', $published) ?>" title="<?php echo strftime('%x', $published) ?>">
			<span class="month"><?php echo strftime('%h', $published) ?></span>
			<span class="day"><?php echo strftime('%e', $published) ?></span>
		</time>
		<h1><?php echo check_plain($article['title']) ?></h1>
		<address class="author">
			<?php echo t('by @author', array('@author' => $article['author'])) ?>
		</address>
	</header>

	<div class="content">
		<?php echo $article['body'] ?>
	</div>

	<footer></footer>
</article>

<?php require 'views/footer.php' ?>
<?php require 'views/foot.php' ?>