<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ModelPsivideoForm extends JModel
{

  const _email_subject = "Video Submission on www.poetryslam.com";
  const _admin_email_message = "A video was submitted on www.poetryslam.com. Please visit http://www.poetryslam.com/administrator/index.php?option=com_psivideo to review and publish it.";
  const _email_message = "Thank you for submitting your video to the Brenda Moosy Video Slam! As soon as possible, a real human will review the video and publish it on the site.";

  function sendAdminMail() {
    $mailer =& JFactory::getMailer();
    $config =& JFactory::getConfig();

    $sender = array( 
        $config->getValue( 'config.mailfrom' ),
        $config->getValue( 'config.fromname' ) );
    $mailer->setSender($sender);
     
    $mailer->addRecipient($sender[0]); 
    $body   = self::_admin_email_message;
    $mailer->setSubject(self::_email_subject);
    $mailer->setBody($body);
    $send =& $mailer->Send();
    if ( $send !== true ) {
      return '<br />Error sending email: ' . $send->message;
    } else {
      return "<br />A message has been sent to the administrator.";
    }
  }

  function sendPoetMail($recipient) {
    $mailer =& JFactory::getMailer();
    $config =& JFactory::getConfig();
    $sender = array( 
        $config->getValue( 'config.mailfrom' ),
        $config->getValue( 'config.fromname' ) );
    $mailer->setSender($sender);
     
    $mailer->addRecipient($recipient); 
    $body   = self::_email_message;
    $mailer->setSubject(self::_email_subject);
    $mailer->setBody($body);
    $send =& $mailer->Send();
    if ( $send !== true ) {
      return '<br />Error sending email: ' . $send->message;
    } else {
      return "<br />A confirmation message has been sent to your email address.";
    }
  }


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
    $row->bio = JRequest::getVar( 'bio', '', 'post', 'string');

		if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
    $msg = 'Your video has been saved! An admin will review your video and publish it as soon as possible.'; 
    //TODO email admin and submitter
    // send mail to poet and admin
    $msg .= $this->sendAdminMail();
    $msg .= $this->sendPoetMail($row->poet_email);


  }
    $link = 'index.php?option=com_psivideo&view=all'; 
    $app =& JFactory::getApplication();
    $app->redirect($link, $msg);

  }
}

?>
