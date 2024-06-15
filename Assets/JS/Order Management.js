$(document).ready(function () {
    function UpdateOrderCount(searchVal){
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Configuration/Common Function.php",
                data: { 
                    CountOrder: true,
                    searchTerm: searchVal   
                },
                success: function (response) {
                    $('#CountOrder').html(response);
                }
            });
    }
    
    $('.search').keyup(function (e) {
        let searchVal = $(this).val().trim().toLowerCase();
        if (searchVal !== '') {
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Configuration/Common Function.php",
                data: { 
                    OrderManagementLiveSearch: true,
                    searchTerm: searchVal   
                },
                success: function (response) {
                    UpdateOrderCount(searchVal);
                 $("tbody").html(response);   
                }
            });
        }
    });

});
