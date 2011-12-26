<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

define('PSIVIDEO_START_DATE', 20111225);// temporary

class ModelPsivideoAll extends JModel
{
	var $_videos = null;
  var $_votes = null;

	function getList()
	{
		if(!$this->_videos)
		{
			$query = "SELECT * FROM #__psivideos WHERE published = '1' AND added_date > " . PSIVIDEO_START_DATE ;
			//$query = "SELECT * FROM #__psivideos WHERE published = '1'";
			$this->_videos = $this->_getList($query, 0, 0);
		}
		return $this->_videos;
	}
  
  function getVotes() {
    $list = array();
    if(!$this->_videos) {
      $this->_videos =& $this->getList();
    }
    if(count($this->_videos) <= 0) {
	return 0;
	}

    if(!$this->_votes) {
      foreach($this->_videos as $v) {
      //foreach($i = 0; $i < count($this->_videos); $i++) {
        $this->_votes[$v->id] = 0;
      }

      $query = "SELECT * FROM #__psivideos_votes";
      $list = $this->_getList($query, 0, 0);
      foreach($list as $l) {
        $this->_votes[$l->psivideo_id] += 1;
      }
    }
    return $this->_votes;
  }

  function getVotesById($id) {
    return $this->_votes[$id];
  }
}

?>
