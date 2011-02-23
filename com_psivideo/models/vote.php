<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ModelPsivideoVote extends JModel
{
	var $_video = null;
	var $_votes = null;
	var $_id = null;
  var $_ip = null;
	
	function __construct()
	{
		global $mainframe;
				
		parent::__construct();
		
		if(!$id) {
			$id = JRequest::getVar('id', '');
		}

		$this->_id = $id;

    $this->getVideo();

    $this->_ip = $this->getIP();
	}
	
	function getVideo()
	{
		if(!$this->_video) {
			$query = "SELECT id, published FROM #__psivideos WHERE id = '" . $this->_id . "'";
			$this->_db->setQuery($query);
			$this->_video = $this->_db->loadObject();
			
			if(!$this->_video->published) {
				JError::raiseError( 404, "Invalid ID provided" );
			}
		}
		
		return $this->_video;
	}
	
	function getVotes()
	{
		if(!$this->_votes)
		{
			$query = "SELECT id FROM #__psivideos_votes WHERE id = '" . $this->_id . "'
                AND ip = '" . $this->_ip . "'";
      $this->_db->setQuery($query);
      $this->_votes = $this->_db->getNumRows();
		}
		
		return $this->_votes;
	}

  function getIP() { 
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
 
    return trim($ip);
  }


  function save() {
		
		$row =& JTable::getInstance('vote', 'Table');

		if (!$row->bind(JRequest::get('post'))) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
    //var_dump($row);
		
		$row->id = (int) $row->id;
    $row->psivideo_id = $this->_video->id;

		$currDate =& JFactory::getDate();
		$row->vote_date = $currDate->toMySQL();

    $row->bio = JRequest::getVar( 'bio', '', 'post', 'string');

		$user =& JFactory::getUser();
		if($user->id) { 
			$row->user_id = $user->id; 
		} else {
			$row->user_id = 0;
		}
   
    $row->ip_address = $this->_ip;
    if($this->getVotes() > 0) {
      echo "<script> alert('You may only vote once per hour, write a poem, come back and vote again!');</script>\n";
      exit();
    }

		if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
    //TODO email admin and submitter
    //echo "<br />$row->bio";

    $msg = 'Your vote for ' . $this->_video->poet_stage_name . '\'s poem has been recorded!'; 
    $link = 'index.php?option=com_psivideo&view=all'; 
		//$this->setRedirect(JRoute::_($link, false), $msg);
    $app =& JFactory::getApplication();
    $app->redirect($link, $msg);

  }

}
?>
