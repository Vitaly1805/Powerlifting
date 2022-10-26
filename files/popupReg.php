<?php if(empty($this->valueUserCookie)):?>
    <div class="popup" id="popup-reg">
        <div class="popup__body">
            <div class="popup__content">
                <a href="##" class="popup__close icon-clear"></a>
                <div class="popup__title">Регистрация</div>
                <form action="" method="POST">
                    <div class="popup__form-row">
                        <div class="popup__form-col">
                            <div class="popup__form-block">
                                <label for="name-athlete-reg">Имя спортсмена</label>
                                <input type="text" id="name-athlete-reg" name="name-athlete-reg" class="popup__input" value="<?= $this->arrInfoRegistration['name-athlete-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="lastname-athlete-reg">Фамилия спортсмена</label>
                                <input type="text" id="lastname-athlete-reg" name="lastname-athlete-reg" class="popup__input" value="<?= $this->arrInfoRegistration['lastname-athlete-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="patronymic-athlete-reg">Отчество спортсмена</label>
                                <input type="text" id="patronymic-athlete-reg" name="patronymic-athlete-reg" class="popup__input" value="<?= $this->arrInfoRegistration['patronymic-athlete-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="weight-reg">Вес спортсмена</label>
                                <input type="text" id="weight-reg" name="weight-reg" class="popup__input" value="<?= $this->arrInfoRegistration['weight-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="name-trainer-reg">Имя тренера</label>
                                <input type="text" id="name-trainer-reg" name="name-trainer-reg" class="popup__input" value="<?= $this->arrInfoRegistration['name-trainer-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="lastname-trainer-reg">Фамилия тренера</label>
                                <input type="text" id="lastname-trainer-reg" name="lastname-trainer-reg" class="popup__input" value="<?= $this->arrInfoRegistration['lastname-trainer-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="patronymic-trainer-reg">Отчество тренера</label><input type="text" id="patronymic-trainer-reg" name="patronymic-trainer-reg" class="popup__input" value="<?= $this->arrInfoRegistration['patronymic-trainer-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="name-team-reg">Название команды</label>
                                <input type="text" id="name-team-reg" name="name-team-reg" class="popup__input" value="<?= $this->arrInfoRegistration['name-team-reg'] ?>">
                            </div>
                        </div>
                        <div class="popup__form-col">
                            <div class="popup__form-block">
                                <label for="city-reg">Место проживания</label>
                                <input type="text" id="city-reg" name="city-reg" class="popup__input" value="<?= $this->arrInfoRegistration['city-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label>Разряд по спорту</label>
                                <div class="new-select-style-wpandyou">
                                    <select name="sports-category-reg">
                                        <?php for($i = 0; $i < count($this->arrSportsCategories); $i++): ?>
                                        <?php if($i+1 == $this->arrInfoRegistration['sports-category-reg']): ?>
                                                <option selected="selected" value="<?=$i+1?>"><?= $this->arrCities[$i]['name']?></option>
                                        <?php endif; ?>
                                            <option value="<?=$i+1?>"><?= $this->arrCities[$i]['name']?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="popup__form-block">
                                <label for="weight-squat-reg">Вес на 1 подход присед</label>
                                <input type="text" id="weight-squat-reg" name="weight-squat-reg" class="popup__input" value="<?= $this->arrInfoRegistration['weight-squat-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="weight-rod-reg">Вес на 1 подход тяги</label>
                                <input type="text" id="weight-rod-reg" name="weight-rod-reg" class="popup__input" value="<?= $this->arrInfoRegistration['weight-rod-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="weight-press-reg">Вес на 1 подход жима</label>
                                <input type="text" id="weight-press-reg" name="weight-press-reg" class="popup__input" value="<?= $this->arrInfoRegistration['weight-press-reg'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <a href="#" class="password-control"
                                   onclick="return show_hide_password(this, 'password-reg-first');"></a>
                                <label for="password-reg-first">Пароль</label>
                                <input type="password" id="password-reg-first" name="password-reg-first" class="popup__input" value="<?= $this->arrInfoRegistration['password-reg-first'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <a href="#" class="password-control"
                                   onclick="return show_hide_password(this, 'password-reg-second');"></a>
                                <label for="password-reg-second">Подтвердите пароль</label>
                                <input type="password" id="password-reg-second" name="password-reg-second" class="popup__input" value="<?= $this->arrInfoRegistration['password-reg-second'] ?>">
                            </div>
                            <div class="popup__form-block">
                                <label for="login-reg">Логин</label>
                                <input type="text" id="login-reg" name="login-reg" class="popup__input" value="<?= $this->arrInfoRegistration['login-reg'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="popup__form-block">
                        <input type="submit" name="submit-reg" class="popup__input popup__button popup__button_center" value="Зарегистрироваться">
                    </div>
                    <div class="popup__form-block popup__input popup__button popup__button_center">
                        <a href="#popup-into">Войти</a>
                    </div>
                </form>
                <div class="error-reg"><p><?php if(isset($_SESSION['errorReg'])){echo $_SESSION['errorReg']; unset($_SESSION['errorReg']);}?></p></div>
            </div>
        </div>
    </div>
<?php endif; ?>