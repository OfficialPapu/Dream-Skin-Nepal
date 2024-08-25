$(document).ready(function () {
    let MobileNumField = $('.mobile');
    const validateNumericInput = (inputField) => {
        inputField.on('input', function () {
            $(this).val($(this).val().replace(/[^\d+-]/g, ''));
        });
    };
    validateNumericInput(MobileNumField);
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

    $('.show-pass').click(function (e) {
        e.preventDefault();
        let PassElement = $('.password');
        let EyeIcon = $('.show-pass i');

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

    $('.register-btn').click(function (e) {
        e.preventDefault();
        let FullName = $('.fullname').val();
        let FullNameArray = FullName.split(/\s/);
        let FirstName = FullNameArray[0];
        let LastName = FullNameArray.slice(1).join(' ');
        if (LastName == '') {
            LastName = " ";
        }
        let Mobile = $('.mobile').val();
        let Email = $('.email').val();
        let NewPass = $('.NewPass').val();
        let ConfirmPass = $('.ConfirmPass').val();
        var emailRegex = /\S+@\S+\.\S+/;
        if (!emailRegex.test(Email)) {
            butterup.options.maxToasts = 2;
            butterup.toast({
                message: 'Invalid email address!',
                icon: true,
                dismissable: true,
                type: 'error',
            });
            return;
        }
        if (FirstName != '' && Mobile != '' && Email != '' && NewPass != '') {
            if (NewPass == ConfirmPass) {
                $.ajax({
                    type: "POST",
                    url: "Assets/PHP/Account Configuration/Register.php",
                    data: {
                        DataSend: true,
                        FirstName: FirstName,
                        LastName: LastName,
                        Email: Email,
                        MobileNumber: Mobile,
                        Password: NewPass,
                    },
                    success: function (response) {
                        response = response.trim();
                        if (response == "Sucess") {
                            butterup.options.maxToasts = 2;
                            butterup.toast({
                                message: "Account is sucessfully created",
                                icon: true,
                                dismissable: true,
                                type: 'success',
                            });
                            setTimeout(() => {
                                window.location.href = "Account/Authentication/LoginInterface.php";
                            }, 1000);
                        } else if (response == "Exists") {
                            butterup.options.maxToasts = 2;
                            butterup.toast({
                                message: "Email or number already exist!",
                                icon: true,
                                dismissable: true,
                                type: 'error',
                            });
                        } else {
                            butterup.options.maxToasts = 2;
                            butterup.toast({
                                message: "Something went wrong!",
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
                    message: "Password doesn't match!",
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
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