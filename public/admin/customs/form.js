$(document).ready(function(){
    $('.select').select2({});
    
    $("#phone").inputmask({
        mask: '999 999 9999',
        placeholder: ' ',
        showMaskOnHover: false,
        showMaskOnFocus: false,
        onBeforePaste: function (pastedValue, opts) {
            var processedValue = pastedValue;
            return processedValue;
        }
    });
    // // combodate d-m-y
    // $('#account-datetime').combodate();
    
});
