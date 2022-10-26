<?php if(isset($_COOKIE['admin'])): ?>
<?php if(!empty($this->arrCurrentCompetitions)): ?>
<?php for($j = 0; $j < count($this->arrCurrentCompetitions); $j++):?>
<div class="popup" id="popup-change-competition<?= $this->arrCurrentCompetitions[$j]['id_competition'] ?>">
    <div class="popup__body">
        <div class="popup__content">
            <a href="##" class="popup__close icon-clear"></a>
            <div class="popup__title">Добавить соревнование</div>
            <form action="" method="POST">
                <div class="popup__form-row">
                    <div class="popup__form-col">
                        <div class="popup__form-block">
                            <label for="name-competition-change">Название соревнования</label>
                            <input type="text" id="name-competition-change" name="name-competition-change" class="popup__input" placeholder="Введите название" value="<?= $this->arrCurrentCompetitions[$j]['name'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="description-competition-change">Описание соревнования</label>
                            <input type="text" id="description-competition-change" name="description-competition-change" class="popup__input" placeholder="Введите описание" value="<?= $this->arrCurrentCompetitions[$j]['description'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="date-change">Дата начала соревнования</label>
                            <input type="text" id="date-change" name="date-change" class="popup__input" placeholder="Введите дату начала (2000-12-01)" value="<?= $this->arrCurrentCompetitions[$j]['date'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="time-change">Время начала соревнования</label>
                            <input type="text" id="time-change" name="time-change" class="popup__input" placeholder="Введите время (00:00)" value="<?= $this->arrCurrentCompetitions[$j]['time'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <input type="submit" name="submit-competition-del"
                                   class="popup__input popup__button popup__button_center"
                                   value="Удалить соревнование">
                        </div>
                        <div class="popup__form-block popup__input popup__button popup__button_center">
                            <a href="##">Отменить действие</a>
                        </div>
                    </div>
                    <div class="popup__form-col">
                        <div class="popup__form-block">
                            <label for="name-judge-change">Имя судьи</label>
                            <input type="text" id="name-judge-change" name="name-judge-change" class="popup__input" placeholder="Введите имя" value="<?= $this->arrCurrentCompetitions[$j]['name_judge'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="lastname-judge-change">Фамилия судьи</label>
                            <input type="text" id="lastname-judge-change" name="lastname-judge-change" class="popup__input" placeholder="Введите фамилию"  value="<?= $this->arrCurrentCompetitions[$j]['lastname_judge'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="patronymic-judge-change">Отчество судьи</label>
                            <input type="text" id="patronymic-judge-change" name="patronymic-judge-change" class="popup__input" placeholder="Введите отчество" value="<?= $this->arrCurrentCompetitions[$j]['patronymic_judge'] ?>">
                        </div>
                        <input hidden type="text" name="id-change" class="popup__input" value="<?=$this->arrCurrentCompetitions[$j]['id_competition']?>">
                        <div class="popup__form-block">
                            <label for="photo-change">Выберите баннер соревнования</label>
                            <input type="file" id="photo-change" name="photo-change" class="popup__input" value="">
                        </div>
                        <div class="popup__form-block">
                            <input type="submit" name="submit-competition-change"
                                   class="popup__input popup__button popup__button_center"
                                   value="Сохранить изменения">
                        </div>
                    </div>
                </div>
            </form>
            <div class="error-reg"><p><?php if(isset($_SESSION['successMessageForChangeCompetition'])){echo $_SESSION['successMessageForChangeCompetition']; unset($_SESSION['successMessageForChangeCompetition']);}?></p></div>
        </div>
    </div>
</div>
<?php endfor; ?>
<?php endif; ?>
<?php endif; ?>
