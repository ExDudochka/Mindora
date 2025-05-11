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

        const qText = card.querySelector('.q-text');
        const qType = card.querySelector('.q-type');
        const optsWrap = card.querySelector('.options-wrap');

        qText.name = `questions[${qCount}][content]`;
        qType.name = `questions[${qCount}][type]`;

        // Обработчик изменения типа вопроса
        qType.addEventListener('change', () => {
            const isText = qType.value === 'text';
            optsWrap.style.display = isText ? 'none' : 'flex';

            // Переключение всех input[type] внутри options
            optsWrap.querySelectorAll('.opt-correct').forEach(input => {
                input.type = qType.value === 'single' ? 'radio' : 'checkbox';
                input.name = `questions[${qCount}][options][${input.dataset.index}][correct]`;
            });
        });

        // Добавление варианта
        card.querySelector('.add-option').addEventListener('click', () => {
            const oClone = oTpl.content.cloneNode(true);
            const item = oClone.querySelector('.option-item');
            const idx = optsWrap.children.length;

            // Назначаем data-index
            const textInput = item.querySelector('.opt-text');
            const correctInput = item.querySelector('.opt-correct');

            textInput.name = `questions[${qCount}][options][${idx}][text]`;
            correctInput.dataset.index = idx;
            correctInput.type = qType.value === 'single' ? 'radio' : 'checkbox';
            correctInput.name = qType.value === 'single'
                ? `questions[${qCount}][correct]`   // одинаковое имя — один radio
                : `questions[${qCount}][options][${idx}][correct]`; // разные имена — много checkbox

            item.querySelector('.remove-option').addEventListener('click', () => {
                item.remove();
                renumberQuestions(); // пересчёт индексов
            });

            optsWrap.appendChild(item);
        });

        // Удаление вопроса
        card.querySelector('.remove-question').addEventListener('click', () => {
            card.remove();
            renumberQuestions();
        });

        wrap.appendChild(card);

        if (qType.value !== 'text') {
            card.querySelector('.add-option').click();
        }
    }

    function renumberQuestions() {
        qCount = 0;
        wrap.querySelectorAll('.question-card').forEach((card, index) => {
            qCount = index + 1;
            card.querySelector('.q-num').textContent = qCount;

            const qText = card.querySelector('.q-text');
            const qType = card.querySelector('.q-type');

            qText.name = `questions[${qCount}][content]`;
            qType.name = `questions[${qCount}][type]`;

            card.querySelectorAll('.option-item').forEach((item, optIdx) => {
                const optText = item.querySelector('.opt-text');
                const optCorrect = item.querySelector('.opt-correct');

                optText.name = `questions[${qCount}][options][${optIdx}][text]`;
                optCorrect.name = `questions[${qCount}][options][${optIdx}][correct]`;
                optCorrect.dataset.index = optIdx;
                optCorrect.type = qType.value === 'single' ? 'radio' : 'checkbox';
            });
        });
    }

    document.getElementById('add-question').addEventListener('click', addQuestion);
    addQuestion();

    document.querySelector('.new-test-form').addEventListener('submit', (e) => {
        const questions = wrap.querySelectorAll('.question-card');
        if (questions.length === 0) {
            e.preventDefault();
            alert('Добавьте хотя бы один вопрос!');
            return;
        }

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
