<?php

defined('_JEXEC') or die('Restricted access');

class TableVote extends JTable
{
	var $id = null;
	var $psivideo_id = null;
	var $user_id = null;
	var $vote_date = null;
	var $ip_address = null;

	function __construct(&$db)
	{
		parent::__construct( '#__psivideos_votes', 'id', $db );
	}
}

?>
