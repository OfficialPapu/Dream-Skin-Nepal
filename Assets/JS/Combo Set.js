$(document).ready(function () {
    function UpdateInfo() {
        let selectedProductIds = [];
        $(".product-box[data-selected='1']").each(function () {
            let productId = $(this).attr("data-product-id");
            selectedProductIds.push(productId);
        });
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                UpdateInfo: true,
                selectedProductIds: selectedProductIds,
            },
            success: function (response) {
            }
        });
    }

    $(".product-box").click(function (e) {
        e.preventDefault();
        UpdateInfo();
        var $this = $(this);
        var $iconBox = $this.find('.selected-icon-box');

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
    $("#BuyNow").click(function (e) {
        e.preventDefault();
        let selectedProductIds = [];

        $(".product-box[data-selected='1']").each(function () {
            let productId = $(this).attr("data-product-id");
            selectedProductIds.push(productId);
        });
        if (selectedProductIds.length == 0) {
            butterup.toast({
                message: 'Select at least one product!',
                icon: true,
                dismissable: true,
                type: 'error',
            });
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                CreateComboSet: true,
                selectedProductIds: selectedProductIds,
            },
            success: function (response) {
                window.location.href = "Account/UserAccount/Cart.php";
            }
        });


    });
});