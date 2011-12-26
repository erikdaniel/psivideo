<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<h2>Brenda Moosey WoWPS Video Competition</h2>
<p>Send your favorite poet to the Women of the World Poetry Slam by voting for your favorite poem today!</p>
<p>Enter your own video <a href="index.php?option=com_psivideo&view=form">here</a>.</p>
<?php if(count($this->list) > 0) { ?>
<table id="psivideo_list">
 <thead>
  <tr>
    <th>Poem</th>
    <th>Votes</th>
  </tr>
 </thead>
 <tbody>
<?php
$i = 0;
foreach($this->list as $l): ?>
<tr>
  <td>
    <h3 class="psivideo-poem"> <a class="videolink cboxElement" rel="group<?php echo $i++;?>" href="<?php echo $l->link; ?>"><?php echo $l->poem_name; ?></a> </h3>
    <h4 class="psivideo-poet"> By <?php echo $l->poet_stage_name; ?></h4>
    <p class="poet_bio"><?php echo $l->bio; ?></p>
  </td>
   <td>
     <p class="vote poet-votes<?php echo $l->id;?>"> <?php echo $this->votes[$l->id]; ?> </p>
  </td>
</tr>
</tbody>
<?php endforeach; ?>

</table>

<?php
}
else { ?>
  <p>No videos submitted yet! Submit yours now!</p>
  <?php } ?>

