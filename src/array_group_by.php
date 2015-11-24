<?php

/**
 * Groups an array by a given key. Any additional keys will be used for grouping
 * the next set of sub-arrays.
 *
 * @author Jake Zatecky
 *
 * @param array $arr The array to have grouping performed on.
 * @param mixed $key The key to group or split by.
 *
 * @return array
 */
function array_group_by($arr, $key)
{
	if (!is_array($arr)) {
		trigger_error('array_group_by(): The first argument should be an array', E_USER_ERROR);
	}
	if (!is_string($key) && !is_int($key) && !is_float($key)) {
		trigger_error('array_group_by(): The key should be a string or an integer', E_USER_ERROR);
	}

	// Load the new array, splitting by the target key
	$grouped = [];
	foreach ($arr as $value) {
		$grouped[$value[$key]][] = $value;
	}

	// Recursively build a nested grouping if more parameters are supplied
	// Each grouped array value is grouped according to the next sequential key
	if (func_num_args() > 2) {
		$args = func_get_args();

		foreach ($grouped as $key => $value) {
			$parms = array_merge([$value], array_slice($args, 2, func_num_args()));
			$grouped[$key] = call_user_func_array('array_group_by', $parms);
		}
	}

	return $grouped;
}
