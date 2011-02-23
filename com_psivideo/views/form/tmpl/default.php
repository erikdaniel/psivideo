<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?> 
<?php JHTML::_('behavior.formvalidation'); ?>
<script language="javascript">
function validatePsivideo(f) {
   if (document.formvalidator.isValid(f)) {
      f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
      return true; 
   }
   else {
      var msg = 'Some values are not acceptable.  Please retry.';
      // Example on how to test specific fields
      // if($('email').hasClass('invalid')){msg += '\n\n\t* Invalid E-Mail Address';}
 
      alert(msg);
   }
   return false;
}
</script>
<h2>2011 Brenda Moosy Video Slam Submission Form</h2>
<p>Fill out the form below. By submitting this form you agree to the <a href="http://www.poetryslam.com/index.php?option=com_content&view=article&id=213">terms and rules</a>. To prevent spam, videos are not instantly displayed, and must be approved by an administrator. We will do this as quickly as possible.  Thank you for entering, and good luck!</p>
<form id="psivideo-form" class="form-validate" action="index.php?option=com_psivideo" method="post" onSubmit="return validatePsivideo(this);"> 
<input type="hidden" name="check" value="post"/>

<table>
<tr>
    <td style="width: 100px;"> <strong>Poet Name: </strong></td> 
    <td style="width: 150px"><input class="required" type="text" name="poet_stage_name" id="poet_stage_name" placeholder="Enter Stage Name" value="<?php echo $this->poet_stage_name; ?>" /> </td>
    <td>This will be public, and can be your stage name.</td>
  </tr> 
  <tr>
    <td> <strong>First Name:</strong></td>
    <td><input class="required" type="text" name="poet_first_name" id="poet_first_name" placeholder="Enter First Name" value="<?php echo $this->poet_first_name; ?>" /> </td>
    <td>This will not be public.</td>
  </tr>
  <tr>
    <td> <strong>Last Name:</strong></td>
    <td><input class="required" type="text" name="poet_last_name" id="poet_last_name" placeholder="Enter Last Name" value="<?php echo $this->poet_last_name; ?>" /> </td>
    <td>This will not be public.</td>
  </tr>
  <tr>
    <td> <strong>Email Address:</strong></td>
    <td><input class="required validate-email" type="text" name="poet_email" id="poet_email" placeholder="you@email.com" value="<?php echo $this->poet_email; ?>" /> </td>
    <td>This will not be public.</td>
  </tr>
  <tr>
    <td> <strong>Phone Number:</strong></td>
    <td><input class="required validate-numeric" type="text" name="poet_phone" id="poet_phone" placeholder="3135551212" value="<?php echo $this->poet_phone; ?>" /> </td>
    <td>This will not be public.</td>
  </tr>
   <tr>
    <td> <strong>Poem Name:</td>
    <td><input class="required" type="text" name="poem_name" id="poem_name" placeholder="Untitled" value="<?php echo $this->poem_name; ?>" /> </td>
    <td>This will be public.</td>
  </tr>
 <tr>
    <td> <strong>Link:</td>
    <td><input class="required" type="text" name="link" id="link" placeholder="http://www.youtube.com/watch?v=0rRwaPkfwo4" value="<?php echo $this->link; ?>" /> </td>
    <td>Youtube or Vimeo accepted. Enter the link to the video, not the embed code. Example: http://www.youtube.com/watch?v=0rRwaPkfwo4</td>
  </tr>
  <tr>
    <td style="valign:top"> <strong>Bio: (Publicly Viewable)</strong> </td> 
    <td colspan="2"> <textarea class="text_area" cols="20" rows="4" name="bio" id="bio" placeholder="Please enter your bio, and include where you are from!" style="width:500px"><?php echo $this->bio;?></textarea></td>
</tr> 
</table> 
<input type="hidden" name="view" value="form" /> 
<input type="hidden" name="task" value="save" /> 
<input type="hidden" name="option" value="<?php echo $option; ?>" /> 
<input type="submit" class="button" id="button" value="Submit" /> 
</form>
