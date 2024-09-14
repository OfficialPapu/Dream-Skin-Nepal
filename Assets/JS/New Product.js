$(document).ready(function () {

    function CusTomID(params) {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                FindCustomProductID: true,
            },
            success: function (response) {
                let originalString = response;
                let numericPart = originalString.match(/\d+/)[0];
                let incrementedNumericPart = String(Number(numericPart) + 1).padStart(numericPart.length, '0');
                let modifiedString = originalString.replace(/\d+/, incrementedNumericPart);
                $('#CustomProductID').val(modifiedString);
            }
        });
    }

    CusTomID();
    $('#formdata').submit(function (e) {
        e.preventDefault();
         $(this).css("pointer-events", "none");
        $('#Submit').css("padding", "4px");
        $('#Submit').html(`<svg viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>`);
        let formData = new FormData($(this)[0]);
        let skinTypes = [];
        $('.skintypeselect .custom-checkbox:checked').each(function () {
            skinTypes.push($(this).data("categoryid"));
        });
        formData.append('SkinTypes', JSON.stringify(skinTypes));
        let BrandID = $('#BrandList .ProductTypeID').val();
        let SkinCareID = $('#SkinCare .ProductTypeID').val();
        let MakeupID = $('#makeup .ProductTypeID').val();
        let BodyHairCareID = $('#bodyandhaircare .ProductTypeID').val();
        let ProductTypeID;
        if (SkinCareID == '' && MakeupID == '') {
            ProductTypeID = BodyHairCareID;
        } else if (MakeupID == '' && BodyHairCareID == '') {
            ProductTypeID = SkinCareID;
        } else if (BodyHairCareID == '' && SkinCareID == '') {
            ProductTypeID = MakeupID;
        }
        formData.append('AddNewProduct', true);
        formData.append('BrandID', BrandID);
        formData.append('ProductTypeID', ProductTypeID);
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/New Product Config.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#formdata").css("pointer-events", "all");
                $('#Submit').css("padding", "10px");
                $('#Submit').html(`Submit`);
                if (response == "Product added") {
                    $('#formdata')[0].reset();
                    $('.custom-checkbox').closest('.select-skin-type').find('.SelectedText').text('Select Skin Type');
                    CusTomID();
                    butterup.options.maxToasts = 2;
                    butterup.toast({
                        message: 'Product Sucessfully Inserted',
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
    });
});

$(document).ready(function () {

    $('.minimize-btn-box').click(function (e) {
        e.preventDefault();
        $('.general-information').toggleClass('active');
    });

    $('.minimize-image-box-btn-box').click(function (e) {
        e.preventDefault();
        $('.image-section').toggleClass('active');
    });

    let brandOptionTag = $('#BrandList');
    let SkinCareTag = $('#SkinCare');
    let MakeupTag = $('#makeup');
    let BodyandhaircareTag = $('#bodyandhaircare');

    let currentBrandIndex = -1;
    let currentSkinCareTagIndex = -1;
    let MakeupTagIndex = -1;
    let BodyandhaircareTagIndex = -1;

    function handleOptionSelection(optionTag, selectedOption, currentIndex, categoryid) {
        optionTag.find('.SelectedText').html(selectedOption.html().trim());
        optionTag.find('.ProductTypeID').val(categoryid);
        optionTag.find('.option-list').removeClass('selected');
        selectedOption.addClass('selected');
        let optionsContainer = optionTag.find('.options');
        let scrollPos = selectedOption.position().top + (-50) + optionsContainer.scrollTop();
        optionsContainer.scrollTop(scrollPos);
        currentIndex = optionTag.find('.option-list').index(selectedOption);
    }

    $('.option-tag').click(function (e) {
        $('.option-tag').not(this).removeClass('active');
        $(this).toggleClass('active');
    });

    brandOptionTag.on('click', '.option-list', function (e) {
        let selectedOption = $(this);
        let categoryid = selectedOption.data('brand-id');
        handleOptionSelection(brandOptionTag, selectedOption, currentBrandIndex, categoryid);
    });

    SkinCareTag.on('click', '.option-list', function (e) {
        let selectedOption = $(this);
        let categoryid = selectedOption.data('product-type-id');
        MakeupTag.find('.SelectedText').html('Select Makeup');
        BodyandhaircareTag.find('.SelectedText').html('Select Body & Hair Care');
        MakeupTag.find('.ProductTypeID').val('');
        BodyandhaircareTag.find('.ProductTypeID').val('');
        handleOptionSelection(SkinCareTag, selectedOption, currentSkinCareTagIndex, categoryid);
    });

    MakeupTag.on('click', '.option-list', function (e) {
        let selectedOption = $(this);
        let categoryid = selectedOption.data('product-type-id');
        SkinCareTag.find('.SelectedText').html('Select Skin Care');
        BodyandhaircareTag.find('.SelectedText').html('Select Body & Hair Care');
        SkinCareTag.find('.ProductTypeID').val('');
        BodyandhaircareTag.find('.ProductTypeID').val('');
        handleOptionSelection(MakeupTag, selectedOption, MakeupTagIndex, categoryid);
    });

    BodyandhaircareTag.on('click', '.option-list', function (e) {
        let selectedOption = $(this);
        let categoryid = selectedOption.data('product-type-id');
        SkinCareTag.find('.SelectedText').html('Select Skin Care');
        MakeupTag.find('.SelectedText').html('Select Makeup');
        SkinCareTag.find('.ProductTypeID').val('');
        MakeupTag.find('.ProductTypeID').val('');
        handleOptionSelection(BodyandhaircareTag, selectedOption, BodyandhaircareTagIndex, categoryid);
    });


    $(document).keydown(function (e) {
        let key = e.key.toUpperCase();
        let activeOptionTag = $('.option-tag.active');
        if (activeOptionTag.length) {
            let optionList = activeOptionTag.find('.option-list');
            let matchedOptions = optionList.filter(function () {
                return $(this).text().trim().charAt(0).toUpperCase() === key;
            });

            if (matchedOptions.length > 0) {
                let currentIndex = activeOptionTag.find('.option-list').index(matchedOptions.eq(0));
                let nextIndex = (currentIndex + 1) % matchedOptions.length;
                let selectedOption = matchedOptions.eq(nextIndex);
                handleOptionSelection(activeOptionTag, selectedOption, currentIndex);
            }
        }
    });

    $(document).on('change', '.custom-checkbox', function () {
        let SkintypeValue = [];
        $(this).closest('.select-skin-type').find(".custom-checkbox:checked").each(function () {
            SkintypeValue.push($(this).val());
        });
        if (SkintypeValue.length > 0) {
            $(this).closest('.select-skin-type').find('.SelectedText').text(SkintypeValue.join(', '));
        } else {
            $(this).closest('.select-skin-type').find('.SelectedText').text('Select Skin Type');
        }
    });

    $(window).click(function (event) {
        if (!$(event.target).closest('.select-skin-type').length) {
            $('.select-skin-type .option-tag').removeClass('active');
        }
    });

});
