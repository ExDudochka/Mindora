<!-- Модалка авторизации -->
<div id="auth-modal" class="modal micromodal-slide" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1">
        <div class="modal__container auth-modal" role="dialog" aria-modal="true" aria-labelledby="auth-modal-title">
            <button class="modal__close" aria-label="Close modal" data-micromodal-close>×</button>
            <div class="auth-content">
                <p class="sign" id="auth-modal-title">Авторизация</p>
                <form class="form1">
                    <label for="username" class="label">Логин:</label>
                    <input class="input" type="text" placeholder="Логин" id="username" required />

                    <label for="auth_password" class="label">Пароль:</label>

                    <input class="pass" type="password" placeholder="Пароль" id="auth_password" required />


                    <button class="submit" id="auth-submit">Войти</button>

                    <div class="auth-links-container">
                        <p class="create_new"><a href="#" id="to-register">Нет аккаунта?</a></p>
                        <p class="forgot"><a href="#">Забыли пароль?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Модалка регистрации -->
<div id="register-modal" class="modal micromodal-slide" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1">
        <div class="modal__container auth-modal" role="dialog" aria-modal="true" aria-labelledby="register-modal-title">
            <button class="modal__close" aria-label="Close modal" data-micromodal-close>×</button>
            <div class="auth-content">
                <p class="sign" id="register-modal-title">Регистрация</p>
                <form class="form1">
                    <label class="label">Имя:</label>
                    <input class="input" type="text" placeholder="Имя" required />

                    <label class="label">Фамилия:</label>
                    <input class="input" type="text" placeholder="Фамилия" required />

                    <label class="label">Отчество:</label>
                    <input class="input" type="text" placeholder="Отчество" required />

                    <label class="label">Логин:</label>
                    <input class="input" type="text" placeholder="Логин" required />

                    <label class="label">Email:</label>
                    <input class="input" type="email" placeholder="email@example.com" required />

                    <label for="reg_pass" class="label">Пароль:</label>
                    <input class="pass" type="password" placeholder="Пароль" id="reg_pass" required />

                    <label for="reg_pass_repeat" class="label">Повторите пароль:</label>
                    <input class="pass" type="password" placeholder="Повторите пароль" id="reg_pass_repeat" required />


                    <button class="submit" id="register-submit">Зарегистрироваться</button>

                    <div class="auth-links-container">
                        <p class="create_new"><a href="#" id="to-login">Есть аккаунт?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
