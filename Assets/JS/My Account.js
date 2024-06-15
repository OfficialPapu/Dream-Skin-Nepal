$(document).ready(function () {
    $('#submit').click(function (e) {
        e.preventDefault();
        let FirstName = $('#firstname').val();
        let LastName = $('#lastname').val();
        let Address = $('#address').val();
        let Gender = $('#gender').val();
        let DOB = $('#DOB').val();
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Account Configuration/My Account Config.php",
            data: {
                UpdateData: true,
                FirstName: FirstName,
                LastName: LastName,
                Address: Address,
                Gender: Gender,
                DOB: DOB,
            },
            success: function (response) {
                if (response == 'Success') {
                }
            }
        });
    });

});

$(document).on('change', '#file-input', function () {
    let InputImage = this.files[0];
    if (InputImage) {
        let InputName = InputImage.name;
        let InputExtension = InputName.split('.').pop().toLowerCase();
        let formData = new FormData();
        formData.append('image', InputImage);
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Account Configuration/Upload User Image Config.php",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response == 'Success') {
                   location.reload();
                }
            },
        });
    }
});
