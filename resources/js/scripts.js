document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.lk-nav-link');
    const profileSection = document.getElementById('section-profile');
    const testsSection = document.getElementById('section-tests');

    // === Считываем сохранённый раздел из localStorage ===
    const savedSection = localStorage.getItem('activeSection') || 'profile';

    function showSection(section) {
        // Удаляем активный класс
        links.forEach(link => link.classList.remove('active'));

        if (section === 'profile') {
            profileSection.style.display = 'block';
            testsSection.style.display = 'none';
            links[0].classList.add('active');
        } else if (section === 'tests') {
            profileSection.style.display = 'none';
            testsSection.style.display = 'block';
            links.forEach(link => {
                if (link.textContent.includes('Мои тесты')) {
                    link.classList.add('active');
                }
            });
        }
    }

    // === Показываем нужный раздел при загрузке ===
    showSection(savedSection);

    // === Обработчики кликов ===
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const text = this.textContent.trim();

            // Сохраняем выбранный раздел в localStorage
            if (text.includes('Профиль')) {
                localStorage.setItem('activeSection', 'profile');
                showSection('profile');
            } else if (text.includes('Мои тесты')) {
                localStorage.setItem('activeSection', 'tests');
                showSection('tests');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('deleteModal');
    const closeBtn = document.querySelector('.modal-close');
    const cancelBtn = document.querySelector('.btn-cancel');
    const confirmBtn = document.querySelector('.btn-confirm-delete');
    const input = document.getElementById('confirmInput');
    const testTitlePlaceholder = document.getElementById('testTitlePlaceholder');

    let currentTestTitle = '';
    let currentTestId = null;

    // Навешиваем обработчики на каждую кнопку удаления
    document.querySelectorAll('.btn-delete-test').forEach(button => {
        button.addEventListener('click', () => {
            currentTestTitle = button.getAttribute('data-title').trim();
            currentTestId = button.getAttribute('data-id');

            // Обновляем текст в модалке
            testTitlePlaceholder.textContent = `"${currentTestTitle}"`;
            input.value = '';
            confirmBtn.disabled = true;
            confirmBtn.classList.remove('active');

            // Показываем модалку
            modal.classList.add('active');
        });
    });

    // Закрытие модалки
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.remove('active');
    });

    // Проверка ввода
    input.addEventListener('input', () => {
        if (input.value.trim() === currentTestTitle) {
            confirmBtn.disabled = false;
            confirmBtn.classList.add('active');
        } else {
            confirmBtn.disabled = true;
            confirmBtn.classList.remove('active');
        }
    });

    // Подтверждение удаления
    confirmBtn.addEventListener('click', () => {
        if (input.value.trim() === currentTestTitle) {
            window.location.href = `/tests/delete/${currentTestId}`;
        }
    });
});
