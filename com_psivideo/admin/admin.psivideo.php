<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

require_once( JApplicationHelper::getPath( 'admin_html' ) ); 

require_once( JPATH_COMPONENT.DS.'controller.php' ); 

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables'); 

$controller = new PSIVideoController( array('default_task' => 'showVideos') ); 
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect(); 

?>
