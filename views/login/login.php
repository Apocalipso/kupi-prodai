<main class="page-content">
    <section class="login">
        <h1 class="visually-hidden">Логин</h1>
        <form class="login__form form" action="#" method="post" enctype="multipart/form-data">
            <div class="login__title">
                <a class="login__link" href="sign-up.html">Регистрация</a>
                <h2>Вход</h2>
            </div>
            <div class="form__field login__field">
                <input type="email" name="user-email" id="user-email" class="js-field" required="">
                <label for="user-email">Эл. почта</label>
                <span>Обязательное поле</span>
            </div>
            <div class="form__field login__field">
                <input type="password" name="user-password" id="user-password" class="js-field" required="">
                <label for="user-password">Пароль</label>
                <span>Обязательное поле</span>
            </div>
            <button class="login__button btn btn--medium js-button" type="submit" disabled="">Войти</button>
            <a class="btn btn--small btn--flex btn--white" href="#">
                Войти через
                <span class="icon icon--vk"></span>
            </a>
        </form>
    </section>
</main>