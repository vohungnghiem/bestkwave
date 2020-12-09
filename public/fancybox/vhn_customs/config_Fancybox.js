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
      $('#prev_img').attr('src', image);
    }else if(field_id == 'none_img_1'){
      var image_1 = $('#' + field_id).val();
      $('#prev_img_1').attr('src', image_1);
    }else if(field_id == 'none_img_2'){
      var image_2 = $('#' + field_id).val();
      $('#prev_img_2').attr('src', image_2);
    }else if(field_id == 'none_img_3'){
      var image_3 = $('#' + field_id).val();
      $('#prev_img_3').attr('src', image_3);
    }
      
  }
  function clear_img(){
    var images = 'uploads/no-image.jpg';
    $('#prev_img').attr('src', images);
    $('#none_img').val('uploads/no-image.jpg');
  }
