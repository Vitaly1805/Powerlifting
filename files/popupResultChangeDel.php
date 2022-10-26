<?php if(isset($_COOKIE['admin'])): ?>
    <?php for($i = 0; $i < count($this->arrPopupResult); $i++): ?>
        <div class="popup" id="popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
            <div class="popup__body">
                <div class="popup__content">
                    <a href="##" class="popup__close icon-clear"></a>
                    <div class="popup__title">Редактирование результата</div>
                    <form action="" method="POST">
                        <div class="popup__form-row">
                            <div class="popup__form-col">
                                <div class="popup__form-block">
                                    <label for="name-athlete-change-result">Имя спортсмена *</label>
                                    <input type="text" id="name-athlete-change-result" name="name-athlete-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['name'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="lastname-athlete-change-result">Фамилия спортсмена *</label>
                                    <input type="text" id="lastname-athlete-change-result" name="lastname-athlete-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['lastname'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="patronymic-athlete-change-result">Отчество спортсмена *</label>
                                    <input type="text" id="patronymic-athlete-change-result" name="patronymic-athlete-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['patronymic'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="category-change-result">Категория *</label>
                                    <input type="text" id="category-change-result" name="category-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['category'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="1squat-change-result">Присед №1</label>
                                    <input type="text" id="1squat-change-result" name="1squat-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['t1'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="2squat-change-result">Присед №2</label>
                                    <input type="text" id="2squat-change-result" name="2squat-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['t2'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="3squat-change-result">Присед №3</label>
                                    <input type="text" id="3squat-change-result" name="3squat-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['t3'] ?>">
                                </div>
                                <div class="popup__form-block popup__input popup__button popup__button_center" style="background:#fff; border:none;">
                                    <input type="submit" name="submit-del-result" class="popup__input popup__button popup__button_center" value="Удалить результат">
                                </div>
                            </div>
                            <div class="popup__form-col">
                                <div class="popup__form-block">
                                    <label for="1press-change-result">Жим №1</label>
                                    <input type="text" id="1press-change-result" name="1press-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['p1'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="2press-change-result">Жим №2</label>
                                    <input type="text" id="2press-change-result" name="2press-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['p2'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="3press-change-result">Жим №3</label>
                                    <input type="text" id="3press-change-result" name="3press-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['p3'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="1rod-change-result">Тяга №1</label>
                                    <input type="text" id="1rod-change-result" name="1rod-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['g1'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="2rod-change-result">Тяга №2</label>
                                    <input type="text" id="2rod-change-result" name="2rod-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['g2'] ?>">
                                </div>
                                <div class="popup__form-block">
                                    <label for="3rod-change-result">Тяга №3</label>
                                    <input type="text" id="3rod-change-result" name="3rod-change-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['g3'] ?>">
                                </div>
                                <input hidden type="text" name="1squat-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idp1'] ?>">
                                <input hidden type="text" name="2squat-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idp2'] ?>">
                                <input hidden type="text" name="3squat-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idp3'] ?>">
                                <input hidden type="text" name="1press-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idg1'] ?>">
                                <input hidden type="text" name="2press-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idg2'] ?>">
                                <input hidden type="text" name="3press-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idg3'] ?>">
                                <input hidden type="text" name="1rod-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idt1'] ?>">
                                <input hidden type="text" name="2rod-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idt2'] ?>">
                                <input hidden type="text" name="3rod-change-result-id" class="popup__input" value="<?= $this->arrPopupResult[$i]['idt3'] ?>">
                                <input hidden type="text" name="id-competition-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['id'] ?>">
                                <input hidden type="text" name="id-questionnaire-result" class="popup__input" value="<?= $this->arrPopupResult[$i]['id_questionnaire'] ?>">
                                <div class="popup__form-block popup__input popup__button popup__button_center" style="background:#fff; border:none; margin: 115px 0 0 0;">
                                    <input type="submit" name="submit-change-result" class="popup__input popup__button popup__button_center" value="Сохранить изменения">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="error-reg"><p><?php if(isset($_SESSION['errorChangeResult'])){echo $_SESSION['errorChangeResult']; unset($_SESSION['errorChangeResult']);}?></p></div>
                </div>
            </div>
        </div>
    <?php endfor; ?>
<?php endif; ?>
