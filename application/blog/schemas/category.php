<?php return array(
	'display name' => 'Category',
	'fields' => array(
		'id' => array(
			'type' => 'serial',
			'unsigned' => TRUE,
			'not null' => TRUE,
			'hidden' => TRUE,
		),
		'name' => array(
			'type' => 'varchar',
			'length' => 255,
			'not null' => TRUE,
			'default' => '',
			'display name' => t('Category name'),
			'show name' => FALSE,
			//'view' => 'title',
		),
		'language' => array(
			'type' => 'varchar',
			'length' => 10,
			'not null' => FALSE,
			'options' => language_list($language),
			'display name' => t('Language'),
		),
	),
	'primary key' => array('id'),
	'roles' => array(
		'view' => -1,
		'list' => MODERATOR_RID,
		'add' => MODERATOR_RID,
		'edit' => MODERATOR_RID,
		'remove' => MODERATOR_RID,
	),
	'order' => array(
		'name' => 'ASC',
	),
	'menu' => array(
		'title' => '!name',
		'path' => 'blog/category/!id',
		'language' => '!language',
		'role' => -1,
		'parent' => 'blog',
	),
);