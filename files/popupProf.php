<?php if(isset($_COOKIE['user'])): ?>
<div class="popup" id="popup-prof">
    <div class="popup__body">
        <div class="popup__content">
            <a href="##" class="popup__close icon-clear"></a>
            <div class="popup__title">Личный кабинет</div>
            <form action="" method="POST">
                <div class="popup__form-row">
                    <div class="popup__form-col">
                        <div class="popup__form-block">
                            <label for="name-athlete-prof">Имя спортсмена</label>
                            <input type="text" id="name-athlete-prof" name="name-athlete-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['name'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="lastname-athlete-prof">Фамилия спортсмена</label>
                            <input type="text" id="lastname-athlete-prof" name="lastname-athlete-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['lastname'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="patronymic-athlete-prof">Отчество спортсмена</label>
                            <input type="text" id="patronymic-athlete-prof" name="patronymic-athlete-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['patronymic'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="weight">Вес спортсмена</label>
                            <input type="text" id="weight" name="weight-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['weight'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="name-trainer-prof">Имя тренера</label>
                            <input type="text" id="name-trainer-prof" name="name-trainer-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['name_trainer'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="lastname-trainer-prof">Фамилия тренера</label>
                            <input type="text" id="lastname-trainer-prof" name="lastname-trainer-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['lastname_trainer'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="patronymic-trainer-prof">Отчество тренера</label>
                            <input type="text" id="patronymic-trainer-prof" name="patronymic-trainer-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['patronymic_trainer'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <a href="http://powerlift/?command=out" class="popup__input popup__button">Выйти</a>
                        </div>
                        <form action="" method="post">
                            <div class="popup__form-block popup__input popup__button popup__button_center">
                                <input type="submit" class="input-new-questionnaire" value="Скачать анкету" name="save-report">
                                <input type="text" hidden name="id-athlete-for-download-report">
                            </div>
                        </form>
                    </div>
                    <div class="popup__form-col">
                        <div class="popup__form-block">
                            <label for="city-prof">Место проживания</label>
                            <input type="text" id="city-prof" name="city-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['city'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="sports-category-prof">Разряд по спорту</label>
                            <div class="new-select-style-wpandyou">
                                <select name="sports-category-prof">
                                    <?php for($i = 0; $i < count($this->arrSportsCategories); $i++): ?>
                                    <?php if($i === 0): ?>
                                        <option value="<?= $this->infoAboutCurrentAthlete[0]['category']?>"><?= $this->infoAboutCurrentAthlete[0]['category']?></option>
                                    <?php endif; ?>
                                    <?php if($this->arrSportsCategories[$i]['id_sports_category'] !== $this->idCurrentSportsCategory): ?>
                                        <option value="<?=$this->arrSportsCategories[$i]['name']?>"><?= $this->arrSportsCategories[$i]['name']?></option>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="popup__form-block">
                            <label for="weight-squat-prof">Вес на 1 подход присед</label>
                            <input type="text" id="weight-squat-prof" name="weight-squat-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['max_squat'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="weight-rod-prof">Вес на 1 подход тяги</label>
                            <input type="text" id="weight-rod-prof" name="weight-rod-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['max_rod'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="weight-press-prof">Вес на 1 подход жима</label>
                            <input type="text" id="weight-press-prof" name="weight-press-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['max_press'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="max-sum-prof">Максимальная сумма</label>
                            <input type="text" id="max-sum-prof" disabled name="max-sum-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['max_sum'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <label for="name-team-prof">Название команды</label>
                            <input type="text" id="name-team-prof" name="name-team-prof" class="popup__input" value="<?= $this->infoAboutCurrentAthlete[0]['name_team'] ?>">
                        </div>
                        <div class="popup__form-block">
                            <input type="submit" name="submit-change-prof" class="popup__input popup__button" value="Сохранить изменения">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>