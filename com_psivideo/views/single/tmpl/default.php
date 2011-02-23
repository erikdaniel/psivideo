<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?> 

<div id="video">
  <?php echo $this->video->link; ?> 
</div>
<div id="poet-info">
  <p class="poem-name"><?php echo $this->video->poem_name; ?> </p> 
  <p class="poet-name">By <?php echo $this->video->poet_stage_name; ?> </p> 
  <p class="entrydate"><?php echo $this->video->added_date; ?> </p> 
  <p class="bio"><strong>About the poet:</strong> <?php echo  $this->video->bio; ?> </p> 
  <!--
  <a href="<?php echo $this->backlink; ?>">&lt; return to the reviews </a>
  -->
  <?php if($this->votes) : ?> 
    <p class="votes"><strong>Votes: </strong> <?php echo $this->votes;?></p>
  <?php endif; ?> 
  <?php if($this->voting_open) :?>
    <div class="voting-form">
      <?php echo $this->loadTemplate('vote'); ?>
    </div>
  <?php endif; ?>
