$(document).ready(function () {
    $(".product-box").click(function (e) {
        e.preventDefault();
        
        var $this = $(this);
        var $iconBox = $this.find('.selected-icon-box');

        if ($iconBox.length) {
            gsap.to($iconBox, {
                y:-10,
                x:-10,
                opacity:0,
                duration: 0.1,
                onComplete: function () {
                    $iconBox.remove(); 
                }
            });
            $this.toggleClass("border border-[#00adef]");
        } else {
            $this.prepend(`<div class='bg-[#00adef] text-white absolute -bottom-[.1px] -right-[1px] [clip-path:polygon(100%_0%,_0%_100%,_100%_100%)] rounded-br-[3px] w-[60px] h-[60px] grid place-items-center selected-icon-box'>
                <i class='bx bx-check absolute bottom-[0px] right-[5px] text-2xl'></i>
            </div>`);
            gsap.from($this.find('.selected-icon-box').last(), {
                y: 10,
                x:10,
                opacity: 0,
                duration: 0.1,
            });
            
            $this.toggleClass("border border-[#00adef]");
        }
    });
});
