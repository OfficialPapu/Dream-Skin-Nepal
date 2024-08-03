$(document).ready(function () {
    function appendProductRow(element) {
        let newRow = $("<tr>").addClass("product-box");
        let imageTitleCell = $("<td>").addClass("product-image-title");
        let imageElement = $("<img>").attr("src", element['ProductImage']).attr("alt", "");
        let titleText = element["Product Title"];
        let titleElement = $("<p>").addClass("product-title").text(titleText);
        newRow.append($("<td>").addClass("custom-product-id").text("#"+element["CustomID"]));
        imageTitleCell.append(imageElement).append(titleElement);
        newRow.append(imageTitleCell);
        newRow.append($("<td>").text("Rs. " + element["Product Price"] + ".00"));
        newRow.append($("<td>").text(element["Product Quantity"]));

        let actionCell = $("<td>");
        let actionData = $("<div>").addClass("action-data");
        let editBox = $("<div>").addClass("edit-box").html('<a href="Admin/Edit Product.php?ProductID=' + element["ProductID"] + '"><i class="fa-regular fa-pen-to-square"></i></a>');
        actionData.append(editBox);
        actionCell.append(actionData);
        newRow.append(actionCell);
        $(".table-body").append(newRow);
    }

    $('.search').keyup(function (e) {
        let searchVal = $(this).val().trim().toLowerCase();
        if (searchVal !== '') {
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Configuration/Common Function.php",
                data: { LiveSearch: true, searchTerm: searchVal },
                dataType: "json",
                success: function (response) {
                    $(".table-body").empty();
                    if (response.hasOwnProperty("message") && response.message === "No data found") {
                        $(".table-body").append("<tr><td colspan='4' class='product-not-found'>Product not found</td></tr>");
                    } else {
                        response.forEach(element => {
                            appendProductRow(element);
                        });
                    }
                }
            });
        } 
    });

});
