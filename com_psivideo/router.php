<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

function PSIVideoBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['view'])) {
		$segments[] = $query['view'];
		unset($query['view']);
	}

	if(isset($query['id']))
	{
		$segments[] = $query['id'];
		unset($query['id']);
	}

	return $segments;
}

function PSIVideoParseRoute($segments) 
{ 
	$vars = array();
	
	$vars['view'] = $segments[0];
	
	if (count($segments) > 1) {
		$vars['id'] = $segments[1];
	}
	
	return $vars;
}

?>
