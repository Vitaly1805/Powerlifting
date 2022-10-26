<?php if(empty($this->valueUserCookie)): ?>
<div class="popup" id="popup-into">
    <div class="popup__body">
        <div class="popup__content">
            <a href="##" class="popup__close icon-clear"></a>
            <div class="popup__title">Авторизация</div>
            <form action="" method="POST">
                <div class="popup__form-block">
                    <label for="login-into">Логин</label>
                    <input type="text" id="login-into" name="login-into" class="popup__input" value="<?= $this->arrInfoAuthorization['login-into'] ?>">
                </div>
                <div class="popup__form-block">
                    <a href="#" class="password-control" onclick="return show_hide_password(this, 'password-into');"></a>
                    <label for="password-into">Пароль</label>
                    <input type="password" id="password-into" name="password-into" class="popup__input"  value="<?= $this->arrInfoAuthorization['password-into'] ?>">
                </div>
                <div class="popup__form-block">
                    <input type="submit" name="submit" class="popup__button popup__input" value="Войти">
                    <div class="popup__form-block">
                        <div name="submit" class="popup__button popup__input popup__button-reg">
                            <a href="#popup-reg">Регистрация</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="error-reg"><p><?php if((!isset($_COOKIE['user']) || !isset($_COOKIE['admin'])) && isset($_POST['login-into']) && isset($_POST['password-into'])) echo 'Введен неверный логин или пароль!';?></p></div>
        </div>
    </div>
</div>
<?php endif; ?>