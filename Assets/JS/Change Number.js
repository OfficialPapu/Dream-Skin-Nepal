let mobile_num = document.getElementById('mobile-num');
let pass_next = document.getElementById('submit');
let null_data = document.getElementsByClassName('null-data')[0];
let sucess_msg = document.getElementsByClassName('sucess-data')[0];

mobile_num.addEventListener("focus", () => {
    if (mobile_num.value == '') {
        mobile_num.value = "+977-";
    }
});
const validateNumericInput = (inputField) => {
    inputField.value = inputField.value.replace(/[^\d+-]/g, '');
};


$(pass_next).click(function (e) {
    e.preventDefault();
    const mobileWithoutPrefix = mobile_num.value.replace("+977-", "");
    if (mobileWithoutPrefix == '') {
        butterup.options.maxToasts = 2;
        butterup.toast({
            message: 'New Numer Is Required',
            icon: true,
            dismissable: true,
            type: 'error',
        });
    } else {
        let NewNumber = $('#mobile-num').val();
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Account Configuration/Change Number Config.php",
            data: {
                ChangeNumber: true,
                NewNumber: NewNumber,
            },
            success: function (response) {
                  response=response.trim();
                if (response == 'NumberUpdatedSucessfully') {
                    butterup.options.maxToasts = 2;
                    butterup.toast({
                        message: 'Number Successfully Changed',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                    $('.old-num').val(NewNumber);
                    $(mobile_num).val('+977-');
                }
                else {
                    butterup.options.maxToasts = 2;
                    butterup.toast({
                        message: 'Something went wrong',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            }
        });
    }
});
