// feed
$(document).ready(function () {
    var footer = $('#footer').offset().top - $(window).height();
    var timer;
    $( window ).scroll(function() {
        var y = $(this).scrollTop(); 
        if (y >= footer) {
            if(timer !== null) {
                clearTimeout(timer);
                }
            timer = setTimeout(function(){
                pagenumber = parseInt($(".post").attr('page'));
                nextpage = pagenumber + 1;
                slug = $(".post").attr('slug');
                $.get("load/feed/"+slug+"?page="+nextpage, function(data, status){
                    items = JSON.parse(data);
                    var content = "";
                    $.each(items.data, function(index, item) {
                        content += 
                        '<div class="post-list">' +
                            '<article class="row">' +
                                '<div class="col-md-4">' +
                                    '<a href="'+item.slug+'">' +
                                        '<img src="public/uploads/thumb/'+item.year+'/'+item.month+'/'+item.image+'" onerror="this.onerror=null; this.src=\'public/home/image/non_image.png\'" alt="'+item.title+'" />' +
                                    '</a>' +
                                '</div>' +
                                '<div class="col-md-8">' +
                                    '<h2><a href="'+item.slug+'">'+item.title+'</a> </h2>' +
                                    '<div class="date">'+item.date+'</div>' +
                                    
                                    '<div class="caption">'+'</div>' +
                                    '<a href="'+item.slug+'" class="btn-detail">detail +</a>' +
                                '</div>' +
                            '</article>' +
                        '</div>';
                    }); 
                    $('.post').append(content);
                    $(".post").attr('page',nextpage);
                });
            }, 1000);
            
        }  
    });
    
});