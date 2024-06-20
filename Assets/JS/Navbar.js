let toggle_name = document.getElementsByClassName('toggle-name');
let sub_category_dorpdown_menu = document.getElementsByClassName('sub-category-dorpdown-menu');
let plus_minus_box = document.getElementsByClassName('plus-minus-box');
let screenwidth = window.innerWidth;
let redirect_to_account = document.getElementsByClassName("redirect-to-account");

$('#account-btn-icon').click(function (e) {
    if (screenwidth > 860) {
        window.location.href = 'Account/UserAccount/My Account.php';
    }
    else {
        window.location.href = 'Assets/Components/Left Navbar.php';
    }
});


let redirect = () => {
    if (screenwidth > 860) {
        window.location.href = 'Account/UserAccount/My Account.php';
    }
    else {
        window.location.href = 'Assets/Components/Left Navbar.php';
    }
}


let GetCartValue = () => {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            CheckDataLoad: true,
        },
        success: function (response) {
            if (response > 0) {
                $('.cart-number').text(response);
                GetCartValue();
            } else if (response == 0) {
                $('.cart-number').text(0);
                GetCartValue();
            }
        }
    });
}

let GetWishlistValue = () => {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            WishlistDataLoad: true,
        },
        success: function (response) {
            if (response > 0) {
                $('.wishlist-number').text(response);
                GetWishlistValue();
            } else if (response == 0) {
                $('.wishlist-number').text(0);
                GetWishlistValue();
            }
        }
    });
}


$(document).ready(function () {
    GetCartValue();
    GetWishlistValue();
    $('.dropdown-align').click(function (e) {
        $(this).find('.sub-category-dorpdown-menu').toggleClass('active');
        $(this).find('.plus-minus-box').toggleClass('active');
        $('.sub-category-dorpdown-menu').not($(this).find('.sub-category-dorpdown-menu')).removeClass('active');
        $('.plus-minus-box').not($(this).find('.plus-minus-box')).removeClass('active');
    });
});

let TimeLine = gsap.timeline();

TimeLine.pause();
TimeLine.to(".dropdown-menu-container", {
    x: 0,
    duration: 0.2,
})
gsap.matchMedia().add("(max-width: 1030px)", () => {
    TimeLine.from(".dropdown-menu-ul li.dropdown-align", {
        x: 100,
        opacity: 0,
        stagger: 0.2,
    });
});
$('.menu, .close').click(function (e) {
    if ($(this).hasClass("menu")) {
        $(this).removeClass("bx-menu-alt-righ menu");
        $(this).addClass("bx-x close");
        $('body').addClass('active');
        TimeLine.play();
    } else if ($(this).hasClass("close")) {
        $('body').removeClass("active");
        $(this).removeClass("bx-x close");
        $(this).addClass("bx-menu-alt-righ menu");
        TimeLine.reverse();
    }

});
gsap.from(".social-links-nav-bar a i", {
    y: -30,
    delay: 1,
})

// gsap.matchMedia().add("(min-width: 1030px)", () => {
//     gsap.from(".dropdown-menu-ul li.dropdown-align", {
//         y: -40,
//         opacity: 0,
//         stagger: 0.2,
//     });
// });

$(document).on('keydown', function(event) {
    if (event.which === 13) { 
       let SearchInput=$('#Search').val();
       $('#Search').val('');
       window.location.href=`Assets/PHP/Database/SearchProduct.php?Search=${SearchInput}`;
    }
});   