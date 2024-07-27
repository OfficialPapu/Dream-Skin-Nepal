$(document).ready(function () {
    function StoreSelectedProduct(Category, ProductID) {
        let selectedProducts = JSON.parse(localStorage.getItem('selectedProducts')) || {};
        selectedProducts[Category] = ProductID;
        localStorage.setItem('selectedProducts', JSON.stringify(selectedProducts));
    }

    $(document).on('click', '.product-box', function (e) {
        e.preventDefault();
        var $this = $(this);
        var $iconBox = $this.find('.selected-icon-box');
        let CategoryName = $(".product-main-container-brands").data("category-name");
        StoreSelectedProduct(CategoryName, $(this).data("product-id"));
        $(".product-box[data-selected='1']").each(function () {
            if (this !== $this[0]) {
                $(this).toggleClass("!border-[#00adef]");
                $(this).attr("data-selected", "0");
                let $iconBoxOther = $(this).find('.selected-icon-box');
                if ($iconBoxOther.length) {
                    gsap.to($iconBoxOther, {
                        y: -10,
                        x: -10,
                        opacity: 0,
                        duration: 0.1,
                        onComplete: function () {
                            $iconBoxOther.remove();
                        }
                    });
                }
            }
        });

        if ($iconBox.length) {
            $this.attr("data-selected", "0");
            gsap.to($iconBox, {
                y: -10,
                x: -10,
                opacity: 0,
                duration: 0.1,
                onComplete: function () {
                    $iconBox.remove();
                }
            });
            $this.toggleClass("!border-[#00adef]");
        } else {
            $this.attr("data-selected", "1");
            $this.prepend(`<div class='bg-[#00adef] text-white absolute -bottom-[.1px] -right-[1px] [clip-path:polygon(100%_0%,_0%_100%,_100%_100%)] rounded-br-[3px] w-[60px] h-[60px] grid place-items-center selected-icon-box'>
                <i class='bx bx-check absolute bottom-[0px] right-[5px] text-2xl'></i>
            </div>`);
            gsap.from($this.find('.selected-icon-box').last(), {
                y: 10,
                x: 10,
                opacity: 0,
                duration: 0.1,
            });

            $this.toggleClass("!border-[#00adef]");
        }
    });

    gsap.from(".product-main-container-brands", {
        duration: 0.3,
        scale: 0,
        y: -300
    })
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
    })

    async function ListProduct(ProductTypeID) {
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                GetProducts: true,
                ProductTypeID: ProductTypeID,
            },
            success: function (response) {
                $(".product-main-container-brands").html(response);
            }
        });
    }
    const Categories = [
        { name: "Moisturizer", id: 100 },
        { name: "BB-Creams", id: 36 },
    ];

    let currentIndex = 0;
    function loadCategory(index) {
        if (index >= 0 && index < Categories.length) {
            let category = Categories[index];
            $("#SetName").html(category.name);
            $("title").text(`${category.name} - Dream Skin Nepal`);
            $(".product-main-container-brands").data("category-name", category.name);
            ListProduct(category.id);
            currentIndex = index;
        }
    }

    function loadNextCategory() {
        if (currentIndex < Categories.length - 1) {
            loadCategory(currentIndex + 1);
        }
    }

    function loadPreviousCategory() {
        if (currentIndex > 0) {
            loadCategory(currentIndex - 1);
        }
    }

    $(document).on('click', '#Next', function (e) {
        loadNextCategory();
    });
    loadCategory(0);

    $(document).on('click', '#Previous', function (e) {
        loadPreviousCategory();
    });



});

