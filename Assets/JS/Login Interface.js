$(document).ready(function () {
    const inputs = document.querySelectorAll(".input");
    function addcl() {
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    }
    function remcl() {
        let parent = this.parentNode.parentNode;
        if (this.value == "") {
            parent.classList.remove("focus");
        }
    }
    inputs.forEach(input => {
        input.addEventListener("focus", addcl);
        input.addEventListener("blur", remcl);
    });

    $('#show-pass').click(function (e) {
        e.preventDefault();
        let PassElement = $('.password');
        let EyeIcon = $('#show-pass i');

        PassElement.each(function () {
            if ($(this).prop('type') === 'password') {
                $(this).prop('type', 'text');
                EyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $(this).prop('type', 'password');
                EyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });

    $('.login-btn').click(function (e) {
        e.preventDefault();
        let Email = $('.email').val();
        let Password = $('.password').val();
        if (Email != '' || Password != '') {
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Account Configuration/Login.php",
                data: {
                    DataSend: true,
                    Email: Email,
                    Password: Password,
                },
                success: function (response) {
                      response=response.trim();
                    if (response == "Sucess") {
                        window.open('/', '_self');
                    } else if (response == "Fail") {
                        butterup.toast({
                            message: 'Invalid credential!',
                            icon: true,
                            dismissable: true,
                            type: 'error',
                        });
                    }
                }
            });
        } else {
            butterup.options.maxToasts = 2;
            butterup.toast({
                message: 'All field is required!',
                icon: true,
                dismissable: true,
                type: 'error',
            });
        }
    });
});

