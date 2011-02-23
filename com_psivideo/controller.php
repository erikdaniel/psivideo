<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport( 'joomla.application.component.controller' ); 

class PsivideoController extends JController {

	function display() { 
    // add needed scripts and css
    JHTML::stylesheet('psivideo.css','components/com_psivideo/css/' );
    //JHTML::script( 'script.js'[, 'path'] );

		$document =& JFactory::getDocument(); 
		$viewName = JRequest::getVar('view', 'all'); 
		$viewType = $document->getType(); 
		$view =& $this->getView($viewName, $viewType); 
		//$view =& $this->getView($viewName, $viewType, 'View'); 
		$model =& $this->getModel( $viewName, 'ModelPsivideo' ); 

    if (!JError::isError( $model )) { 
			$view->setModel( $model, true ); 
		}	

    $view->setLayout('default'); 
		$view->display(); 
	}

  // TODO add voting function
	function save() { 
		global $option; 
    $model =& $this->getModel('form', 'ModelPsivideo');
    $model->save();
	}

  function vote() {
    $video_id = JRequest::getVar('video_id', '999', 'post');
    $model =& $this->getModel('single', 'ModelPsivideo');
    $model->vote($video_id);
  }

} 
?>
