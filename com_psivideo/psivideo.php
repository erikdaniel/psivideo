<?php 
defined('_JEXEC') or die('Restricted access'); 

require_once( JPATH_COMPONENT.DS.'controller.php' );

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS. 'com_psivideo'.DS.'tables'); 

echo '<div class="componentheading">Brenda Moosy Video Slam</div>'; 

$controller = new PsivideoController(); 
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect(); 

?> 
