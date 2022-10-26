<?php if(isset($_COOKIE['admin'])): ?>
<div class="popup" id="popup-sor">
    <div class="popup__body">
        <div class="popup__content">
            <a href="##" class="popup__close icon-clear"></a>
            <div class="popup__title">Работа с соревнованиями</div>
            <form action="" method="POST">
                <div class="popup__form-row">
                    <div class="popup__form-col">
                        <div class="popup__form-block">
                            <label for="name-competition-reg">Название соревнования</label>
                            <input type="text" id="name-competition-reg" name="name-competition-reg" class="popup__input" placeholder="Введите название">
                        </div>
                        <div class="popup__form-block">
                            <label for="description-competition-reg">Описание соревнования</label>
                            <input type="text" id="description-competition-reg" name="description-competition-reg" class="popup__input" placeholder="Введите описание">
                        </div>
                        <div class="popup__form-block">
                            <label for="date-reg">Дата начала соревнования</label>
                            <input type="text" id="date-reg" name="date-reg" class="popup__input" placeholder="Введите дату начала (2000-12-01)">
                        </div>
                        <div class="popup__form-block">
                            <label for="time-reg">Время начала соревнования</label>
                            <input type="text" id="time-reg" name="time-reg" class="popup__input" placeholder="Введите время (00:00)">
                        </div>
                        <div class="popup__form-block popup__input popup__button popup__button_center">
                            <a href="##">Отменить действие</a>
                        </div>
                    </div>
                    <div class="popup__form-col">
                        <div class="popup__form-block">
                            <label for="name-judge-reg">Имя судьи</label>
                            <input type="text" id="name-judge-reg" name="name-judge-reg" class="popup__input" placeholder="Введите имя">
                        </div>
                        <div class="popup__form-block">
                            <label for="lastname-judge-reg">Фамилия судьи</label>
                            <input type="text" id="lastname-judge-reg" name="lastname-judge-reg" class="popup__input" placeholder="Введите фамилию">
                        </div>
                        <div class="popup__form-block">
                            <label for="patronymic-judge-reg">Отчество судьи</label>
                            <input type="text" id="patronymic-judge-reg" name="patronymic-judge-reg" class="popup__input" placeholder="Введите отчество">
                        </div>
                        <div class="popup__form-block">
                            <label for="photo-reg">Выберите баннер соревнования</label>
                            <input type="file" id="photo-reg" name="photo-reg" class="popup__input" placeholder="Введите дату начала (2000-12-01)">
                        </div>
                        <div class="popup__form-block">
                            <input type="submit" name="submit-competition-reg"
                                   class="popup__input popup__button popup__button_center"
                                   value="Добавить соревнование">
                        </div>
                    </div>
                </div>
            </form>
            <div class="error-reg"><p><?php if(isset($_SESSION['errorReg'])){echo $_SESSION['errorReg']; unset($_SESSION['errorReg']);}?></p></div>
        </div>
    </div>
</div>
<?php endif; ?>