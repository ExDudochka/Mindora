<header class="site-header">
    <div class="header-container">
        <div class="header-container__logo">
            <a href="#">
                <img src="{{ asset('images/light/logo.png') }}" alt="Mindora" draggable="false">
            </a>
        </div>

        <nav class="header-container__menu">
            <a href="#">Случайный тест</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Дисциплины</a>
            </div>
        </nav>

        <div class="header-container__search">
            <button class="search-btn">
                <img src="{{ asset('images/light/search.png') }}" alt="search" draggable="false">
            </button>
            <input type="text" placeholder="Начните ввод — система подскажет">
        </div>

        <div class="header-container__actions">
            <button class="btn-add-object">＋</button>
            <button class="btn-primary">Вход</button>
        </div>
    </div>
</header>
