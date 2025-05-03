document.addEventListener("DOMContentLoaded", function() {
    const phoneInput = document.getElementById("phone");

    // Функция форматирования из строки цифр
    function formatPhone(numbers) {
        let fmt = "+7";
        if (numbers.length > 1) {
            fmt += " (" + numbers.substring(1, 4);
            if (numbers.length >= 4) fmt += ") " + numbers.substring(4, 7);
            if (numbers.length >= 7) fmt += "-" + numbers.substring(7, 9);
            if (numbers.length >= 9) fmt += "-" + numbers.substring(9, 11);
        }
        return fmt;
    }

    let numbers = "7";
    phoneInput.value = formatPhone(numbers);

    phoneInput.addEventListener("input", function(e) {
        const raw = e.target.value.replace(/\D/g, "");
        numbers = raw.substring(0, 11);
        phoneInput.value = formatPhone(numbers);
    });

    phoneInput.addEventListener("keydown", function(e) {
        if (["Backspace","Delete","ArrowLeft","ArrowRight","Tab"].includes(e.key)) return;
        if (e.key.match(/\D/)) e.preventDefault();
    });

    phoneInput.addEventListener("keydown", function(e) {
        if (e.key !== "Backspace") return;

        e.preventDefault();

        const fmt = phoneInput.value;
        const cursor = phoneInput.selectionStart;

        let digitCount = 0;
        for (let i = 0; i < cursor; i++) {
            if (/\d/.test(fmt[i])) digitCount++;
        }

        if (digitCount <= 1) {
            phoneInput.setSelectionRange(cursor, cursor);
            return;
        }

        const removeIndex = digitCount - 1;
        numbers = numbers.slice(0, removeIndex) + numbers.slice(removeIndex + 1);

        const newFmt = formatPhone(numbers);
        phoneInput.value = newFmt;

        let newPos = 0, dc = 0;
        while (newPos < newFmt.length && dc < removeIndex) {
            if (/\d/.test(newFmt[newPos])) dc++;
            newPos++;
        }
        phoneInput.setSelectionRange(newPos, newPos);
    });

    // Функция уведомления о несовпадении паролей при регистрации
    document.querySelector("form").addEventListener("submit", function(e) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

        if (password !== confirmPassword) {
            e.preventDefault(); // отменяем отправку формы
            alert("Пароли не совпадают"); // или покажи кастомное уведомление
        }
    });
});
