<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ModelPsivideoSingle extends JModel
{
	var $_video = null;
	var $_votes = null;
	var $_id = null;
  var $_ip = null;
	
	function __construct()
	{
		global $mainframe;
				
		parent::__construct();
		$params =& $mainframe->getParams();
		$id = $params->get('id', 0);
		
		if(!$id) {
			$id = JRequest::getVar('id', '');
		}
		$this->_id = $id;
    $this->_votes =& $this->getVotes();
	}
	
	function getVideo() {
		if(!$this->_video) {
			$query = "SELECT * FROM #__psivideos WHERE id = '" . $this->_id . "'";
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
			$query = "SELECT count(*) FROM #__psivideo_votes WHERE id = '" . $this->_id . "'";
			$this->_votes = count($this->_getList($query, 0, 0));			
		}
		
		return $this->_votes;
	}

	function getVotesByIp( $ip, $psivideo_id) {
    $votesByIp = 0;
    $query = "SELECT count(*) FROM #__psivideos_votes WHERE ip_address = '" . $ip . "' AND DATE_SUB(NOW(), INTERVAL 1 HOUR) <= vote_date";
    $this->_db->setQuery($query);
    $votesByIp = $this->_db->loadResult();
		return $votesByIp;
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


  function vote($video_id) {
		
		$row =& JTable::getInstance('vote', 'Table');

		if (!$row->bind(JRequest::get('post'))) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
    //var_dump($row);
		
		$row->id = (int) $row->id;
    $row->psivideo_id = $video_id;

    $row->vote_date = date('Y-m-d H:i:s'); 

		$user =& JFactory::getUser();
		if($user->id) { 
			$row->user_id = $user->id; 
		} else {
			$row->user_id = 0;
		}
   
    $row->ip_address = $this->getIP();

    $msg = '';
    
    if($this->getVotesByIp($row->ip_address, $video_id) > 0) {
      $msg =  "Our records show that you already voted recently. You may only vote once per hour. Go write a poem, then come back and vote again!'";
    }
    else if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
    //TODO email admin and submitter
    $link = 'index.php?option=com_psivideo&view=all'; 

    echo '<script type="text/javascript">window.onload = function() { parent.jQuery.colorbox.close();parent.handleVoteCounted("'.$msg.'", ' . $row->psivideo_id .');}</script>';
    exit();
  }
}
?>
