$(document).ready(function () {
    let OptionTag = $('.option-tag');
    let SelectBtn = $('.select-btn');
    let currentSelectedIndex = -1;

    function handleOptionSelection(selectedOption) {
        $('.SelectedText').html(selectedOption.html().trim());
        $('.option-list').removeClass('selected');
        selectedOption.addClass('selected');
    }

    $('.option-tag').click(function (e) {
        $(this).toggleClass('active');
    });

    $('.option-list').click(function (e) {
        let selectedOption = $(this);
        handleOptionSelection(selectedOption);
        currentSelectedIndex = $('.option-list').index(selectedOption);
    });

    $(document).keydown(function (e) {
        if (OptionTag.hasClass('active')) {
            let key = e.key.toUpperCase();
            let optionList = $('.option-list');
            let matchedOptions = optionList.filter(function () {
                return $(this).text().trim().charAt(0).toUpperCase() === key;
            });
            if (matchedOptions.length > 0) {
                let nextIndex = -1;
                if (currentSelectedIndex === -1) {
                    nextIndex = 0;
                } else {
                    nextIndex = (currentSelectedIndex + 1) % matchedOptions.length;
                }
                let selectedOption = matchedOptions.eq(nextIndex);
                handleOptionSelection(selectedOption);
                currentSelectedIndex = nextIndex;
            }
        }
    });
    let CouponValue = $('#coupon-amount');
    let MinCartElement = $('#min-cart-price');
    const validateNumericInput = (inputField) => {
        inputField.on('input', function () {
            $(this).val($(this).val().replace(/[^\d]/g, ''));
        });
    };
    validateNumericInput(CouponValue);
    validateNumericInput(MinCartElement);

    $('#create-coupon').click(function (e) {
        e.preventDefault();
        let MinCartValue = $('#min-cart-price').val();
        let coupontype = $('.SelectedText').text();
        let couponcode = $('#coupon-code').val();
        let coupondescription = $('#coupon-description').val();
        let enddate = $('#end-date').val();
        let couponamount = $('#coupon-amount').val();
        coupontype = coupontype.trim();
        if (coupontype != "Select Coupon Type" && couponcode != "" && coupondescription != "" && enddate != "" && couponamount != "" && MinCartValue != "") {
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Configuration/Common Function.php",
                data: {
                    CreateCoponCode: true,
                    couponcode: couponcode,
                    coupondescription: coupondescription,
                    enddate: enddate,
                    coupontype: coupontype,
                    couponamount: couponamount,
                    MinCartValue:MinCartValue,
                },
                success: function (response) {
                      response=response.trim();
                    if (response == 'Exists') {
                        butterup.options.maxToasts = 2;
                        butterup.toast({
                            message: 'Coupon code already exists!',
                            icon: true,
                            dismissable: true,
                            type: 'error',
                        });
                    } else if (response == 'Success') {
                        butterup.options.maxToasts = 2;
                        butterup.toast({
                            message: 'Coupon code is created',
                            icon: true,
                            dismissable: true,
                            type: 'success',
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
        } else {
            butterup.options.maxToasts = 2;
            butterup.toast({
                message: 'All filed is required!',
                icon: true,
                dismissable: true,
                type: 'error',
            });
        }

    });
});