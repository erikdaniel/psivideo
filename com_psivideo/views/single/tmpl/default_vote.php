<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?> 
<div id="votes" style="position: absolute; right: 10px; top:340px;">
  <form action="index.php" method="post"> 
<!--
    <p><strong>Votes:</strong><?php echo $this->_votes; ?></p>
-->
    <input type="hidden" name="video_id" value="<?php  echo $this->video->id; ?>" /> 
    <input type="hidden" name="task" value="vote" /> 
    <input type="hidden" name="option" value="<?php echo $option; ?>" /> 
    <input type="submit" class="button" style="padding: 3px 5px" id="button" value="Vote for this Poem" /> 
  </form>
</div>
