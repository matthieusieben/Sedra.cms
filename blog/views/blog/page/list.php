<?php if (!empty($articles)): ?>
	<?php foreach ((array) @$articles as $article): ?>
		<?php echo theme($article); ?>
	<?php endforeach ?>
<?php else: ?>
	<p><em><?php echo t('This section is empty.'); ?></em></p>
<?php endif ?>