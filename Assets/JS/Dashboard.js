$(document).ready(function () {
    TotalOrders();
    Todaysale();
    TotalProduct();
});

function formatPrice(price) {
  return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function Todaysale() {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            TodaySalePrice: true,
        },
        success: function (response) {
            response=response.trim();
            response = formatPrice(response);
            let TodaySale;
            if(response !=0 ){
            TodaySale = "Rs. " + response;
            }else{
            TodaySale = "Rs. "+ response;
            }
            $('#TodaySalesPrice').html(TodaySale);
        }
    });
}

function TotalOrders() {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            TotalOrders: true,
        },
        success: function (response) {
            $('#TotalOrder').html(response);
        }
    });
}

function TotalProduct() {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            TotalProduct: true,
        },
        success: function (response) {
            $('#TotalProduct').html(response);
        }
    });
}


function handleOptionSelection(selectedOption) {
    $('.SelectedText').html(selectedOption.html().trim());
    $('.option-list').removeClass('selected');
    selectedOption.addClass('selected');
    let ShortType = $(selectedOption).data('shorttype');
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            FilterByDate: true,
            ShortType: ShortType,
        },
        success: function (response) {
            $('.product-report-order-container').html(response);
        }
    });
}

$('.option-tag').click(function (e) {
    $(this).toggleClass('active');
});

$('.option-list').click(function (e) {
    let selectedOption = $(this);
    handleOptionSelection(selectedOption);
    currentSelectedIndex = $('.option-list').index(selectedOption);
});