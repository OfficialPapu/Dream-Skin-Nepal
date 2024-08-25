$(document).ready(function () {
    let container = $('.image-list-container');
    let input = $('.data-upload input');
    $('.minimize-btn-box').click(function (e) {
        e.preventDefault();
        $('.general-information').toggleClass('active');
    });

    $('.minimize-image-box-btn-box').click(function (e) {
        e.preventDefault();
        $('.image-section').toggleClass('active');
    });

    $(".save-changes").click(function (e) { 
        e.preventDefault();
        let CategoryID=$("#formdata").data("category-id");
        let formData = new FormData($("#formdata")[0]);
        formData.append('EditCategory', true);
        formData.append('CategoryID', CategoryID);
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response == "Success") {
                    butterup.options.maxToasts = 2;
                    butterup.toast({
                        message: 'Product Sucessfully Inserted',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else{
                    butterup.options.maxToasts = 2;
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