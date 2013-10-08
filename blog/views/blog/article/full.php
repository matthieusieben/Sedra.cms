<article role="article" class="article">
	<header>
		<?php $_published = strtotime($published); ?>
		<time pubdate datetime="<?=date('c', $_published) ?>" title="<?=strftime('%x', $_published) ?>">
			<span class="month"><?=strftime('%h', $_published) ?></span>
			<span class="day"><?=strftime('%e', $_published) ?></span>
		</time>
		<?php if ($title): ?>
			<h1><?=check_plain($title) ?></h1>
		<?php endif ?>
		<address class="author">
			<?=t('by @author', array('@author' => $author)) ?>
		</address>
	</header>

	<div class="content">
		<?=$body ?>
	</div>
</article>