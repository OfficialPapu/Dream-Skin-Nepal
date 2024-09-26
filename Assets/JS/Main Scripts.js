$(document).ready(function () {
setTimeout(function () {
    document.querySelector('.whatsapp').classList.add('show-whatsapp');
}, 2000);

    // $('.bottom-top-navbar').prepend(` <div class="search-box-navbar">
    //             <input type="text" placeholder="Search..." id="Search" />
    //             <div class="icon-box">
    //                 <i class='bx bx-search-alt-2'></i>
    //             </div>
    //         </div>`);

            $('#Search').on('keydown', function(event) {
                if (event.which === 13) { 
                   let SearchInput=$('#Search').val();
                   $('#Search').val('');
                   window.location.href=`Assets/PHP/Database/SearchProduct.php?Search=${SearchInput}`;
                }
            });   


    let loadedCategories = 2; 
$(window).scroll(function() {
    const triggerPoint = $(window).height() * 1.5;
    if ($(window).scrollTop() >= triggerPoint) {
        loadMoreCategories(); 
    }
});

function loadMoreCategories() {
    $.ajax({
        url: 'Assets/PHP/Configuration/Home Page Config.php',
        type: 'POST',
        data: { 
            FirstCategory:true,
            loadedCategories: loadedCategories 
        },
        success: function(response) {
            $('#FirstCategory').append(response);
        }
    });
    loadedCategories += 2; 
}

});
