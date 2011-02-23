<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

class HTML_psivideo 
{ 
	function editVideo( $row, $lists, $option ) 
	{ 
		$editor =& JFactory::getEditor(); 
		JHTML::_('behavior.calendar'); 
		?> 
		<form action="index.php" method="post" name="adminForm" id="adminForm"> 
		<fieldset class="adminform"> 
		<legend>Details</legend> 
		<table class="admintable"> 
		<tr> 
		  <td width="100" align="right" class="key"> Poem Name: </td> 
		  <td> 
        <input class="text_area" type="text" name="poem_name" id="poem_name" size="50" maxlength="250" value="<?php echo $row->poem_name;?>" /> 
		  </td> 
		</tr> 
		<tr> 
		  <td width="100" align="right" class="key"> 
			Youtube Link: 
		  </td> 
		  <td> 
			<input class="text_area" type="text" name="link" id="link" size="50" maxlength="250" value="<?php echo $row->link;?>" /> 
		  </td> 
		</tr> 
		<tr> 
		  <td width="100" align="right" class="key">Stage Name: </td> 
		  <td> 
        <input class="text_area" type="text" name="poet_stage_name" id="poet_stage_name" size="50" maxlength="250" value="<?php echo $row->poet_stage_name;?>" /> 
		  </td> 
		</tr> 
		<tr> 
		  <td width="100" align="right" class="key">First Name: </td> 
		  <td> 
        <input class="text_area" type="text" name="poet_first_name" id="poet_first_name" size="50" maxlength="250" value="<?php echo $row->poet_first_name;?>" /> 
		  </td> 
		</tr> 
		<tr> 
		  <td width="100" align="right" class="key"> Last Name: </td> 
		  <td> 
        <input class="text_area" type="text" name="poet_last_name" id="poet_last_name" size="50" maxlength="250" value="<?php echo $row->poet_last_name;?>" /> 
		  </td> 
		</tr> 
    <tr>
      <td width="100" align="right" class="key"> Bio: </td>
      <td>
      <?php
        echo $editor->display( 'bio', $row->bio , '100%', '150', '40', '5' ) ;
      ?>
      </td>
    </tr>
		<tr> 
		  <td width="100" align="right" class="key"> 
        Email: 
		  </td> 
		  <td> 
        <input class="text_area" type="text" name="poet_email" id="poet_email" size="50" maxlength="250" value="<?php echo $row->poet_email;?>" /> 
		  </td> 
		</tr> 
    <tr> 
		  <td width="100" align="right" class="key"> 
        Phone: 
		  </td> 
		  <td> 
        <input class="text_area" type="text" name="poet_phone" id="poet_phone" size="50" maxlength="250" value="<?php echo $row->poet_phone;?>" /> 
		  </td> 
		</tr>
		<tr> 
		  <td width="100" align="right" class="key"> 
			Added Date: 
		  </td> 
		  <td> 
        <?php echo JHTML::calendar($row->added_date, 'added_date', 'added_date'); ?>
		  </td> 
		</tr> 
		<tr> 
		  <td width="100" align="right" class="key"> 
			Published: 
		  </td> 
		  <td> 
			<?php 
			echo $lists['published']; 
			?> 
		  </td> 
		</tr> 
		</table> 
		</fieldset> 
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" /> 
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" /> 
		<?php echo JHTML::_( 'form.token' ); ?>
		</form> 
		<?php 
	}
	
	function showVideos( $option, &$rows, &$pageNav ) 
	{ 
	  ?> 
	  <form action="index.php" method="post" name="adminForm"> 
	  <table class="adminlist"> 
	    <thead> 
	      <tr> 
	        <th width="20"> 
	          <input type="checkbox" name="toggle" 
	               value="" onclick="checkAll(<?php echo 
	               count( $rows ); ?>);" /> 
	        </th> 
	        <th class="title">Poet Stage Name</th> 
	        <th width="15%">Poem Name</th> 
	        <th width="10%">Added Date</th> 
	        <th width="10%">Votes</th> 
	        <th width="5%" nowrap="nowrap">Published</th> 
	      </tr> 
	    </thead> 
	    <?php
		jimport('joomla.filter.output');
	    $k = 0;
	    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
	    {
			$row = &$rows[$i]; 
			$checked = JHTML::_('grid.id', $i, $row->id );
			$published = JHTML::_('grid.published', $row, $i );
			$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id );
	      ?> 
	      <tr class="<?php echo "row$k"; ?>"> 
	        <td> 
	          <?php echo $checked; ?> 
	        </td> 
	        <td>
			<a href="<?php echo $link; ?>"> 
	          <?php echo $row->poet_stage_name; ?></a>
	        </td> 
	        <td> 
	          <?php echo $row->poem_name; ?> 
	        </td> 
	        <td> 
	          <?php echo $row->added_date; ?> 
	        </td>
	        <td> 
	          <?php echo $row->votes; ?> 
	        </td> 
	        <td align="center"> 
	          <?php echo $published;?> 
	        </td> 
	      </tr> 
	      <?php 
	      $k = 1 - $k; 
	    } 
	    ?>
		<tfoot> 
		 <td colspan="7"><?php echo $pageNav->getListFooter(); ?></td> 
		</tfoot>
	  </table> 
	  <input type="hidden" name="option" value="<?php echo $option;?>" /> 
	  <input type="hidden" name="task" value="" /> 
	  <input type="hidden" name="boxchecked" value="0" /> 
	  <?php echo JHTML::_( 'form.token' ); ?>
	  </form> 
	  <?php 
	}
/*	
	function showVotes( $option, &$rows, &$pageNav ) 
	{ 
	  ?> 
	  <form action="index.php" method="post" name="adminForm"> 
	  <table class="adminlist"> 
	    <thead> 
	      <tr> 
	        <th width="20"> 
	        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /> 
	        </th> 
	        <th class="title">Review Name</th> 
	        <th width="15%">Commenter</th> 
	        <th width="20%">Comment Date</th> 
	        <th width="30%">Comment</th> 
	      </tr> 
	    </thead> 
	    <?php 
	    jimport('joomla.filter.output'); 
	    $k = 0; 
	    for ($i=0, $n=count( $rows ); $i < $n; $i++) { 
	      $row = &$rows[$i]; 
	      $checked = JHTML::_('grid.id', $i, $row->id ); 
	      $link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=editComment&cid[]='. $row->id ); 
	      ?>
		      <tr class="<?php echo "row$k"; ?>"> 
		        <td><?php echo $checked; ?></td> 
		        <td><a href="<?php echo $link; ?>"><?php echo $row->name; ?></a></td> 
		        <td><?php echo $row->full_name; ?></td> 
		        <td><?php echo JHTML::Date($row->comment_date); ?></td> 
		        <td><?php echo substr($row->comment_text, 0, 149); ?></td> 
		      </tr> 
		      <?php 
		      $k = 1 - $k; 
		    } 
		    ?> 
		  <tfoot> 
		    <td colspan="5"><?php echo $pageNav->getListFooter(); ?></td> 
		  </tfoot> 
		  </table> 
		  <input type="hidden" name="option" 
		                       value="<?php echo $option;?>" /> 
		  <input type="hidden" name="task" value="comments" /> 
		  <input type="hidden" name="boxchecked" value="0" /> 
		  <?php echo JHTML::_( 'form.token' ); ?>
		  </form> 
		  <?php  
	} 
	
	function editComment ($row, $option) 
	{ 
	  JHTML::_('behavior.calendar'); 
	  ?> 
	  <form action="index.php" method="post" name="adminForm" id="adminForm"> 
	    <fieldset class="adminform"> 
	      <legend>Comment</legend> 
	      <table> 
	      <tr> 
	        <td width="100" align="right" class="key"> 
	          Name: 
	        </td> 
	        <td> 
	          <input class="text_area" type="text" name="full_name" id="full_name" size="50" maxlength="250" value="<?php echo $row->full_name;?>" /> 
	        </td> 
	      </tr>
		      <tr> 
		        <td width="100" align="right" class="key"> 
		          Comment: 
		        </td> 
		        <td> 
		          <textarea class="text_area" cols="20" rows="4" name="comment_text" id="comment_text" style="width:500px"><?php echo $row->comment_text; ?></textarea> 
		        </td> 
		      </tr> 
		      <tr> 
		        <td width="100" align="right" class="key"> 
		          Comment Date: 
		        </td> 
		        <td>          
				  <?php echo JHTML::calendar($row->comment_date, 'comment_date', 'comment_date'); ?>
		        </td> 
		      </tr> 
		      </table> 
		    </fieldset> 
		    <input type="hidden" name="id" value="<?php echo $row->id; ?>" /> 
		    <input type="hidden" name="option" value="<?php echo $option; ?>" /> 
		    <input type="hidden" name="task" value="" /> 
			<?php echo JHTML::_( 'form.token' ); ?>
		  </form> 
		  <?php 
	}
  */
}
?>
