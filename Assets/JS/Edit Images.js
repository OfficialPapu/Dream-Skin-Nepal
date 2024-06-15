let image_list_box = $('.image-list-box');
let ImageList = $('.image-list');
$(document).ready(function () {
    $('#search-image').click(function (e) {
        LoadImage();
    });

    ImageList.sortable({
        update: function (event, ui) {
            let NewImageOrder = ImageList.sortable('toArray', { attribute: 'data-metaid' });
            $('#SaveOrder').click(function (e) {
                let ID = $('#product-id').val();
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "Assets/PHP/Admin/Edit Images Config.php",
                    data: {
                        UpdateOrder: true,
                        ProductID: ID,
                        NewImageOrder: NewImageOrder,
                    },
                    success: function (response) {
                        if (response == 'Success') {
                            butterup.toast({
                                message: 'Position Updated',
                                icon: true,
                                dismissable: true,
                                type: 'success',
                            });
                        } else {
                            butterup.toast({
                                message: 'Something went wrong!!',
                                icon: true,
                                dismissable: true,
                                type: 'error',
                            });
                        }
                    }
                });
            });
        }
    });

    $(document).on('click', '.delete-image', function (e) {
        e.preventDefault();
        let ID = $('#product-id').val();
        let MetaID = $(this).closest('.image-container').attr('data-metaid');
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/Edit Images Config.php",
            data: {
                DeleteImage: true,
                ProductID: ID,
                MetaID: MetaID,
            },
            success: function (response) {
                LoadImage();
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Image Deleted',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else {
                    butterup.toast({
                        message: 'Something went wrong!!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            }
        });
    });

});



function LoadImage() {
    let ID = $('#product-id').val();
    $('.add-new-image-box').empty();
    ImageList.empty();
    if (ID != '') {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Admin/Edit Images Config.php",
            data: {
                ListImage: true,
                ID: ID,
            },
            dataType: "json",
            success: function (data) {
                if (data['Message'] != 'Invalid Request') {
                    data.forEach(item => {
                        const imageContainer = $('<div class="image-container"></div>');
                        imageContainer.attr('data-metaid', item['ID']);
                        const imageElement = $('<img>');
                        imageElement.attr('src', item['Product Meta Value']);
                        const deleteBox = $('<div class="delete-image-box"></div>');
                        const deleteButton = $('<button class="delete-image">Delete</button>');
                        deleteBox.append(deleteButton);
                        imageContainer.append(imageElement);
                        imageContainer.append(deleteBox);
                        ImageList.append(imageContainer);
                    });
                } else {
                    butterup.toast({
                        message: 'Image Not Found!!',
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
            message: 'Product ID Is Required!!',
            icon: true,
            dismissable: true,
            type: 'error',
        });
    }

    const AddImgDiv = $('<div class="add-new-image-box"></div>');
    const AddImgLabel = $('<label for="input-image">');
    const AddImgInput = $('<input type="file" id="input-image" accept="image/jpeg, image/png, image/gif">');
    const AddImgContainer = $('<div class="add-new-image-element"></div>');
    const AddImgIcon = $('<i class="bx bx-plus"></i>');
    AddImgDiv.append(AddImgLabel);
    AddImgLabel.append(AddImgInput);
    AddImgLabel.append(AddImgContainer);
    AddImgContainer.append(AddImgIcon);
    image_list_box.append(AddImgDiv);

}