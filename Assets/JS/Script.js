let countDownTime = new Date('July 15, 2024 23:00:00').getTime();
setInterval(() => {
    let today = new Date().getTime();
    let difference = countDownTime - today;
    
    if (difference > 0) {
        let hours = Math.floor(difference / (1000 * 60 * 60));
        let minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((difference % (1000 * 60)) / 1000);
        
        $('.hour').html(hours + `<span class="time-info"> hrs</span>`);
        $('.minute').html(minutes + `<span class="time-info"> min</span>`);
        $('.second').html(seconds + `<span class="time-info"> sec</span>`);
        
    } else {
        $('.hour').html('00<span class="time-info"> hrs</span>');
        $('.minute').html('00<span class="time-info"> min</span>');
        $('.second').html('00<span class="time-info"> sec</span>');
    }
}, 1000);

    setTimeout(function() {
        document.querySelector('.whatsapp').classList.add('show-whatsapp');
    }, 2000);