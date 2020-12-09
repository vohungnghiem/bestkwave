$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
}); 
$('.select2bs4').select2({
    theme: 'bootstrap4'
})