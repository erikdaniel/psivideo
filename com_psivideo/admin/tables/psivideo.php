<?php
defined('_JEXEC') or die('Restricted access');

class TablePSIVideo extends JTable
{
	var $id = null;
	var $poem_name = null;
	var $link = null;
  var $poet_stage_name = null;
  var $poet_first_name = null;
  var $poet_last_name = null;
  var $poet_email = null;
  var $poet_phone = null;
  var $bio = null;
  var $added_date = null;
	var $published = null;

	function __construct(&$db)
	{
		parent::__construct( '#__psivideos', 'id', $db );
	}
}

?>
