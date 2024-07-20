$(document).ready(function () {
    let RowOrderID = $('.option-tag').data('row-id');
    let UserID = $('.option-tag').data('user-id');
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            CheckProductStatus: true,
            RowOrderID:RowOrderID,
            UserID: UserID,
        },
        success: function (response) {
            $('.SelectedText').html(response);
        }
    });

    $('.option-tag').click(function (e) {
        $(this).toggleClass('active');
    });
    $('.option-list').click(function (e) {
        let SelectedOption = $(this).html().trim();
        $('.SelectedText').html(SelectedOption);
        let UserID = $('.option-tag').data('user-id');
        let RowOrderID = $('.option-tag').data('row-id');
        let Subtotal = $("#subtotal").val();
        $.ajax({
            url: 'Assets/PHP/Configuration/Common Function.php',
            method: 'POST',
            data: {
                UpdateOrderStatus: true,
                SelectedOption: SelectedOption,
                UserID: UserID,
                RowOrderID:RowOrderID,
                Subtotal:Subtotal,
            },
            success: function (response) {
                response=response.trim();
                if (response == 'Pending') {
                    butterup.toast({
                        message: 'Status Updated To Pending',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                }else if (response == 'Completed') {
                    butterup.toast({
                        message: 'Order Is Completed',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response == 'Shipped') {
                    butterup.toast({
                        message: 'Status Updated To Shipped',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response == 'Cancelled') {
                    butterup.toast({
                        message: 'Status Updated To Cancelled',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                }else if (response == 'Rejected') {
                    butterup.toast({
                        message: 'Status Updated To Rejected',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                }else {
                    butterup.toast({
                        message: 'Something went wrong!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });



    });
});

