<?php if(isset($_COOKIE['admin'])): ?>
<?php for($i = 0; $i < count($this->arrCurrentCompetitions); $i++): ?>
    <div class="popup" id="popup-add-result<?= $this->arrCurrentCompetitions[$i]['id_competition'] ?>">
        <div class="popup__body">
            <div class="popup__content">
                <a href="##" class="popup__close icon-clear"></a>
                <div class="popup__title">Добавление результатов</div>
                <form action="" method="POST">
                    <div class="popup__form-row">
                        <div class="popup__form-col">
                            <div class="popup__form-block">
                                <label for="name-athlete-result">Имя спортсмена *</label>
                                <input type="text" id="name-athlete-result" name="name-athlete-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="lastname-athlete-result">Фамилия спортсмена *</label>
                                <input type="text" id="lastname-athlete-result" name="lastname-athlete-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="patronymic-athlete-result">Отчество спортсмена *</label>
                                <input type="text" id="patronymic-athlete-result" name="patronymic-athlete-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="category-result">Категория *</label>
                                <input type="text" id="category-result" name="category-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="1squat-result">Присед №1</label>
                                <input type="text" id="1squat-result" name="1squat-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="2squat-result">Присед №2</label>
                                <input type="text" id="2squat-result" name="2squat-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="3squat-result">Присед №3</label>
                                <input type="text" id="3squat-result" name="3squat-result" class="popup__input" value="">
                            </div>
                        </div>
                        <div class="popup__form-col">
                            <div class="popup__form-block">
                                <label for="1press-result">Жим №1</label>
                                <input type="text" id="1press-result" name="1press-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="2press-result">Жим №2</label>
                                <input type="text" id="2press-result" name="2press-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="3press-result">Жим №3</label>
                                <input type="text" id="3press-result" name="3press-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="1rod-result">Тяга №1</label>
                                <input type="text" id="1rod-result" name="1rod-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="2rod-result">Тяга №2</label>
                                <input type="text" id="2rod-result" name="2rod-result" class="popup__input" value="">
                            </div>
                            <div class="popup__form-block">
                                <label for="3rod-result">Тяга №3</label>
                                <input type="text" id="3rod-result" name="3rod-result" class="popup__input" value="">
                            </div>
                            <input hidden type="text" name="id-competition-result" class="popup__input" value="<?= $this->arrCurrentCompetitions[$i]['id_competition'] ?>">
                            <div class="popup__form-block popup__input popup__button popup__button_center" style="background:#fff; border:none;">
                                <input type="submit" name="submit-add-result" class="popup__input popup__button popup__button_center" value="Добавить">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="error-reg"><p><?php if(isset($_SESSION['errorAddResult'])){echo $_SESSION['errorAddResult']; unset($_SESSION['errorAddResult']);}?></p></div>
            </div>
        </div>
    </div>
<?php endfor; ?>
<?php endif; ?>