<?php if (!empty($articles)): ?>
	<?php foreach ((array) @$articles as $article): ?>
		<article>
			<header>
				<?php $published = strtotime($article['published']) ?>
				<time pubdate datetime="<?php echo date('c', $published) ?>" title="<?php echo strftime('%x', $published) ?>">
					<span class="month"><?php echo strftime('%h', $published) ?></span>
					<span class="day"><?php echo strftime('%e', $published) ?></span>
				</time>
				<h3><?php echo l($article) ?></h3>
				<address class="author">
					<?php echo t('by @author', array('@author' => $article['author'])) ?>
				</address>
			</header>
		</article>
	<?php endforeach ?>
<?php else: ?>
	<p><em><?php echo t('This section is empty.'); ?></em></p>
<?php endif ?>