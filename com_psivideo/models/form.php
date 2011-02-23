<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ModelPsivideoForm extends JModel
{
	var $_videos = null;

  function save() {
	$msg = '';

    if ($_POST['check']!=JUtility::getToken()) {
       // First verify (by a Javascript error or other methods) that the form has not been submitted without the validation
	$jAp=& JFactory::getApplication();
       if ($_POST['check']=='post') {
		 $jAp->enqueueMessage('Please check all the fields of the form, <br/> If your browser blocks Javascript, then this form will never be successful. This is a security measure.','error');
	}
       // If the check still isn't a valid token, do nothing. This might be a spoof attack or other invalid form submission
    }
else {

		$row =& JTable::getInstance('psivideo', 'Table');
	

		if (!$row->bind(JRequest::get('post'))) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}

		$row->id = (int) $row->id;

	  //TODO require users?
		$currDate =& JFactory::getDate();
		$row->added_date = $currDate->toMySQL();

    $row->bio = JRequest::getVar( 'bio', '', 'post', 'string');

		if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
    $msg = 'Your video has been saved! An admin will review your video and publish it as soon as possible.'; 
}
    //TODO email admin and submitter

    $link = 'index.php?option=com_psivideo&view=all'; 
    $app =& JFactory::getApplication();
    $app->redirect($link, $msg);

  }
}

?>
