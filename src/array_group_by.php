<?php

	/**
	 * Groups/splits an array by the key given. Can supply additional parameters beyond the first key
	 * for additional groupins.
	 *
	 * @param array $arr The array to have grouping performed on.
	 * @param mixed $key The key to group/split by.
	 *
	 * @return array
	 */
	function array_group_by ( $arr, $key )
	{

		if ( !is_array ( $arr ) )
		{
			trigger_error ( "array_key_split(): The first argument should be an array", E_USER_ERROR );
		}  // End if

		if ( !is_string ( $key ) &&
			 !is_int ( $key ) &&
			 !is_float ( $key ) )
		{
			trigger_error ( "array_key_split(): The key should be a string or integer", E_USER_ERROR );
		}  // End if

		$newArr = array ();

		// Load the new array splitting by the target key
		foreach ( $arr as $value )
		{
			$arrKey = $value [ $key ];
			$newArr [ $arrKey ][] = $value;
		}  // End foreach

		// Recursively build a nested grouping if more parameters are supplied
		// Build for each previously grouped values, slicing off the new split parameters for each call
		if ( func_num_args () > 2 )
		{

			$args = func_get_args ();

			foreach ( $newArr as $key => $value )
			{
				$parms = array_merge ( array ( $value ), array_slice ( $args, 2, func_num_args () ) );
				$newArr [ $key ] = call_user_func_array ( "array_key_split", $parms );
			}  // End foreach

		}  // End if

		return $newArr;

	}  // End array_group_by

?>