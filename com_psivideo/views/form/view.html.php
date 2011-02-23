<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PsivideoViewForm extends JView {

	function display($tpl = null)
	{
		global $option, $mainframe;
		
		$model =& $this->getModel();
		$user =& JFactory::getUser();

		$pathway =& $mainframe->getPathWay();
		
		$backlink = JRoute::_('index.php?option=' . $option . '&view=all' );
		
		$params = &$mainframe->getParams();
		
		$video->added_date = JHTML::Date($video->added_date);
				
		$pathway->addItem('Add Video', '');
		
		$this->assignRef('video', $video);
		$this->assignRef('votes', $votes);
		$this->assignRef('backlink', $backlink);
		$this->assignRef('option', $option);
		$this->assignRef('name', $user->name);
		
		parent::display($tpl);
	}
}

?>
