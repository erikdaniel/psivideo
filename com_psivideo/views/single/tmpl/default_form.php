<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?> 
<form action="index.php" method="post"> 
<table> 
<tr><td><strong>Name:</strong></td> <td><input class="text_area" 
        type="text" name="full_name" id="full_name" value="<?php echo 
        $this->name; ?>" /></td></tr> 
<tr><td><strong>Comment:</strong></td> <td><textarea 
        class="text_area" cols="20" rows="4" name="comment_text" 
        id="comment_text" style="width:500px"></textarea></td></tr> 
</table> 
<input type="hidden" name="review_id" value="<?php  echo $this->review->id; ?>" /> 
<input type="hidden" name="task" value="comment" /> 
<input type="hidden" name="option" value="<?php echo $option; ?>" /> 
<input type="submit" class="button" id="button" value="Submit" /> 
</form>
