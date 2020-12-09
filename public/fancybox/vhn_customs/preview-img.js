//test
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.preview-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function(){
    $(".input-img").change(function() {
        readURL(this);
        $(".show-img-prev").empty();
        $(".show-img-prev").append('<img class="preview-img" src="'+readURL(this)+'" style="width: 100%; height: auto;" />');
    });
});

//gallery
$(document).ready(function(){
    $("div").on('click','.trash',function(e){
      $(this).parents('.location-listing').remove();
    });
    $("div").on('click','.flag',function(e){
      var linkimg = $(this).attr('linkimg');
      var article = '<article class="location-listing">';
        article += '<span class="location-title">';
        article += '<div> <i class="trash alternate outline close icon"></i> </div>';
        article += '<div> <i class="flag outline icon" linkimg="'+linkimg+'"></i> </div>';
        article += '</span>';
        article += '<div class="location-image"><img src="'+linkimg+'"  class="prev_img"></div>';
        article += '<input name="image1[]" type="hidden" value='+linkimg+' ">';
        article += '</article>';
      $('.grid-container').prepend(article);       

      $(this).parents('.location-listing').remove();
    }); 
});