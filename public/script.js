document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById('theme-toggle');
    const root = document.documentElement;
    const timerElement = document.getElementById('timer');

    function applyTheme(theme) {
        if (theme === 'dark') {
            root.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            root.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    }

    let currentTheme = localStorage.getItem('theme') || 'light';
    applyTheme(currentTheme);

    themeToggle.addEventListener('click', function () {
        currentTheme = (currentTheme === 'light') ? 'dark' : 'light';
        applyTheme(currentTheme);
    });

    if (timerElement) {
        let timeLeft = parseInt(timerElement.dataset.time, 10);

        function updateTimer() {
            if (timeLeft > 0) {
                timeLeft--;
                timerElement.textContent = "Час залишився: " + timeLeft + " секунд";
            } else {
                window.location.href = window.location.href; // Перезавантаження сторінки
            }
        }

        setInterval(updateTimer, 1000);
    }
});
