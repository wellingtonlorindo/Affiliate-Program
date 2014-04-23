
jQuery(document).ready(function(){
  var $ = jQuery;
  $('#btn-sign').click(function(){
    if ($('#user_pass').val() != $('#pass2').val()) {
      $('#user_pass, #pass2').val('');
      $('#user_pass').focus();
      return false;
    }
  });  
});