<?php

global $language;

return array(
	'display name' => t('Pages'),
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
			'not null' => FALSE,
			'default' => '',
			'display name' => t('Page title'),
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
		'body' => array(
			'type' => 'text',
			'not null' => TRUE,
			'display name' => t('Body'),
			'show name' => FALSE,
			'view' => 'text',
		),
	),
	'primary key' => array('id'),
	'roles' => array(
		'view' => -1,
		'list' => MODERATOR_RID,
		'add' => ADMINISTRATOR_RID,
		'edit' => MODERATOR_RID,
		'remove' => ADMINISTRATOR_RID,
	),
	'menu' => array(
		'title' => '!title',
		'path' => 'page/!id',
		'language' => '!language',
		'role' => -1,
		'parent' => NULL,
	),
);
