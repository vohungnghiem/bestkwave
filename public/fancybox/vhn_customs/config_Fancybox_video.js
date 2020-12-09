$(document).ready(function(){
  $('.fancy').fancybox({
    width   : '90%',
    height  : '90%',
    lang : 'vn',
    'type'   : 'iframe'       // tell the script to create an iframe
  });
});
  function responsive_filemanager_callback(field_id){
    if(field_id == 'none_img'){
      var image = $('#' + field_id).val();
      //$('#prev_img').attr('src', image);
      $('#prev_img').html('<video width="320" height="240" controls> <source src="'+image+'" type="video/mp4"></video>');
      
    }
      
  }
  function clear_img(){
    var images = 'uploads/no-image.jpg';
    $('#prev_img').html('');
    $('#none_img').val('');
  }
