$(document).ready(function () {
    setTimeout(function () {
        document.querySelector('.whatsapp').classList.add('show-whatsapp');
    }, 2000);

    $('#SearchInputBox').html(`<div class="search-box-navbar">
                <input type="text" id="Search" />
                <div class="icon-box">
                    <i class='bx bx-search-alt-2'></i>
                </div>
            </div>
            <p class="authentic-text-content" id="authenticText">#<span class="pink-color">Genuinely</span><span class="blue-color bold-style-text">Authentic</span></p>`);

    $(document).on('focus', '#Search', function () {
        $('#authenticText').css('opacity', '0');
    });

    $(document).on('blur', '#Search', function () {
        if ($(this).val() === '') {
            $('#authenticText').css('opacity', '1');
        }
    });

    $(document).on('click', '#authenticText', function () {
        $('#Search').focus();
    });

    $('#Search').on('keydown', function (event) {
        if (event.which === 13) {
            let SearchInput = $('#Search').val();
            $('#Search').val('');
            window.location.href = `Assets/PHP/Database/SearchProduct.php?Search=${SearchInput}`;
        }
    });


    let loadedCategories = 2;
    $(window).scroll(function () {
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
                FirstCategory: true,
                loadedCategories: loadedCategories
            },
            success: function (response) {
                $('#FirstCategory').append(response);
            }
        });
        loadedCategories += 2;
    }

});
