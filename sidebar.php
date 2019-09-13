<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package partoo
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!is_active_sidebar('sidebar-1')) {
	return;
} else {
	dynamic_sidebar('sidebar-1');
}
