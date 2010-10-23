<?php

// elgg_invalidate_simplecache was added in 1.7.4
if (!function_exists('elgg_invalidate_simplecache'))  {
	function elgg_invalidate_simplecache() {
		global $CONFIG;

		$return = TRUE;

		if ($handle = opendir($CONFIG->dataroot . 'views_simplecache')) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					$return = $return && unlink($CONFIG->dataroot.'views_simplecache/'.$file);
				}
			}
			closedir($handle);
		} else {
			$return = FALSE;
		}

		return $return;
	}
}

elgg_invalidate_simplecache();
elgg_filepath_cache_reset();

system_message(elgg_echo('flush_cache:flushed'));
forward(REFERER);