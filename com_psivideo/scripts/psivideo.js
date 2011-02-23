
jQuery.noConflict();
jQuery(document).ready(function($) {
  $('.videolink').colorbox({width: "70%", height:"465px", iframe: true, transition:"fade",rel:'group', current:'poem {current} of {total}'});
});

function hideVoteResult() {
  jQuery('#voteresult').hide('slow', function() {jQuery(this).remove()});
}
function handleVoteCounted(msg, vid) {
  jQuery.colorbox.close();
  if(!msg || msg === '') {
    msg = 'Your vote has been counted! Thank you for supporting your favorite poet. Please come back in an hour and vote again.';
  }
  var result = '<p id="voteresult" class="warn" style="font: 20px bold">' + msg + '</p>';
  jQuery('#mainbody').prepend(result);

  if(msg.search(/already/) == '-1') {
    var votes = jQuery('.poet-votes' + vid).text();
    try{
      votes = parseInt(votes) + 1;
    }catch(err) {}
    
    jQuery('.poet-votes' + vid).text(votes);
  }
  setTimeout("hideVoteResult()", 5000);
}

