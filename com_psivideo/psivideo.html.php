<?php

class HTML_psivideos {
	function showVideos($rows, $option) {
		?><table><?php
		foreach($rows as $row)
		{
			$link = JRoute::_('index.php?option=' . $option . '&id=' . $row->id .  '&task=view');
			echo '<tr>';
      echo '<td><a class="psivideo" href="' . $link . '">' . $row->poet_stage_name . '</a></td>';
      echo '<td><a class="psivideo" href="' . $link . '">' . $row->poem_name . '</a></td>';
      echo '</tr>';
		}
		?></table><?php
	}
	
	function showReview($row, $option) {
		?> 
		<p class="contentheading"><?php echo $row->poet_stage_name; ?></p>
		<p class="createdate"><?php echo JHTML::Date($row->added_date); ?></p> 
		<p><a href="<?php echo $row->link;?>">View Video</a></p> 
		<p class="poet_bio"><?php echo $row->poet_bio; ?></p> 
		 
		<?php $link = JRoute::_('index.php?option=' . $option) ; ?> 
		<a href="<?php echo $link; ?>">&lt; return to the videos</a> 
		<?php 
	}
	
	function showVoteForm($option, $video_id, $name) {
	  ?>
	  <br /><br /> 
	  <form action="index.php" method="post"> 
	  <table> 
	    <tr> 
	      <td> 
	        <strong>Name:</strong> 
	      </td> 
	      <td> 
	        <input class="text_area" type="text" name="full_name" 
	          id="full_name" value="<?php echo $name; ?>" /> 
	      </td> 
	    </tr> 
    </table>
	  <input type="hidden" name="review_id" value="<?php echo $video_id; ?>" />
	  <input type="hidden" name="task" value="comment" />
	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="submit" class="button" id="button" value="Vote For This Video" />
	  </form> 
	  <?php 
	}
	
	function showVotes($row) 
	{ 
		?> 
		<p>Votes: <?php echo $row->votes; ?></p> 
		<?php 
	}
}

?>
