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
      if (image.charAt(0) == '[') {
        image = image.slice(1,-1);
      } else {
        image = image;
      }
      var res = image.split(",");
      var count = res.length;
      for (var i = 0; i < count; i++) {
        if (count > 1) {
          res[i] = res[i].slice(1,-1);
        }
        var article = '<article class="location-listing">';
            article += '<span class="location-title">';
            article += '<div> <i class="trash alternate outline close icon"></i> </div>';
            article += '<div> <i class="flag outline icon" linkimg="'+res[i]+'"></i> </div>';
            article += '</span>';
            article += '<div class="location-image"><img src="'+res[i]+'"  class="prev_img"></div>';
            article += '<input name="image1[]" type="hidden" value='+res[i]+' ">';
            article += '</article>';
        $('.grid-container').prepend(article);       
      }
    }
  }

  
  // function clear_img(){
  //   $(".location-title").click(function(){
  //     $(this).parents('.location-listing').remove();
  //   });
  // }