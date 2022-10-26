<?php

class Core
{
    protected $m;
    protected $arrCompetitions = [];
    protected $arrPopupResult = [];
    protected $arrMaxSum = [];
    protected $amountPages;
    protected $currentPage;
    protected $arrCurrentCompetitions = [];
    protected $amountCompetitionOnPage = 2;
    protected $nextPage;
    protected $prevPage;
    protected $valueUserCookie;
    protected $nameUserCookie;
    protected $infoAboutCurrentAthlete;
    protected $arrSportsCategories = [];
    protected $arrCities = [];
    protected $idCurrentSportsCategory;
    protected $arrInfoAuthorization = [];
    protected $arrInfoRegistration = [];

    public function __construct()
    {
        $this->m = new Model();
    }


    protected function setContent() {
        $this->arrCompetitions = $this->m->getContent();
    }

    protected function setPopupResult() {
        $this->arrPopupResult = $this->m->getPopupResult();
    }

    protected function setMaxSum() {
        $this->arrMaxSum = $this->m->getMaxSum($this->arrPopupResult);
    }

    protected function setAmountPages() {
        $this->amountPages = $this->m->getAmountPages($this->amountCompetitionOnPage);
    }

    protected function setCurrentPage() {
        $this->currentPage = $this->m->getCurrentPage();
    }

    protected function setCurrentCompetitions() {
        $this->arrCurrentCompetitions = $this->m->getCurrentCompetition($this->arrCompetitions, $this->currentPage, $this->amountCompetitionOnPage);
        $this->arrCurrentCompetitions = $this->m->getDateCurrentCompetition($this->arrCurrentCompetitions);
    }

    protected function setNextPage() {
        $this->nextPage = $this->m->getNextPage($this->arrCompetitions, $this->currentPage, $this->amountCompetitionOnPage);
    }

    protected function setPrevPage() {
        $this->prevPage = $this->m->getPrevPage();
    }

    protected function setValueUserCookie() {
        $this->valueUserCookie = $this->m->getValueUserCookie($this->nameUserCookie);
    }

    protected function setNameUserCookie() {
        $this->nameUserCookie = $this->m->getNameUserCookie();
    }

    protected function setInfoAboutCurrentAthlete() {
        if(isset($_COOKIE['user']))
            $this->infoAboutCurrentAthlete = $this->m->getInfoAboutCurrentAthlete();
    }

    protected function setArrSportsCategories() {
            $this->arrSportsCategories = $this->m->getArrSportsCategories();
    }

    protected function setArrCities() {
        $this->arrCities = $this->m->getArrCities();
    }

    protected function setIdCurrentSportsCategory() {
        if(!empty($this->infoAboutCurrentAthlete[0]['category']))
            $this->idCurrentSportsCategory = $this->m->getIdCurrentSportsCategory($this->infoAboutCurrentAthlete[0]['category']);
        if(!empty($_POST['sports-category-prof']))
            $this->idCurrentSportsCategory  = $_POST['sports-category-prof'];
    }

    protected function changeCompetition() {
        $this->m->changeCompetition();
    }

    protected function addNewResult() {
        $this->m->addNewResult();
    }

    protected function changeResult(){
        $this->m->changeResult();
    }

    protected function addNewQuestionnaire(){
        $this->m->addNewQuestionnaire();
    }

    protected function setArrInfoAuthorization() {
        $this->arrInfoAuthorization = $this->m->getArrInfoAuthorization();
    }
    
    protected function setArrInfoRegistration() {
        $this->arrInfoRegistration = $this->m->getArrInfoRegistration();
    }

    protected function setCurrentVars() {
        $this->setMaxSum();
        $this->setAmountPages();
        $this->setCurrentPage();
        $this->setCurrentCompetitions();
        $this->setNextPage();
        $this->setPrevPage();
        $this->setNameUserCookie();
        $this->setValueUserCookie();
        $this->setInfoAboutCurrentAthlete();
        $this->setArrSportsCategories();
        $this->setIdCurrentSportsCategory();
        $this->setArrCities();
        $this->setCompetition();
        $this->setArrInfoAuthorization();
        $this->setArrInfoRegistration();
    }

    protected function authorization() {
        if(isset($_POST['login-into']) && isset($_POST['password-into']))
            $this->m->authorization();

        if($this->m->checkCommand()) {
            $this->m->outFromProf($this->nameUserCookie, $this->valueUserCookie);
        }

        if($this->m->checkReg())
            $this->m->registration();
    }

    protected function setCompetition() {
        $this->m->setCompetition();
    }

    protected function PHPExcel() {
        $this->m->PHPExcel();
    }

    public function setBody()
    {
        $this->setContent();
        $this->setPopupResult();
        $this->setCurrentVars();
        $this->authorization();
        $this->addNewQuestionnaire();
        $this->changeCompetition();
        $this->addNewResult();
        $this->changeResult();
        $this->PHPExcel();

        require_once "view/View.php";
    }
}