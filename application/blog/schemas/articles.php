<?php

global $language;

return array(
	'display name' => 'Blog articles',
	'fields' => array(
		'id' => array(
			'type' => 'serial',
			'unsigned' => TRUE,
			'not null' => TRUE,
			'hidden' => TRUE,
		),
		'title' => array(
			'type' => 'varchar',
			'length' => 255,
			'not null' => TRUE,
			'default' => '',
			'display name' => t('Article title'),
			'show name' => FALSE,
			'view' => 'title',
		),
		'language' => array(
			'type' => 'varchar',
			'length' => 10,
			'not null' => FALSE,
			'options' => language_list($language),
			'display name' => t('Language'),
		),
		'category' => array(
			'type' => 'int',
			'unsigned' => TRUE,
			'not null' => FALSE,
			'display name' => t('Category'),
		),
		'uid' => array(
			'type' => 'int',
			'unsigned' => TRUE,
			'not null' => TRUE,
			'display name' => t('Author'),
			'show name' => FALSE,
			'view' => 'avatar',
		),
		'published' => array(
			'type' => 'datetime',
			'not null' => TRUE,
			'display name' => t('Publish date'),
			'show name' => FALSE,
			'view' => 'date',
		),
		'picture' => array(
			'type' => 'int',
			'unsigned' => TRUE,
			'not null' => FALSE,
			'display name' => t('Picture'),
			'show name' => FALSE,
			'view' => 'file',
		),
		'body' => array(
			'type' => 'text',
			'not null' => TRUE,
			'display name' => t('Body'),
			'show name' => FALSE,
			'view' => 'text',
		),
	),
	'primary key' => array('id'),
	'foreign keys' => array(
		'article_category' => array(
			'table' => 'category',
			'columns' => array('category' => 'id'),
			'cascade' => FALSE,
		),
		'article_author' => array(
			'table' => 'users',
			'columns' => array('uid' => 'uid'),
			'cascade' => TRUE,
		),
		'article_picture' => array(
			'table' => 'files',
			'columns' => array('picture' => 'fid'),
			'cascade' => FALSE,
		),
	),
	'roles' => array(
		'view' => -1,
		'list' => MODERATOR_RID,
		'add' => MODERATOR_RID,
		'edit' => MODERATOR_RID,
		'remove' => MODERATOR_RID,
	),
	'order' => array(
		'published' => 'DESC',
	),
);
