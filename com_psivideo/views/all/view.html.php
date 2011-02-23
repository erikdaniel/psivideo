<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport('joomla.application.component.view'); 

class PsivideoViewAll extends JView
{

	function display($tpl = null)
	{
		global $option;

    $document = &JFactory::getDocument();
    $document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js' );
    $document->addScript('templates/psi_2.0/js/jquery.colorbox-min.js');
    $document->addStyleSheet('templates/psi_2.0/css/colorbox.css' );
    $document->addStyleSheet('components/com_psivideo/css/psivideo.css' );
    $document->addScript('components/com_psivideo/scripts/psivideo.js' );

		$model =& $this->getModel();
		$list = $model->getList();
    $votes = $model->getVotes();
    

		for($i = 0; $i < count($list); $i++) { 
			$row =& $list[$i]; 
			$row->link = JRoute::_( JURI::base() . 'index.php?option=' . $option . '&id=' . $row->id  . '&view=single&modal=true'); 
		}

		$this->assignRef('list', $list); 
		$this->assignRef('votes', $votes); 
		parent::display($tpl);	
	}

} 

?>
