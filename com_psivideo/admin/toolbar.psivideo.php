<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch($task)
{
	case 'edit':
	case 'add':
		TOOLBAR_psivideo::_NEW();
		break;
	
	default:
		TOOLBAR_psivideo::_DEFAULT();
		break;
}

?>
