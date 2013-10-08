<article role="article" class="article">
	<header>
		<?php $_published = strtotime($published) ?>
		<time pubdate datetime="<?=date('c', $_published) ?>" title="<?=strftime('%x', $_published) ?>">
			<span class="month"><?=strftime('%h', $_published) ?></span>
			<span class="day"><?=strftime('%e', $_published) ?></span>
		</time>
		<h3><?=l(array('path' => $path, 'title' => $title)) ?></h3>
		<address class="author">
			<?=t('by @author', array('@author' => $author)) ?>
		</address>
	</header>
</article>