let files = [];
let ID = $('#ID').val();
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
        delimage(index);
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

    function delimage(index) {
        files.splice(index, 1);
        showImages();
    }
    function showImages() {
        let images = '';
        files.forEach((e, i) => {

            try {
                if (e['type'] == 'databaseimage') {
                    let imgSrc = typeof e === 'string' ? e : e['name'];
                    images += `<div class="image">  
                        <img src="${imgSrc}" alt="image">
                      <span class='delete-image'><i class='bx bx-x'></i></span>

                        <!-- You can include delete functionality for these images if needed -->
                    </div>`;
                } else {
                    images += `<div class="image">  
                      <img src="${URL.createObjectURL(e)}" alt="image">
                      <span class='delete-image'><i class='bx bx-x'></i></span>
                  </div>`;
                }
            } catch (error) {
                console.error('Error creating object URL for file at index ' + i + ': ', error);
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


    BrandList();
    SkinCareList();
    MakeupList();
    BodyHairCare();

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
        if(ProductTypeID==''){
              ProductTypeID=SelectedProductTypeID;
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
                BrandID: BrandID
            },
            success: function (response) {
                response=response.trim();
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
            ID: ID,
        },
        dataType: "json",
        success: function (Data) {
            let fileObjects = Data.map(element => {
                let blob = new Blob([element], { type: 'image/jpeg' });
                let file = new File([blob], element, {
                    type: 'databaseimage',
                    lastModified: Date.now(),
                });

                return file;
            });

            files.push(...fileObjects);
            showImages();

        }
    });

    // $.ajax({
    //     type: "POST",
    //     url: "Assets/PHP/Configuration/Common Function.php",
    //     data: {
    //         UpdateImages: true,
    //         ID: ID,
    //         files: JSON.stringify(files) // Serialize the files object to JSON
    //     },
    //     success: function (Data) {
    //         console.log(Data);
    //     }
    // });


});


