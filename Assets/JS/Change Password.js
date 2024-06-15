let password_not_match = document.getElementsByClassName('password-not-match')[0];
let password_matched = document.getElementsByClassName('password-matched')[0];
let passwordbox = document.getElementsByClassName('passwordbox');
let pass_next = document.getElementById('submit');
$(document).ready(function () {
    $(pass_next).click(function (e) {
        e.preventDefault();
        let OldPass = $('#old_pass').val();
        let NewFirstPass = $('#first_new_pass').val();
        let NewSecondPass = $('#last_new_pass').val();
        if (OldPass != '') {
            if (NewFirstPass.lenght >= 8) {

                $.ajax({
                    type: "POST",
                    url: "Assets/PHP/Account Configuration/Change Password Config.php",
                    data: {
                        ChangePass: true,
                        OldPass: OldPass,
                        NewFirstPass: NewFirstPass,
                        NewSecondPass: NewSecondPass,
                    },
                    success: function (response) {
                          response=response.trim();
                        if (response == 'PassChangedSucessfully') {
                            butterup.options.maxToasts = 2;
                            butterup.toast({
                                message: 'Password Is Updated Successfully',
                                icon: true,
                                dismissable: true,
                                type: 'success',
                            });
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
            }else{
                butterup.options.maxToasts = 2;
                butterup.toast({
                    message: 'Password Length Must Be Grater Than 8!!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
        } else {
            butterup.options.maxToasts = 2;
            butterup.toast({
                message: 'Old Password Is Required',
                icon: true,
                dismissable: true,
                type: 'error',
            });
        }

    });

});

function handlePasswordChange() {
    const passwordsMatch = passwordbox[0].value === passwordbox[1].value;
    if (passwordsMatch) {
        showMessage(password_matched);
        pass_next.style.pointerEvents = 'auto';
        pass_next.style.background = '#dd346c';
    } else {
        showMessage(password_not_match);
        pass_next.style.pointerEvents = 'none';
        pass_next.style.background = '#f15d8f';
    }
}

function showMessage(element) {
    if (element.style.display == 'block') {
        element.style.display = 'none';
    }
    element.style.display = 'block';

    setTimeout(() => {
        element.style.display = 'none';
    }, 1000);
}

passwordbox[0].addEventListener("change", handlePasswordChange);
passwordbox[1].addEventListener("input", handlePasswordChange);


const scrollPosition = sessionStorage.getItem('scrollPosition');

if (scrollPosition) {
    // If scroll position is found, scroll to that position
    window.scrollTo(0, parseInt(scrollPosition));
}

// Save scroll position when the user scrolls
window.addEventListener('scroll', function () {
    const currentScroll = window.scrollY;
    sessionStorage.setItem('scrollPosition', currentScroll.toString());
});

// Clear scroll position when navigating away from the page
window.addEventListener('beforeunload', function () {
    sessionStorage.removeItem('scrollPosition');
});