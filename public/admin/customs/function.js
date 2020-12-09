function status_delete(segment) {

    // token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    //status
    var count = $(".status").length;
    for (var i = 0; i < count; i++) {
      var rootstatus = $(".status:eq(" + i + ")").attr('rootstatus');
      if (rootstatus == 1) {
        $(".status:eq(" + i + ")").children().addClass("text-success").html('<i class="fas fa-check-square fa-2x"></i> ');
        $(".status:eq(" + i + ")").attr("status", "0");
      } else {
        $(".status:eq(" + i + ")").children().addClass("text-warning").html('<i class="fas fa-exclamation-circle fa-2x"></i> ');
        $(".status:eq(" + i + ")").attr("status", "1");
      }
    }
    //ajax status
    $("#example1").on('click', '.status', function (e) {
    Swal.fire({
        title: 'Bạn có chắc?',
        text: "Bạn sẽ cập nhật trạng thái này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi đồng ý!',
        cancelButtonText: 'Hủy!'
        }).then((result) => {
        if (result.isConfirmed) {    
            var id = $(this).attr('idstatus');
            var status = $(this).attr('status');
            $.post("/admincp/" + segment + "/status/" + id,
            {
                status: status
            },
            function (result) {
                if (result == 1) {
                    $(".wraptr" + id + " .wrapstatus").html('<a class="status" idstatus="' + id + '" rootstatus="1" status="0"> <span class="text-success"><i class="fas fa-check-square fa-2x"></i> </span></a>');
                } 
                if(result == 0) {
                    $(".wraptr" + id + " .wrapstatus").html('<a class="status" idstatus="' + id + '" rootstatus="0" status="1"> <span class="text-warning"><i class="fas fa-exclamation-circle fa-2x"></i> </span></a>');
                }
                if ((result == 1) || (result == 0)) {
                    Swal.fire(
                        'Cập nhật trạng thái!', 
                        'Mục của bạn đã thay đổi',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Cập nhật trạng thái!',
                        'Mục của bạn đã bị lỗi',
                        'error'
                    )
                }
            }); 
        }
    });

        
    });
    //ajax sort
    $("#example1").on('change', '.sort', function (e) {
      var id = $(this).attr('idsort');
      var sort = $(this).val();
      $.post("admincp/" + segment + "/sort/" + id,
        {
          sort: sort
        },
        function (result) {
          if (result == 'success') {
            location.reload();
          }
        });
    });
    // delete

    $("#example1").on('click', '.swalDefaultSuccess', function (e) {
        var id = $(this).attr('iddeleted');	
        var idmodule = $(this).attr('idmodule');
        var idmethod = $(this).attr('idmethod');
        Swal.fire({
            title: 'Bạn có chắc?',
            text: "Bạn sẽ không khôi phục được dữ liệu!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, tôi đồng ý!',
            cancelButtonText: 'Hủy!'
            }).then((result) => {
            if (result.isConfirmed) {    
                $.get("/admincp/"+segment+"/"+id+"/"+idmethod, 
                    function(data, status){
                        if (data == "success") {
                            Swal.fire(
                                'Xóa dữ liệu!',
                                'Mục của bạn đã được xóa',
                                'success'
                            )
                            setTimeout(function(){
                                location.reload(); 
                            }, 1000);
                        } else {
                            Swal.fire(
                                'Xóa dữ liệu!',
                                'Mục của bạn xóa không thành công',
                                'error'
                            )
                        }		    
                });
            }
        });
    });
  
}