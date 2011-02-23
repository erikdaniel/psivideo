<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class PsiVideoController extends JController 
{ 
	function __construct( $default = array() )
	{ 
		parent::__construct( $default ); 
		$this->registerTask( 'add' , 'edit' ); 
		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'unpublish', 'publish' );
	}

	function edit() 
	{ 
		global $option; 

		$row =& JTable::getInstance('psivideo', 'Table'); 
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' ); 
		$id = $cid[0]; 
		$row->load($id); 
		$lists = array(); 

    $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $row->published);

		HTML_psivideo::editVideo($row, $lists, $option); 
	}
 
	function save() 
	{ 
		global $option; 
		
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$row =& JTable::getInstance('psivideo', 'Table');
	
		if (!$row->bind(JRequest::get('post'))) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
		$row->id = (int) $row->id;
		
    $row->bio = JRequest::getVar( 'bio', '', 'post', 'string', JREQUEST_ALLOWRAW );

    if(!$row->added_date){
      $row->added_date = date( 'Y-m-d H:i:s' );
    }
		$date =& JFactory::getDate($row->added_date);
		$row->added_date = $date->toMySQL();
		
		if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
		
		switch ($this->_task)        
		{
			case 'apply': 
				$msg = 'Changes to Video saved'; 
				$link = 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id; 
				break;
			
			case 'save': 
			default: 
				$msg = 'Video Saved'; 
				$link = 'index.php?option=' . $option; 
				break; 
		}
		 
		$this->setRedirect($link, $msg); 
	} 

	function showVideos() 
	{ 
		global $option, $mainframe;
		
		$limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit')); 
		$limitstart = JRequest::getVar('limitstart', 0); 
		
		$db =& JFactory::getDBO(); 
		$query = "SELECT count(*) FROM #__psivideos"; 
		$db->setQuery( $query ); 
		$total = $db->loadResult(); 
		
		$query = "SELECT * FROM #__psivideos"; 
		$db->setQuery( $query, $limitstart, $limit ); 
		$rows = $db->loadObjectList(); 

    foreach($rows as $v) {
      $query = "SELECT count(*) FROM #__psivideos_votes WHERE psivideo_id = '" . $v->id . "'"; 
      $db->setQuery( $query ); 
      $v->votes = $db->loadResult(); 
    }
		
		if ($db->getErrorNum()) { 
			echo $db->stderr(); 
			return false; 
		} 
		
		jimport('joomla.html.pagination'); 
		
		$pageNav = new JPagination($total, $limitstart, $limit); 
		
		HTML_psivideo::showVideos( $option, $rows, $pageNav );
	} 

	function remove() 
	{ 
		global $option; 
		$cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
		$db =& JFactory::getDBO();
		 
		if(count($cid)) 
		{ 
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid ); 
			$query = "DELETE FROM #__psivideos WHERE id IN ( $cids )"; 
			$db->setQuery( $query );
			if (!$db->query()) { 
				echo "<script> alert('".$db->getErrorMsg()."'); window. history.go(-1); </script>\n"; 
			} 
		}
		
		$this->setRedirect( 'index.php?option=' . $option ); 
	}
	
	function publish() 
	{ 
		global $option;

		$cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
		
		if( $this->_task == 'publish') { 
			$publish = 1; 
		} 
		else { 
			$publish = 0; 
		}
		
		$reviewTable =& JTable::getInstance('psivideo', 'Table'); 
		$reviewTable->publish($cid, $publish); 
		$this->setRedirect( 'index.php?option=' . $option ); 
	}
/*	
	function comments() 
	{ 
		global $option, $mainframe;
		
		$limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
		$limitstart = JRequest::getVar('limitstart', 0);
		
		$db =& JFactory::getDBO(); 
		$query = "SELECT count(*) FROM #__reviews_comments"; 
		$db->setQuery( $query ); 
		$total = $db->loadResult(); 
		
		$query = "SELECT c.*, r.name FROM #__reviews_comments AS c LEFT JOIN #__reviews AS r ON r.id = c.review_id "; 
		$db->setQuery( $query, $limitstart, $limit ); 
		$rows = $db->loadObjectList(); 
		
		if ($db->getErrorNum()) 
		{ 
			echo $db->stderr(); 
			return false; 
		}
		
		jimport('joomla.html.pagination'); 
		$pageNav = new JPagination($total, $limitstart, $limit); 
		HTML_reviews::showComments( $option, $rows, $pageNav ); 
	} 
	
	function editComment() 
	{ 
		global $option; 

		$row =& JTable::getInstance('comment', 'Table'); 
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' ); 
		$id = $cid[0]; 
		$row->load($id); 
		HTML_reviews::editComment($row, $option); 
	}
	
	function saveComment() 
	{ 
		global $option; 

		$row =& JTable::getInstance('comment', 'Table'); 
		
		if (!$row->bind(JRequest::get('post'))) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
		
		if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		} 
		
		$this->setRedirect('index.php?option=' . $option . '&task=comments', 'Comment changes saved'); 
	}
	
	function removeComment() 
	{ 
		global $option; 
		$cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
		$db =& JFactory::getDBO(); 

		if(count($cid)) 
		{ 
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid ); 
			$query = "DELETE FROM #__reviews_comments WHERE id IN ( $cids )"; 
			$db->setQuery( $query ); 
			
			if (!$db->query()) { 
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n"; 
			} 
		} 
		
		$this->setRedirect( 'index.php?option=' . $option . '&task=comments' ); 
	}
  */
}

?>
