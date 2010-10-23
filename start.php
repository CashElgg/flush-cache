<?php

register_elgg_event_handler('init', 'system', 'flush_cache_init');

function flush_cache_init() {
	global $CONFIG;

	$action = "{$CONFIG->pluginspath}flush-cache/actions/flush.php";
	register_action('cache/flush', FALSE, $action, TRUE);

	register_elgg_event_handler('pagesetup', 'system', 'flush_cache_admin_menu');
}

function flush_cache_admin_menu() {
	global $CONFIG;
	
	if (get_context() == 'admin' && isadminloggedin()) {
		$url = "{$CONFIG->url}action/cache/flush";
		$url = elgg_add_action_tokens_to_url($url);
		add_submenu_item(elgg_echo('flush_cache:flush'), $url);
	}
}