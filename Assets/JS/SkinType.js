$(document).ready(function () {
    function StoreSelectedProduct(Category, ProductID) {
        let selectedProducts = JSON.parse(localStorage.getItem("selectedProducts")) || {};

        if (selectedProducts[ProductID] === Category) {
            delete selectedProducts[ProductID];
        } else {
            for (let id in selectedProducts) {
                if (selectedProducts[id] === Category) {
                    delete selectedProducts[id];
                }
            }
            selectedProducts[ProductID] = Category;
        }

        localStorage.setItem("selectedProducts", JSON.stringify(selectedProducts));
    }

    function GetSelectedProducts() {
        return JSON.parse(localStorage.getItem("selectedProducts")) || {};
    }

    function UpdateProductSelection() {
        let selectedProducts = GetSelectedProducts();
        let categoryName = $(".product-main-container-brands").data("category-name");

        $(".product-box").each(function () {
            let $this = $(this);
            let ProductID = $this.data("product-id");
            let isSelected = selectedProducts[ProductID] === categoryName;

            if (isSelected) {
                $this.attr("data-selected", "1");
                if ($this.find(".selected-icon-box").length === 0) {
                    $this.prepend(`<div class='bg-[#00adef] text-white absolute -bottom-[.1px] -right-[1px] [clip-path:polygon(100%_0%,_0%_100%,_100%_100%)] rounded-br-[3px] w-[60px] h-[60px] grid place-items-center selected-icon-box'>
                        <i class='bx bx-check absolute bottom-[0px] right-[5px] text-2xl'></i>
                    </div>`);
                }
                $this.addClass("!border-[#00adef]");
            } else {
                $this.attr("data-selected", "0");
                $this.find(".selected-icon-box").remove();
                $this.removeClass("!border-[#00adef]");
            }
        });
    }

    $(document).on("click", ".product-box", function (e) {
        e.preventDefault();
        var $this = $(this);
        let CategoryName = $(".product-main-container-brands").data("category-name");
        let ProductID = $this.data("product-id");
        StoreSelectedProduct(CategoryName, ProductID);
        UpdateProductSelection();
        UpdateInfo();
    });

   
   
    function UpdateInfo() {
        let selectedProducts = GetSelectedProducts();
        let productIds = Object.keys(selectedProducts);
        if (productIds.length === 0) {
            $(".hide-box").html("Please Select at least one product");
        } else {
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Configuration/Common Function.php",
                data: {
                    UpdatePriceInfo: true,
                    productIds: productIds,
                },
                success: function (response) {
                    let TotalPrice = parseFloat(response.trim());
                    let DiscountPercentage = productIds.length;
                    let DiscountAmount = Math.round((TotalPrice / 100) * DiscountPercentage);
                    let DiscountPrice = Math.round(TotalPrice - DiscountAmount);
                    const NumberFormatter = new Intl.NumberFormat("en-US");
                    const FormattedTotalPrice = NumberFormatter.format(TotalPrice.toFixed(2));
                    const FormattedDiscountAmount = NumberFormatter.format(DiscountAmount);
                    const FormattedDiscountPrice = NumberFormatter.format(DiscountPrice.toFixed(2));
                    if (DiscountPercentage >= 2) {
                        $(".hide-box").html(`<div class="flex items-center gap-4">
                            <div class="text-4xl font-bold text-[#ff007f]" id="DiscountPrice">Rs. ${FormattedDiscountPrice}</div>
                            <div class="text-2xl font-bold text-[#00adef] line-through" style="text-decoration-color:#ff007f; -webkit-text-decoration-color:#ff007f;" id="TotalPrice">Rs. ${FormattedTotalPrice}</div>
                            <div class="bg-[#ff007f] text-white px-3 py-1 rounded-full text-sm font-medium" id="DiscountPercentage">${DiscountPercentage}% OFF</div>
                        </div>
                        <p class="text-[#6e6e76]">You're saving <span class="font-bold text-[#00adef]" id="SavedAmount">Rs. ${FormattedDiscountAmount}</span> on this purchase!</p>`);
                    }else{
                        $(".hide-box").html(`<div class="flex items-center gap-4">
                            <div class="text-4xl font-bold text-[#ff007f]" id="DiscountPrice">Rs. ${FormattedDiscountPrice}.00</div>
                            </div>`);

                    }
                },
            });
        }
    }
    function ListProduct(ProductTypeID) {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                GetProducts: true,
                ProductTypeID: ProductTypeID,
            },
            success: function (response) {
                gsap.to(".product-main-container-brands", {
                    onComplete: function () {
                        $(".product-main-container-brands").html(response);
                        UpdateProductSelection();
                        gsap.from(".product-main-container-brands", {
                            x: 400,
                            duration: 0.3,
                            opacity: 0,
                        });
                    }
                });
            },
        });
    }
    gsap.from(".offer-summary", {
        y: -50,
        opacity: 0,
        duration: 0.2,
        scrollTrigger: {
            trigger: ".offer-summary",
            scroller: "body",
            start: "top 90%",
            end: "top 100%",
            scrub: 1,
        },
    });
    const Categories = [
        { name: "Moisturizer", id: 100 },
        { name: "Dk", id: 36 },
    ];

    let currentIndex = 0;

    function loadCategory(index) {
        if (index >= 0 && index < Categories.length) {
            let category = Categories[index];
            $("#SetName").css({ opacity: 0 });
            gsap.to("#SetName", {
                opacity: 1,
                duration: 0.6,
                onComplete: function () {
                    $("#SetName").html(category.name);
                    $("title").text(`${category.name} - Dream Skin Nepal`);
                    $(".product-main-container-brands").data("category-name", category.name);
                    ListProduct(category.id);
                }
            });
            currentIndex = index;
        }
    }

    function TakeSetNameInput() {
        let selectedProducts = GetSelectedProducts();
        let productIds = Object.keys(selectedProducts);
        Swal.fire({
            title: "Enter your skintype set name",
            input: "text",
            inputAttributes: {
                autocapitalize: "off",
                placeholder: "eg. serum set",
                autocomplete: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Save",
            showLoaderOnConfirm: true,
            customClass: {
                confirmButton: 'custom-look-up-button',
                cancelButton: 'custom-cancel-button',
                input: 'custom-input rounded-lg'
            },
            preConfirm: (login) => {
                if (login === "") {
                    Swal.showValidationMessage("Skintype set name is required!");
                    return false;
                }

                return new Promise((resolve, reject) => {
                    $.ajax({
                        type: "POST",
                        url: "Assets/PHP/Configuration/Common Function.php",
                        data: {
                            StoreSkinTypeName: true,
                            SkinTypeSetName: login,
                            productIds: productIds,

                        },
                        success: function (response) {
                            response = response.trim();
                            if (response === "Success") {
                                resolve(response);
                            } else {
                                reject(response);
                            }
                        },
                        error: function (xhr, status, error) {
                            reject(error);
                        }
                    });
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Skintype Set Saved Successfully!",
                    text: "Skintype name saved",
                    icon: "success",
                    customClass: {
                        confirmButton: 'custom-success-button' 
                    }
                }).then(() => {
                    localStorage.clear();
                    window.location.href = "Category/Skin-Type-Preview.php";
                });
            }
        }).catch((error) => {
            Swal.fire({
                title: "Error!",
                text: error,
                icon: "error"
            });
        });
    }



    function loadNextCategory() {
        if (currentIndex < Categories.length - 1) {
            loadCategory(currentIndex + 1);
        } else {
            TakeSetNameInput();
        }
    }

    function loadPreviousCategory() {
        if (currentIndex > 0) {
            loadCategory(currentIndex - 1);
        }
    }

    $(document).on("click", "#Next", function () {
        loadNextCategory();
    });

    $(document).on("click", "#Previous", function () {
        loadPreviousCategory();
    });

    loadCategory(0);
    UpdateInfo();

});
