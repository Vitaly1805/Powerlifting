<?php if(!empty($this->arrCurrentCompetitions)): ?>
<?php for($j = 0; $j < count($this->arrCurrentCompetitions); $j++): ?>
        <div class="popup" id="popup-result<?= $this->arrCurrentCompetitions[$j]['id_competition'] ?>">
            <div class="popup__body">
                <div class="popup__content">
                    <a href="##" class="popup__close icon-clear"></a>
                    <div class="popup__table">
                        <div class="popup__table-row">
                            <div class="popup__table-col">
                                ФИО
                            </div>
                            <div class="popup__table-col">
                                Вес
                            </div>
                            <div class="popup__table-col">
                                Категория
                            </div>
                            <div class="popup__table-col">
                                Разряд
                            </div>
                            <div class="popup__table-col">
                                П1
                            </div>
                            <div class="popup__table-col">
                                П2
                            </div>
                            <div class="popup__table-col">
                                П3
                            </div>
                            <div class="popup__table-col">
                                Ж1
                            </div>
                            <div class="popup__table-col">
                                Ж2
                            </div>
                            <div class="popup__table-col">
                                Ж3
                            </div>
                            <div class="popup__table-col">
                                Т1
                            </div>
                            <div class="popup__table-col">
                                Т2
                            </div>
                            <div class="popup__table-col">
                                Т3
                            </div>
                            <div class="popup__table-col">
                                Сумма
                            </div>
                        </div>
                        <?php if(!empty($this->arrPopupResult)): ?>
                            <?php for($i = 0; $i < count($this->arrPopupResult); $i++): ?>
                                <?php if($this->arrPopupResult[$i]['id'] == $this->arrCurrentCompetitions[$j]['id_competition']): ?>
                                    <div class="popup__table-row popup__table-row_back">
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['lastname'] ?> <?= $this->arrPopupResult[$i]['name'] ?>  <?= $this->arrPopupResult[$i]['patronymic'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['weight'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['category'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['name_sports_category'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['t1'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['t2'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['t3'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['p1'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['p2'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['p3'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['g1'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['g2'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrPopupResult[$i]['g3'] ?>
                                            </a>
                                        </div>
                                        <div class="popup__table-col">
                                            <a href="#popup-change-result<?= $this->arrPopupResult[$i]['id'] ?><?= $this->arrPopupResult[$i]['id_athlete'] ?>">
                                            <?= $this->arrMaxSum[$i] ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    <form action="" method="post">
                        <div class="popup__form-block popup__input popup__button popup__button_center">
                            <input type="submit" class="input-new-questionnaire" value="Скачать сетку" name="save-report">
                            <input type="text" hidden value="<?= $this->arrCurrentCompetitions[$j]['id_competition'] ?>" name="id-competition-for-download-report">
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php endfor; ?>
<?php endif; ?>