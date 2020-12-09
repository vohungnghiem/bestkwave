// more
$(document).ready(function () {
    $(".btn-more").click(function(e){
        e.preventDefault();
        pagenumber = parseInt($(".nextpage").attr('href'));
        nextpage = pagenumber + 1;
        $.get("load/more?page="+nextpage, function(data, status){
            items = JSON.parse(data);
            var content = "";
            $.each(items.data, function(index, item) {
                content += 
                '<article class="col-md-4 col-12">' +
                    '<div class="home-item-article">' + 
                        '<div class="item-image">' +
                            '<a href="'+item.slug+'">' +
                                '<img src="public/uploads/thumb/'+item.year+'/'+item.month+'/'+item.image+'" onerror="this.onerror=null; this.src=\'public/home/image/non_image.png\'" alt="'+item.title+'" />' +
                            '</a>' +
                        '</div>' +
                        '<div class="item-text">' +
                            '<p class="item-cat">'+item.title_cat+'</p>' +
                            '<h2 class="item-title"><a href="'+item.slug+'">'+item.title+'</a></h2>' +
                            '<p class="item-date">'+ item.date + '</p>' +
                        '</div>' +
                    '</div>' +
                '</article>';
            }); 
            $('#loadmore').append(content);
            $(".nextpage").attr('href',nextpage);
        });
    });
});