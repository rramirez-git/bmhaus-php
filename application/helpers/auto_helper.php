<?php
function data_backtrace( $lines_ignored = 1 ) {
	$bt = debug_backtrace();
	$res = array();
	foreach( $bt as $k => $data ) {
		if( $k >= $lines_ignored ) {
			array_push( $res, array( 
				'file'		=> isset( $data[ 'file' ] ) 	? $data[ 'file' ] 		: null,
				'line'		=> isset( $data[ 'line' ] ) 	? $data[ 'line' ] 		: null,
				'function'	=> isset( $data[ 'function' ] ) ? $data[ 'function' ] 	: null,
				'class'		=> isset( $data[ 'class' ] ) 	? $data[ 'class' ] 		: null,
				'type'		=> isset( $data[ 'type' ] ) 	? $data[ 'type' ] 		: null,
				'args'		=> isset( $data[ 'args' ] ) 	? $data[ 'args' ] 		: null,
			) );
		}
	}
	return $res;
}
function pretty_backtrace_line( $data ) {
	$res = "";
	$res .= ( isset( $data[ 'class' ] ) 	? $data[ 'class' ] . ' ' 			: '' );
	$res .= ( isset( $data[ 'type' ] ) 		? $data[ 'type' ] . ' ' 			: '' );
	$res .= ( isset( $data[ 'function' ] ) 	? $data[ 'function' ] . '(' 		: '' );
	foreach( $data[ "args" ] as $arg ) {
		if( is_string( $arg ) ) {
			$res .= " " . $arg . ",";
		} else if( is_bool( $arg ) ) {
			$res .= " " . ( $arg ? "true" : "false" ) . ",";
		} else if( is_array( $arg ) && isset( $arg[ "_ci_view" ] ) ) {
			$res .= " " . $arg[ "_ci_view" ] . ",";
		} else if( is_array( $arg ) ) {
			$res .= " ARRAY,";
		} else {
			var_dump( $res, $arg );
		}
	}
	if( ',' == substr( $res, strlen( $res ) - 1 ) ) {
		$res = substr( $res, 0, strlen( $res ) - 1 ) . " ";
	}
	$res .= ( isset( $data[ 'function' ] ) 	? ') ' 								: '' );
	//$res .= ( isset( $data[ 'file' ] ) 		? 'on ' . $data[ 'file' ] . ' ' 	: '' );
	//$res .= ( isset( $data[ 'line' ] ) 		? 'line ' . $data[ 'line' ] . ' ' 	: '' );
	return trim( $res );
}
function pretty_backtrace() {
	$res = array();
	foreach( data_backtrace( 2 ) as $k => $data ) {
		array_push( $res, pretty_backtrace_line( $data ) );
	}
	return $res;
}
?>
