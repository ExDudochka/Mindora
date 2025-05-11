document.addEventListener('DOMContentLoaded', () => {
    const wrap = document.getElementById('questions-wrap');
    const qTpl = document.getElementById('tpl-question');
    const oTpl = document.getElementById('tpl-option');
    let qCount = 0;

    function addQuestion() {
        qCount++;
        const clone = qTpl.content.cloneNode(true);
        const card = clone.querySelector('.question-card');
        card.querySelector('.q-num').textContent = qCount;

        // Задаём name-атрибуты
        const qText = card.querySelector('.q-text');
        const qType = card.querySelector('.q-type');
        const optsWrap = card.querySelector('.options-wrap');

        qText.name = `questions[${qCount}][content]`;
        qType.name = `questions[${qCount}][type]`;

        // Обработчик изменения типа вопроса
        qType.addEventListener('change', () => {
            optsWrap.style.display = qType.value === 'text' ? 'none' : 'flex';
        });

        // Кнопка добавления варианта
        card.querySelector('.add-option').addEventListener('click', () => {
            const oClone = oTpl.content.cloneNode(true);
            const item = oClone.querySelector('.option-item');
            const idx = optsWrap.children.length;

            item.querySelector('.opt-text').name = `questions[${qCount}][options][${idx}][text]`;
            item.querySelector('.opt-correct').name = `questions[${qCount}][options][${idx}][correct]`;

            item.querySelector('.remove-option').addEventListener('click', () => item.remove());

            optsWrap.appendChild(item);
        });

        // Удаление вопроса
        card.querySelector('.remove-question').addEventListener('click', () => {
            card.remove();
            renumberQuestions();
        });

        wrap.appendChild(card);
        // Автоматически добавляем первый вариант для вопросов с выбором
        if (qType.value !== 'text') {
            card.querySelector('.add-option').click();
        }
    }

    function renumberQuestions() {
        qCount = 0;
        wrap.querySelectorAll('.question-card').forEach((card, index) => {
            qCount = index + 1;
            card.querySelector('.q-num').textContent = qCount;

            // Обновляем name-атрибуты
            const qText = card.querySelector('.q-text');
            const qType = card.querySelector('.q-type');

            qText.name = `questions[${qCount}][content]`;
            qType.name = `questions[${qCount}][type]`;

            // Обновляем name для вариантов ответа
            card.querySelectorAll('.opt-text').forEach((opt, optIdx) => {
                opt.name = `questions[${qCount}][options][${optIdx}][text]`;
            });

            card.querySelectorAll('.opt-correct').forEach((opt, optIdx) => {
                opt.name = `questions[${qCount}][options][${optIdx}][correct]`;
            });
        });
    }

    // Инициализация
    document.getElementById('add-question').addEventListener('click', addQuestion);
    addQuestion(); // Добавляем первый вопрос по умолчанию

    // Обработчик отправки формы для валидации
    document.querySelector('.new-test-form').addEventListener('submit', (e) => {
        const questions = wrap.querySelectorAll('.question-card');
        if (questions.length === 0) {
            e.preventDefault();
            alert('Добавьте хотя бы один вопрос!');
            return;
        }

        // Проверка, что у вопросов с выбором есть варианты
        let isValid = true;
        questions.forEach(question => {
            const type = question.querySelector('.q-type').value;
            const options = question.querySelectorAll('.option-item');

            if (type !== 'text' && options.length === 0) {
                isValid = false;
                question.classList.add('invalid');
            } else {
                question.classList.remove('invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Для вопросов с выбором должен быть хотя бы один вариант ответа!');
        }
    });
});
