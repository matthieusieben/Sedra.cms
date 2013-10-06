<?php require 'views/head.php' ?>
<?php require 'views/body.php' ?>
<?php require 'views/header.php' ?>

<?php echo theme('blog/articles', $__data); ?>

<?php echo theme($pagination); ?>

<?php require 'views/footer.php' ?>
<?php require 'views/foot.php' ?>