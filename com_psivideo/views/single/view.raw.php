<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PsivideoViewSingle extends JView {

	function display($tpl = null) {
		global $option, $mainframe;
		
		$model = &$this->getModel();
		$user =& JFactory::getUser();

		$video = $model->getVideo();
		$votes = $model->getVotes();
		$pathway =& $mainframe->getPathWay();
		
		$backlink = JRoute::_('index.php?option=' . $option . '&view=all' );
		
		$params = &$mainframe->getParams();
		
		$video->added_date = JHTML::Date($video->added_date);

    $video->link = $this->createEmbedCode($video->link);
				
		$pathway->addItem($review->name, '');
		
		$this->assignRef('video', $video);
		$this->assignRef('votes', $votes);
		$this->assignRef('backlink', $backlink);
		$this->assignRef('option', $option);
		$this->assignRef('name', $user->name);
    // TODO setup param for opening voting
    // by a date or somethign
    $this->voting_open = true;//('voting_open', true);   

		parent::display($tpl);
	}

  function createEmbedCode($link) {
    // TODO allow for other video types
    $embed = '';
    if(preg_match("/youtube\.com/i", $link)) {
      // parse youtube
      $arr = explode('/', $link);
      $code = $arr[count($arr) - 1];
      $code = str_replace('watch?v=', '', $code);
      $embed = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="480" height="390" src="http://youtube.com/embed/' . $code . '?rel=0" frameborder="0" allowFullScreen></iframe>';
    } // parse vimeo
    else if(preg_match("/vimeo.com/i", $link)) {
      $arr = explode('/', $link);
      $code = $arr[count($arr) - 1];
      $embed = '<iframe src="http://player.vimeo.com/video/' . $code . '" width="480" height="390" frameborder="0"></iframe>';
    }
    else {
      $embed = '<p class="error">Invalid Video ID</p>';
    }

    return $embed;
  }
}

?>
