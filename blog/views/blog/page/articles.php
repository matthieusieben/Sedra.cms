<?php require 'views/head.php' ?>
<?php require 'views/body.php' ?>
<?php require 'views/header.php' ?>

<div id="blog" class="articles">
	<?php echo theme('blog/page/list', $__data); ?>

	<?php echo theme($pagination); ?>
</div>

<?php require 'views/footer.php' ?>
<?php require 'views/foot.php' ?>