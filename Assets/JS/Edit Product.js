let files = [];
let RowID = [];
let ID = $('#ID').val();
let ShortOrder = "";
let SkintypeID = [];
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



    $('.select').click(() => input.click());

    input.change(() => {
        for (let i = 0; i < input[0].files.length; i++) {
            if (!files.some(file => file.name === input[0].files[i].name)) {
                files.push(input[0].files[i]);
            }
        }
        showImages();
    });

    $('.image-list-container').on('click', '.image .delete-image', function () {
        let index = $(this).closest('.image').index();
        let DeleteImageRowID = $(this).closest('.delete-image').data('row-id');
        delimage(index, DeleteImageRowID);
    });

    $('.data-upload').on({
        dragover: e => {
            e.preventDefault();
            $('.data-upload').css('background', 'rgba(0, 0, 0, 0.1)');
        },
        drop: e => {
            e.preventDefault();
            let droppedFiles = e.originalEvent.dataTransfer.files;

            for (let i = 0; i < droppedFiles.length; i++) {
                if (!files.some(file => file.name === droppedFiles[i].name)) {
                    files.push(droppedFiles[i]);
                }
            }
            showImages();
            $('.data-upload').css('background', '#dfe3f259');
        }
    });

    function delimage(index, DeleteImageRowID) {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                DeleteImage: true,
                DeleteImageRowID: DeleteImageRowID,
            },
            success: function (response) {
                response = response.trim();
                if (response == 'LastImage') {
                    butterup.toast({
                        message: 'Unable to Delete Last Image!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else if (response == 'Error') {
                    butterup.toast({
                        message: 'Something went wrong!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else if (response == 'Not Saved') {
                    butterup.toast({
                        message: 'File Not Saved!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else if (response == 'Success') {
                    butterup.toast({
                        message: 'Image Deleted Successfully',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                    files = files.filter((_, i) => i !== index);
                    FeatchRowID();
                }
            }
        });
    }

    container.sortable({
        update: function (event, ui) {
            ShortOrder = container.sortable('toArray', { attribute: 'data-sortable-id' });
            $('.update-images').click(function (e) {
                $.ajax({
                    type: "POST",
                    url: "Assets/PHP/Configuration/Common Function.php",
                    data: {
                        UpdatePosition: true,
                        ID: ID,
                        ShortOrder: ShortOrder,
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            });
        }
    });
    function showImages() {
        let images = '';
        files.forEach((e, i) => {
            if (e['type'] == 'databaseimage') {
                let imgSrc = typeof e === 'string' ? e : e['name'];
                images += `<div class="image" data-sortable-id="${RowID[i]}">  
                        <img src="${imgSrc}" alt="image">
                      <span class='delete-image' data-row-id="${RowID[i]}"><i class='bx bx-x'></i></span></div>`;
            } else {
                images += `<div class="image">  
                      <img src="${URL.createObjectURL(e)}" alt="image">
                      <span class='delete-image' data-row-id="0"><i class='bx bx-x' data-row-id="0"></i></span>
                  </div>`;
            }
        });
        container.html(images);
    }


    function BrandList() {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                SelectList: true,
                SelectName: 'Brand',
            },
            dataType: "json",
            success: function (SelectData) {
                SelectData.forEach(data => {
                    const li = $('<li>', {
                        class: 'option-list',
                        'data-brand-id': data['ProductCategoryID'],
                        text: data['ProductCategoryAttribute']
                    });
                    $('#BrandItems').append(li);
                });
            }
        });
    }

    let SkinCareList = () => {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                SelectList: true,
                SelectName: 'Skin Care',
            },
            dataType: "json",
            success: function (SelectData) {
                SelectData.forEach(data => {
                    const li = $('<li>', {
                        class: 'option-list',
                        'data-product-type-id': data['ProductCategoryID'],
                        text: data['ProductCategoryAttribute']
                    });
                    $('#SkinCareItems').append(li);
                });
            }
        });
    }

    let MakeupList = () => {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                SelectList: true,
                SelectName: 'Makeup',
            },
            dataType: "json",
            success: function (SelectData) {
                SelectData.forEach(data => {
                    const li = $('<li>', {
                        class: 'option-list',
                        'data-product-type-id': data['ProductCategoryID'],
                        text: data['ProductCategoryAttribute']
                    });
                    $('#makeupitems').append(li);
                });
            }
        });
    }

    let BodyHairCare = () => {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                SelectList: true,
                SelectName: 'Body & Hair Care',
            },
            dataType: "json",
            success: function (SelectData) {
                SelectData.forEach(data => {
                    const li = $('<li>', {
                        class: 'option-list',
                        'data-product-type-id': data['ProductCategoryID'],
                        text: data['ProductCategoryAttribute']
                    });
                    $('#bodyandhaircarelist').append(li);
                });
            }
        });
    }
    let SkinType = () => {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                SkintypeList: true,
                SelectName: 'Skin Type',
                ID: ID,
            },
            dataType: "json",
            success: function (SelectData) {
                SelectData.forEach(data => {
                    const isChecked = data['CategoryID'] !== null && data['CategoryID'] !== undefined;
                    const Element = $(`
                        <label class="checkbox-container">
                        <input class="custom-checkbox" type="checkbox" value="${data['ProductCategoryAttribute']}" data-categoryid="${data['ProductCategoryID']}" ${isChecked ? 'checked' : ''}>
                        <span class="checkmark"></span>
                        <p>${data['ProductCategoryAttribute']}</p>
                        </label>`);
                    $('#Skintype').append(Element);
                });
            }
        });
    }

    BrandList();
    SkinCareList();
    MakeupList();
    BodyHairCare();
    SkinType();

    $('.save-changes').click(function (e) {
        let CustomProductID = $('#CustomProductID').val();
        let Title = $('#ProductTitle').val();
        let Price = $('#ProductPrice').val();
        let DiscountPrice = $('#DiscountPrice').val();
        let DiscountPercentage = $('#DiscountPercentage').val();
        let ProductQuantity = $('#ProductQuantity').val();
        let ProductDescription = $('#Productdescription').val();
        let BrandID = $('#BrandList .ProductTypeID').val();
        let SkinCareID = $('#SkinCare .ProductTypeID').val();
        let MakeupID = $('#makeup .ProductTypeID').val();
        let BodyHairCareID = $('#bodyandhaircare .ProductTypeID').val();
        let SelectedProductTypeID = $('.SelectedProductTypeID').val();
        if (SkinCareID == '' && MakeupID == '') {
            ProductTypeID = BodyHairCareID;
        } else if (MakeupID == '' && BodyHairCareID == '') {
            ProductTypeID = SkinCareID;
        } else if (BodyHairCareID == '' && SkinCareID == '') {
            ProductTypeID = MakeupID;
        }
        if (ProductTypeID == '') {
            ProductTypeID = SelectedProductTypeID;
        }
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                Edit: true,
                ProductID: ID,
                CustomProductID: CustomProductID,
                Title: Title,
                Price: Price,
                DiscountPrice: DiscountPrice,
                DiscountPercentage: DiscountPercentage,
                ProductQuantity: ProductQuantity,
                ProductDescription: ProductDescription,
                ProductTypeID: ProductTypeID,
                BrandID: BrandID,
                SkintypeID: SkintypeID,
            },
            success: function (response) {
                response = response.trim();
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Product Successfully Updated',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else {
                    butterup.toast({
                        message: 'Changes Not Saved!!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            }
        });
    });

    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            FeatchImage: true,
            ImageUrl: true,
            ID: ID,
        },
        dataType: "json",
        success: function (Data) {
            let fileObjects = Data.map(element => {
                let blob = new Blob([element], { type: 'image/jpeg' });
                let file = new File([blob], element, {
                    type: 'databaseimage',
                    createdAt: Date.now(),
                });

                return file;
            });
            files.push(...fileObjects);
            FeatchRowID();
            setTimeout(() => {
                showImages();
            }, 300);
        }
    });
    function FeatchRowID() {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                FeatchImage: true,
                RowID: true,
                ID: ID,
            },
            dataType: "json",
            success: function (Data) {
                RowID = [];
                Data.forEach(element => {
                    RowID.push(element);
                });
                showImages();
            }
        });
    }


    $('.update-images').click(function (e) {
        let form = document.getElementById("uploadForm");
        let formData = new FormData($(form)[0]);
        formData.append('ProductID', ID);
        formData.append('UpdateImages', true);
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                response = response.trim();
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Image Successfully Updated',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else {
                    butterup.toast({
                        message: 'Changes Not Saved!!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });
    });

    $(document).on('change', '.custom-checkbox', function () {
        let SkintypeValue = [];
        SkintypeID = [];
        $(this).closest('.select-skin-type').find(".custom-checkbox:checked").each(function () {
            SkintypeValue.push($(this).val());
            SkintypeID.push($(this).data("categoryid"));
        });
        if(SkintypeID.length>0){
            $(this).closest('.select-skin-type').find('.SelectedText').text(SkintypeValue.join(', '));
        }else{
            $(this).closest('.select-skin-type').find('.SelectedText').text('Select Skin Type');
        }
    });
    $(window).click(function (event) {
        if (!$(event.target).closest('.select-skin-type').length) {
            $('.select-skin-type .option-tag').removeClass('active');
        }
    });
    

});



