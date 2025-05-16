<header class="site-header">
    <div class="header-container">
        <div class="header-container__logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/light/logo.png') }}" alt="Mindora" draggable="false">
            </a>
        </div>

        <nav class="header-container__menu">
            <a href="#">Случайный тест</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Категории</a>
            </div>
        </nav>

        <div class="header-container__search">
            <button class="search-btn">
                <img src="{{ asset('images/light/search.png') }}" alt="search" draggable="false">
            </button>
            <input type="text" placeholder="Начните ввод — система подскажет">
        </div>

        <div class="header-container__actions">
            <a href="{{ route('create-new-test') }}"><button class="btn-accent">＋</button></a>
            @auth
                <!-- Пользователь авторизован -->
                <a href="{{ route('lk') }}"><button class="btn-accent" id="lk-btn">лк</button></a>
            @else
                <!-- Пользователь не авторизован -->
                <a href="{{ route('login') }}"><button class="btn-accent" id="auth-reg-btn" data-auth-trigger="auth-modal">Вход</button></a>
            @endauth
        </div>
    </div>
</header>
