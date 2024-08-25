$(document).ready(function() {
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
    $('.login-btn').click(function(e) {
        e.preventDefault();
        let Email = $('#forgot-pass').val();
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Account Configuration/Forgot Password Config.php",
            data: {
                SendEmail: true,
                Email: Email,
            },
            success: function(response) {
                  response=response.trim();
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Your password was sent to your email.',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response == 'Email Not Found') {
                    butterup.toast({
                        message: 'Please enter a valid email!!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else {
                    butterup.toast({
                        message: 'Something went wrong!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }

            }
        });
    });
});