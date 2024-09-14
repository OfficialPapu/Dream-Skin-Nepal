$(document).ready(function () {
    $('.btn').click(function (e) {
        e.preventDefault();
        let Email = $('#email').val();
        let Pass = $('#Pass').val();
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/Admin Login Interface Config.php",
            data: {
                LoginAdmin: true,
                Email: Email,
                Pass: Pass,
            },
            success: function (response) {
                response=response.trim();
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Login Succesful',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                    setTimeout(()=>{
                $.get("Assets/PHP/Configuration/Get Redirect Url.php", function (RedirectUrl) {
                         if (RedirectUrl) {
                            localStorage.removeItem('RedirectAfterLogin'); 
                            window.open(RedirectUrl, '_self');
                            }else {
                                window.open('/Admin/', '_self');
                            }
                        });
                    },500)
                } else {
                    butterup.toast({
                        message: 'Invalid Credentials',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            }
        });
    });
});