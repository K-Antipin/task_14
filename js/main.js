// console.log(location.href.slice(-9))

if (location.href.includes('index')) {
    document.querySelector('.bg-img').style.opacity = '.2';
    if (!document.querySelector('.sidebar')) {
        document.querySelector('.promotions__index').style.width = '100vw';
    }

    document.addEventListener('DOMContentLoaded', function () {
        let timer = document.querySelector('.timer');
        let y = document.querySelector('.timer__minutes').textContent;
        let m = document.querySelector('.timer__hours').textContent;
        let d = document.querySelector('.timer__days').textContent;
        const deadline = new Date(y, m - 1, d);
        // id таймера
        let timerId = null;
        // склонение числительных
        function declensionNum(num, words) {
            return words[
                num % 100 > 4 && num % 100 < 20
                    ? 2
                    : [2, 0, 1, 1, 1, 2][num % 10 < 5 ? num % 10 : 5]
            ];
        }
        // вычисляем разницу дат и устанавливаем оставшееся времени в качестве содержимого элементов
        function countdownTimer() {
            const diff = deadline - new Date();
            if (diff <= 0) {
                clearInterval(timerId);
                while (timer.firstChild) {
                    timer.removeChild(timer.firstChild);
                }
                timer.innerHTML =
                    '<svg viewBox="0 0 300 155" fill="none" xmlns="http://www.w3.org/2000/svg"><path xmlns="http://www.w3.org/2000/svg" fill="none" d="M0 0h300v155H0z"/></svg>';
                timer.innerHTML +=
                    '<div class="promo"><h4>С Днем рождения!!!</h4><p class="birthday__today">В честь этого, для вас персоналная скидка 5% на все услуги салона.</p></div>';
            }
            const days = diff > 0 ? Math.floor(diff / 1000 / 60 / 60 / 24) : 0;
            const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
            const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
            const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
            $days.textContent = days < 10 ? '0' + days : days;
            $hours.textContent = hours < 10 ? '0' + hours : hours;
            $minutes.textContent = minutes < 10 ? '0' + minutes : minutes;
            $seconds.textContent = seconds < 10 ? '0' + seconds : seconds;
            $days.dataset.title = declensionNum(days, ['день', 'дня', 'дней']);
            $hours.dataset.title = declensionNum(hours, [
                'час',
                'часа',
                'часов',
            ]);
            $minutes.dataset.title = declensionNum(minutes, [
                'минута',
                'минуты',
                'минут',
            ]);
            $seconds.dataset.title = declensionNum(seconds, [
                'секунда',
                'секунды',
                'секунд',
            ]);
            timer.style = 'diplay: block';
        }
    // получаем элементы, содержащие компоненты даты
    const $days = document.querySelector('.timer__days');
    const $hours = document.querySelector('.timer__hours');
    const $minutes = document.querySelector('.timer__minutes');
    const $seconds = document.querySelector('.timer__seconds');
    // вызываем функцию countdownTimer
    // countdownTimer();
    // вызываем функцию countdownTimer каждую секунду
    timerId = setInterval(countdownTimer, 1000);
});
}

if (location.href.includes('login')) {
    document.querySelector('#registration').addEventListener('click', () => {
        // window.open('./registrations.php', '_self');
        window.location.href = './registrations.php';
    });
}

document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.timer__gift')) {
        let timer = document.querySelector('.timer__gift');
        let y = document.querySelector('.timer__seconds__gift').textContent;
        let m = document.querySelector('.timer__minutes__gift').textContent;
        let d = document.querySelector('.timer__hours__gift').textContent;
        const deadline = new Date(y, m - 1, d);
        // id таймера
        let timerId = null;
        // вычисляем разницу дат и устанавливаем оставшееся времени в качестве содержимого элементов
        function countdownTimer() {
            const diff = deadline - new Date();
            if (diff <= 0) {
                clearInterval(timerId);
            }
            const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
            const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
            const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
            $hours.textContent = hours < 10 ? '0' + hours : hours;
            $minutes.textContent = minutes < 10 ? '0' + minutes : minutes;
            $seconds.textContent = seconds < 10 ? '0' + seconds : seconds;
        }
        // получаем элементы, содержащие компоненты даты
        const $hours = document.querySelector('.timer__hours__gift');
        const $minutes = document.querySelector('.timer__minutes__gift');
        const $seconds = document.querySelector('.timer__seconds__gift');
        // вызываем функцию countdownTimer
        countdownTimer();
        // вызываем функцию countdownTimer каждую секунду
        timerId = setInterval(countdownTimer, 1000);
        timer.style = 'diplay: block';
    }
});

if (document.querySelector('.birthday__close')) {
    document
        .querySelector('.birthday__close')
        .addEventListener('click', (event) => {
            event.target.parentNode.remove();
        });
}

// if (document.querySelector('.user__exists') && !location.href.includes('focus')) {
//     document.querySelector('.sign__up h2').textContent =
//         document.querySelector('.user__exists').textContent;
//         document.querySelector('.sign__up h2').style.color = 'red';
//         location.href = location.href + '#focus';
// }
// console.log(document.querySelector('.sign__up h2'));
