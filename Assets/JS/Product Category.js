$(document).ready(function () {
    $('.option-tag').click(function (e) {
        $(this).toggleClass('active');
    });
    $('.option-list').click(function (e) {
        let SelectedOption = $(this).html().trim();
        $('.SelectedText').html(SelectedOption);
        $('.CategoryName').val(SelectedOption);
    });


    $('#CreateCategory').click(function (e) {
        e.preventDefault();
        let CategoryName = $('.CategoryName').val();
        let CategoryAttribute = $('.CategoryAttribute').val();
        if (CategoryName != '') {
            if(CategoryAttribute!=''){
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Admin/Product Category Config.php",
                data: {
                    CreateCategory: true,
                    CategoryName: CategoryName,
                    CategoryAttribute: CategoryAttribute,
                },
                success: function (response) {
                      response=response.trim();
                    if (response == "Sucess") {
                        butterup.options.maxToasts = 2;
                        butterup.toast({
                            message: 'Category Inserted Successfully',
                            icon: true,
                            dismissable: true,
                            type: 'success',
                        });
                    } else if (response = "Already Exist") {
                        butterup.options.maxToasts = 2;
                        butterup.toast({
                            message: 'Category Already Inserted',
                            icon: true,
                            dismissable: true,
                            type: 'error',
                        });
                    } else {
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
        } 
        else {
            butterup.options.maxToasts = 2;
            butterup.toast({
                message: 'Please Enter a Value!',
                icon: true,
                dismissable: true,
                type: 'error',
            });  
        }
        }else{
            butterup.options.maxToasts = 2;
            butterup.toast({
                message: 'Please Select a Value!',
                icon: true,
                dismissable: true,
                type: 'error',
            });
        }
    });
});