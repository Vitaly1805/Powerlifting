<?php

class Model
{
    protected $db;
    protected $arrKeysInfoAboutAthleteReg = ['name-athlete-reg', 'lastname-athlete-reg', 'patronymic-athlete-reg', 'weight-reg', 'name-trainer-reg', 'lastname-trainer-reg', 'patronymic-trainer-reg', 'city-reg', 'sports-category-reg', 'weight-squat-reg', 'weight-rod-reg', 'weight-press-reg', 'password-reg-first', 'password-reg-second', 'login-reg', 'name-team-reg'];
    protected $arrKeysInfoAboutAthleteProf = ['name-athlete-prof', 'lastname-athlete-prof', 'patronymic-athlete-prof', 'weight-prof', 'name-trainer-prof', 'lastname-trainer-prof', 'patronymic-trainer-prof', 'city-prof', 'sports-category-prof', 'weight-squat-prof', 'weight-rod-prof', 'weight-press-prof', 'name-team-prof'];
    protected $arrKeysInfoAboutCurrentUser = ['name', 'lastname', 'patronymic', 'weight', 'name_trainer', 'lastname_trainer', 'patronymic_trainer', 'city', 'category', 'max_squat','max_rod', 'max_press', 'name_team'];
    protected $arrKeysInfoAboutCompetitionReg = ['name-competition-reg', 'description-competition-reg', 'date-reg', 'photo-reg', 'name-judge-reg', 'lastname-judge-reg', 'patronymic-judge-reg', 'time-reg'];
    protected $arrKeysInfoAboutCompetitionChange = ['name-competition-change', 'description-competition-change', 'date-change', 'name-judge-change', 'lastname-judge-change', 'patronymic-judge-change', 'time-change', 'photo-change'];
    protected $arrKeysForAddNewResult = ['name-athlete-result', 'lastname-athlete-result', 'patronymic-athlete-result', 'category-result'];
    protected $arrKeysForAddApproach = [['1squat-result', '2squat-result', '3squat-result'], ['1press-result', '2press-result', '3press-result'],['1rod-result', '2rod-result', '3rod-result']];
    protected $arrKeysForChangeResults = ['name-athlete-change-result', 'lastname-athlete-change-result', 'patronymic-athlete-change-result', 'category-change-result'];
    protected $arrKeysForChangeApproachId = ['1squat-change-result-id', '2squat-change-result-id', '3squat-change-result-id', '1rod-change-result-id', '2rod-change-result-id', '3rod-change-result-id','1press-change-result-id', '2press-change-result-id', '3press-change-result-id'];
    protected $arrKeysForChangeApproachResults = ['1press-change-result', '2press-change-result', '3press-change-result','1squat-change-result','2squat-change-result', '3squat-change-result','1rod-change-result', '2rod-change-result', '3rod-change-result'];
    protected $arrKeysForRegAthlete = ['name-athlete-reg', 'lastname-athlete-reg', 'patronymic-athlete-reg', 'name-trainer-reg', 'lastname-trainer-reg', 'patronymic-trainer-reg', 'name-team-reg', 'city-reg', 'weight-reg', 'sports-category-reg', 'weight-squat-reg', 'weight-rod-reg', 'weight-press-reg', 'password-reg-first', 'password-reg-second', 'login-reg'];
    protected $arrInfoAboutAllAthletes = [];
    protected $arrValuesInfoAboutAthleteReg = [];
    protected $arrInfoAboutAthleteReg = [];
    protected $arrInfoAboutCities = [];
    protected $arrInfoAboutTeams = [];
    protected $arrInfoAboutTrainers = [];
    protected $arrInfoAboutSportsCategories = [];
    protected $infoAboutCurrentAthlete;
    protected $CurrentPag = '';
    protected $objPHPExcel;
    protected $activeSheet;
    protected $arrPopupResult= [];

    public function __construct()
    {
        $this->db = mysqli_connect(HOST,USER,PASSWORD,DB);
        if(!$this->db)
            echo "Ошибка соединения с БД";
    }

    public function authorization() {
        $query = '';

        if(!empty($_POST['login-into']) && !empty($_POST['password-into']))
            $query = "SELECT * FROM `athlete` WHERE login = '{$_POST['login-into']}' AND password = '{$_POST['password-into']}'";
        elseif (!empty($_POST['login-reg']) && !empty($_POST['password-reg-second']))
            $query = "SELECT * FROM `athlete` WHERE login = '{$_POST['login-reg']}' AND password = '{$_POST['password-reg-second']}'";

        $arr[] = $this->mysqlResultToArr($query);

        if(isset($arr[0][0]['login'])) {
            $name = 'user';
            $value = $arr[0][0]['login'];
            $value = preg_replace('#@#iu', '.', $value);
            setcookie($name, $value, time()+(60*60*24*30) );
            header('Location: http://powerlift/##');
            die();
        } else {
            $arr = [];
            $query = "SELECT * FROM `admin` WHERE login = '{$_POST['login-into']}' AND password = '{$_POST['password-into']}'";
            $arr[] = $this->mysqlResultToArr($query);

            if(isset($arr[0][0]['login'])) {
                $name = 'admin';
                $value = $arr[0][0]['login'];
                $value = preg_replace('#@#iu', '.', $value);
                setcookie($name, $value, time()+(60*60*24*30) );
                header('Location: http://powerlift/##');
                die();
            }
        }
    }

    public function getArrInfoAuthorization() {
        $keys = ['login-into', 'password-into'];

        if($this->checkPostEmpty($keys)) {
            if($this->checkInfoAuthorization())
                return;
        }

        return $this->getArrPost($keys);
    }

    public function addNewQuestionnaire(){
        if(!isset($_COOKIE['user']) || !isset($_POST['id_competition']))
            return;

        $idAthlete = $this->infoAboutCurrentAthlete[0]['id_athlete'];
        $weight = $this->infoAboutCurrentAthlete[0]['weight'];
        $idCompetition = $_POST['id_competition'];

        $query = "INSERT INTO `questionnaire`(`id_athlete`, `id_competition`, `category`) VALUES ('{$idAthlete}','{$idCompetition}','{$weight}')";
        $this->mysqlResultToArr($query);

        $query = "SELECT id_questionnaire FROM `questionnaire` WHERE id_athlete='{$idAthlete}' AND `id_competition`='{$idCompetition}'";
        $idQuestionnaire = $this->mysqlResultToArr($query)[0]['id_questionnaire'];

        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','1','1','{$this->infoAboutCurrentAthlete[0]['max_rod']}')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','1','2','0')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','1','3','0')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','2','1','{$this->infoAboutCurrentAthlete[0]['max_squat']}')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','2','2','0')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','2','3','0')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','3','1','{$this->infoAboutCurrentAthlete[0]['max_press']}')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','3','2','0')";
        $this->mysqlResultToArr($query);
        $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','3','3','0')";
        $this->mysqlResultToArr($query);

        header("Location: http://powerlift/?pag={$this->CurrentPag}#popup-response");
        die();
    }

    protected function checkInfoAuthorization() {
        $query = "SELECT * FROM `athlete` WHERE login = '{$_POST['login-into']}' AND password = '{$_POST['password-into']}'";
        $arr[] = $this->mysqlResultToArr($query);

        if(empty($arr[0][0]['login']))
            return false;

        return true;
    }

    protected function checkPostEmpty($keys) {
        for($i = 0; $i < count($keys); $i++) {
            if(empty($_POST[$keys[$i]]))
                return false;
        }

        return true;
    }

    public function getArrInfoRegistration() {
        $keys = $this->getArrKeysForRegAthlete();

        return $this->getArrPost($keys);
    }

    protected function getArrKeysForRegAthlete() {
        return $this->arrKeysForRegAthlete;
}

    protected function checkLogin($login) {
        $login = trim($login);

        if(preg_match('#^[a-zA-Z0-9]*@[a-zA-Z]*\.[a-zA-Z]*$#iu', $login))
            return false;

        return true;
    }


    protected function getArrPost($keys) {
        if(count($keys) == 0)
            return [];

        $arr = [];

        for($i = 0; $i < count($keys); $i++) {
            if(empty($_POST[$keys[$i]])){
                $arr[$keys[$i]] = '';
                continue;
            }

            $arr[$keys[$i]] = $_POST[$keys[$i]];
        }

        return $arr;
    }

    public function checkCommand() {
        if(!empty($_GET['command']))
            if($_GET['command'] === 'out')
                if(isset($_COOKIE['user']) || isset($_COOKIE['admin']))
                    return true;

        return false;
    }

    public function outFromProf($nameCookie, $valueCookie) {
        setcookie($nameCookie, $valueCookie, time()-(60*60*24*30) );
        header('Refresh:0');
        die();
    }

    public function getContent() {
        return $this->mysqlResultToArr('SELECT * FROM `competition` ORDER BY date DESC');
    }

    protected function getArrKeysInfoAboutCurrentUser() {
        return $this->arrKeysInfoAboutCurrentUser;
    }

    public function getPopupResult() {
        $query = 'SELECT Q.id_competition AS id, A.id_athlete,  Q.id_questionnaire, A.name AS name, A.lastname AS lastname, A.patronymic AS patronymic, A.weight AS weight, Q.category AS category, S.name AS name_sports_category,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=1 AND number=1) AS t1,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=1 AND number=2) AS t2,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=1 AND number=3) AS t3,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=2 AND number=1) AS p1,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=2 AND number=2) AS p2,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=2 AND number=3) AS p3,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=3 AND number=1) AS g1,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=3 AND number=2) AS g2,
                    (SELECT `result` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=3 AND number=3) AS g3,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=1 AND number=1) AS idt1,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=1 AND number=2) AS idt2,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=1 AND number=3) AS idt3,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=2 AND number=1) AS idp1,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=2 AND number=2) AS idp2,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=2 AND number=3) AS idp3,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=3 AND number=1) AS idg1,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=3 AND number=2) AS idg2,
                    (SELECT `id_approach` FROM `approach` WHERE `id_questionnaire` = Q.id_questionnaire AND `id_view`=3 AND number=3) AS idg3
                    FROM `questionnaire` Q
                    INNER JOIN `athlete` A
                    ON Q.id_athlete = A.id_athlete
                    INNER JOIN `competition` C
                    ON Q.id_competition = C.id_competition
                    INNER JOIN `trainer` T
                    ON A.id_trainer = T.id_trainer
                    INNER JOIN `team` Te
                    ON A.id_team = Te.id_team
                    INNER JOIN `city` Ci
                    ON A.id_city = Ci.id_city
                    INNER JOIN `sports_category` S
                    ON A.id_sports_category = S.id_sports_category
                    INNER JOIN `approach` Ap
                    ON Q.id_questionnaire = Ap.id_questionnaire
                    INNER JOIN `view` V
                    ON Q.id_questionnaire = Ap.id_questionnaire';

        $this->arrPopupResult =  $this->mysqlResultToArr($query);

        return $this->arrPopupResult;
    }

    protected function setArrInfoAboutAllAthlete() {
        $query = 'SELECT A.password, A.login, A.name AS name, A.lastname AS lastname, A.patronymic AS patronymic, A.weight AS weight, A.max_press, A.max_rod, A.max_squat, (A.max_press + A.max_rod + A.max_squat) AS max_sum, T.name AS name_trainer, T.lastname AS lastname_trainer, T.patronymic AS patronymic_trainer, C.name AS city, S.name AS category, Te.name AS name_team
                    FROM `athlete` A INNER JOIN `trainer` T
                    ON A.id_trainer = T.id_trainer
                    INNER JOIN `city` C
                    ON A.id_city = C.id_city
                    INNER JOIN `sports_category` S
                    ON A.id_sports_category = S.id_sports_category
                    INNER JOIN `team` Te
                    ON A.id_team = Te.id_team';
        $this->arrInfoAboutAllAthlete = $this->mysqlResultToArr($query);
    }

    public function getArrInfoAboutAllAthlete() {
        return $this->arrInfoAboutAllAthlete;
    }

    public function getAmountPages($amountCompetitionOnPage) {
        $amountCompetitionOnPage = 2;
        $amountCompetition = $this->getAmountCompetition();
        $page = intval(($amountCompetition - 1) / $amountCompetitionOnPage + 1);
        if(empty($page) or $page < 0) $page = 1;
        return $page;
    }

    public function getAmountCompetition() {
        $query = 'SELECT COUNT(id_competition) AS amount FROM `competition`';
        if(!empty($this->mysqlResultToArr($query)[0]['amount']))
            return intval($this->mysqlResultToArr($query)[0]['amount']);
    }

    public function getCurrentPage() {
        if(empty($_GET['pag']))
            return 1;

        $this->CurrentPag = $_GET['pag'];

        return intval($_GET['pag']);
    }

    public function checkReg() {
        if(isset($_POST['submit-reg'])) {
            $arr = [];

            for($i = 0; $i < count($this->arrKeysInfoAboutAthleteReg); $i++) {
                if(empty($_POST[$this->arrKeysInfoAboutAthleteReg[$i]])) {
                    $_SESSION['errorReg'] = 'Заполните все поля!';
                    return false;
                }

                $arr[] = $_POST[$this->arrKeysInfoAboutAthleteReg[$i]];
            }

            $this->setArrValuesInfoAboutAthleteReg($arr);

            if($this->checkLogin($_POST['login-reg'])) {
                $_SESSION['errorReg'] = 'Логин не валиден!';
                return false;
            }

            if(!empty($_POST['login-reg'])) {
                if($this->checkAthlete($_POST['login-reg'])) {
                    $_SESSION['errorReg'] = 'Пользователь с таким email уже зарегестрирован!';
                    return false;
                }
            }

            $keys = $this->getArrKeysForRegAthlete();

            if(!$this->checkValuesPostOnLetters($keys, 0, 7) || !$this->checkValuesPostOnNumerals($keys, 9, 12)) {
                $_SESSION['errorReg'] = 'Введены некорректные данные!';
                return false;
            }

            if($_POST['password-reg-second'] !== $_POST['password-reg-first']){
                $_SESSION['errorReg'] = 'Пароли не совпадают!';
                return false;
            }

            $this->setPostTrim($keys);
            $this->setPostUCFirst($keys, 0, 7);

            return true;
        }

        return false;
    }

    protected function setPostTrim($keys) {
        for($i = 0; $i < count($keys); $i++) {
            $_POST[$keys[$i]] = trim($_POST[$keys[$i]]);
        }
    }

    protected function setPostUCFirst($keys, $start = 0, $end = '') {

        for($i = 0; $i < count($keys); $i++) {
            if($i > $end) break;
            if($i < $start) continue;

            if(preg_match('#^[а-яА-Яa-zA-Z ]*$#iu', $_POST[$keys[$i]]))
                $_POST[$keys[$i]] = $this->mb_ucfirst($_POST[$keys[$i]], 'UTF-8');
        }
    }

    function mb_ucfirst($string, $encoding)
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, null, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    protected function checkValuesPostOnNumerals($keys, $start = 0, $end = '') {
        if($end === '')
            $end = count($keys);

        for($i = 0 ; $i < count($keys); $i++) {
            if($i > $end) break;
            if($i < $start) continue;
            if(!preg_match('#^[0-9 ]*$#ui', $_POST[$keys[$i]]))
                return false;
        }

        return true;
    }

    protected function checkValuesPostOnLetters($keys, $start = 0, $end = '') {
        if($end === '')
            $end = count($keys);

        for($i = 0 ; $i < count($keys); $i++) {
            if($i > $end) break;
            if($i < $start) continue;
            if(!preg_match('#^[а-яА-Я-zA-Z ]*$#ui', $_POST[$keys[$i]]))
                return false;
        }

        return true;
    }

    protected function checkAthlete($login = '', $name = '', $lastname = '', $patronymic = '') {
        $this->setArrInfoAboutAllAthlete();
        $arr = $this->getArrInfoAboutAllAthlete();

        if(!empty($login)) {
            for($i = 0; $i < count($arr); $i++) {
                if($login === $arr[$i]['login'])
                    return true;
            }
        }

        if(!empty($name) && !empty($lastname) && !empty($patronymic)) {
            for($i = 0; $i < count($arr); $i++) {
                if($name === $arr[$i]['name'] && $lastname === $arr[$i]['lastname'] && $patronymic === $arr[$i]['patronymic'])
                    return true;
            }
        }

        return false;
    }

    public function registration() {
        $this->setValuesForReg();
        $arr = $this->getArrInfoAboutAthleteReg();

        $nameTrainer = $_POST['name-trainer-reg'];
        $lastnameTrainer = $_POST['lastname-trainer-reg'];
        $patronymicTrainer = $_POST['patronymic-trainer-reg'];
        $nameTeam = $_POST['name-team-reg'];
        $nameCity = $_POST['city-reg'];
        $arrInfoAboutCities = $this->getArrInfoAboutCities();
        $arrInfoAboutTeams = $this->getArrInfoAboutTeams();
        $arrInfoAboutTrainers = $this->getArrInfoAboutTrainers();
        $arrInfoAboutAthleteReg = $this->getArrInfoAboutAthleteReg();

        if(!$this->checkColAtDB('city-reg', $arrInfoAboutCities, $arrInfoAboutAthleteReg))
            $this->mysqlInsertUpdateDelete("INSERT INTO `city`(`name`) VALUES ('{$nameCity}')");

        if(!$this->checkColAtDB('name-team-reg', $arrInfoAboutTeams, $arrInfoAboutAthleteReg))
            $this->mysqlInsertUpdateDelete("INSERT INTO `team`(`name`) VALUES ('{$nameTeam}')");

        if(!$this->checkColAtDBForTrainer($arrInfoAboutTrainers, $arrInfoAboutAthleteReg))
            $this->mysqlInsertUpdateDelete("INSERT INTO `trainer`(`name`, `lastname`, `patronymic`) VALUES ('{$nameTrainer}', '{$lastnameTrainer}', '{$patronymicTrainer}')");

        $query = "SELECT id_city FROM `city` WHERE name= '{$nameCity}'";
        $idCity = $this->mysqlResultToArr($query)[0]['id_city'];

        $query = "SELECT id_team FROM `team` WHERE name= '{$nameTeam}'";
        $idTeam = $this->mysqlResultToArr($query)[0]['id_team'];

        $query = "SELECT id_trainer FROM `trainer` WHERE name= '{$nameTrainer}' AND lastname = '{$lastnameTrainer}' AND patronymic = '{$patronymicTrainer}'";
        $idTrainer = $this->mysqlResultToArr($query)[0]['id_trainer'];

        $this->mysqlInsertUpdateDelete("INSERT INTO `athlete`( `id_trainer`, `id_sports_category`, `id_city`, `id_team`, `name`, `lastname`, `patronymic`, `login`, `password`, `weight`, `max_press`, `max_rod`, `max_squat`) 
                    VALUES ('{$idTrainer}','{$arr['sports-category-reg']}','{$idCity}','{$idTeam}','{$_POST['name-athlete-reg']}','{$_POST['lastname-athlete-reg']}','{$_POST['patronymic-athlete-reg']}','{$arr['login-reg']}','{$arr['password-reg-second']}','{$arr['weight-reg']}','{$arr['weight-press-reg']}','{$arr['weight-rod-reg']}','{$arr['weight-squat-reg']}')");

        $this->authorization();

        header('Location:http://powerlift/##');
        die();
    }

    protected function checkColAtDBForTrainer($arr1, $arr2) {
        for($i = 0; $i < count($arr1); $i++) {
            if($arr2['name-trainer-reg'] === $arr1[$i]['name'] && $arr2['lastname-trainer-reg'] === $arr1[$i]['lastname'] && $arr2['patronymic-trainer-reg'] === $arr1[$i]['patronymic'])
                return true;
        }

        return false;
    }

    protected function checkColAtDB($str, $arr1, $arr2) {
        for($i = 0; $i < count($arr1); $i++) {
            if($arr2[$str] === $arr1[$i]['name'])
                return true;
        }

        return false;
    }

    public function getIdCurrentSportsCategory($nameCategory = '') {
        if(!empty($_POST['sports-category-prof']))
            return $_POST['sports-category-prof'];

        $query = "SELECT id_sports_category FROM `sports_category` WHERE name='{$nameCategory}'";
        return $this->mysqlResultToArr($query)[0]["id_sports_category"];
    }

    public function getInfoAboutCurrentAthlete() {
        $login = $this->getCurrentLogin('user');
        $query = "SELECT A.id_athlete AS id_athlete, A.name AS name, A.lastname AS lastname, A.patronymic AS patronymic, A.weight AS weight, A.max_press, A.max_rod, A.max_squat, (A.max_press + A.max_rod + A.max_squat) AS max_sum, T.name AS name_trainer, T.lastname AS lastname_trainer, T.patronymic AS patronymic_trainer, C.name AS city, S.name AS category, Te.name AS name_team
                    FROM `athlete` A INNER JOIN `trainer` T
                    ON A.id_trainer = T.id_trainer
                    INNER JOIN `city` C
                    ON A.id_city = C.id_city
                    INNER JOIN `sports_category` S
                    ON A.id_sports_category = S.id_sports_category
                    INNER JOIN `team` Te
                    ON A.id_team = Te.id_team WHERE login = '{$login}'";

        $arr =  $this->mysqlResultToArr($query);
        $this->infoAboutCurrentAthlete = $arr;

        if(isset($_POST['submit-change-prof']) && $_POST['submit-change-prof'] !== 'false')
            $this->saveChangesInformationAboutCurrentUser();

        return $arr;
    }

    public function setInfoAboutCurrentAthlete() {
        $login = $this->getCurrentLogin('user');
        $nameTrainer = $_POST['name-trainer-prof'];
        $lastnameTrainer = $_POST['lastname-trainer-prof'];
        $patronymicTrainer = $_POST['patronymic-trainer-prof'];
        $nameTeam = $_POST['name-team-prof'];
        $nameCity = $_POST['city-prof'];
        $nameCategory = $_POST['sports-category-prof'];
        $arrInfoAboutCities = $this->getArrInfoAboutCities();
        $arrInfoAboutTeams = $this->getArrInfoAboutTeams();
        $arrInfoAboutTrainers = $this->getArrInfoAboutTrainers();

        if(!$this->checkColAtDB('city-prof', $arrInfoAboutCities, $_POST))
            $this->mysqlInsertUpdateDelete("INSERT INTO `city`(`name`) VALUES ('$nameCity')");

        if(!$this->checkColAtDB('name-team-prof', $arrInfoAboutTeams, $_POST))
            $this->mysqlInsertUpdateDelete("INSERT INTO `team`(`name`) VALUES ('{$nameTeam}')");

        if(!$this->checkColAtDB('name-trainer-prof', $arrInfoAboutTrainers, $_POST) || !$this->checkColAtDB('lastname-trainer-prof', $arrInfoAboutTrainers, $_POST) || !$this->checkColAtDB('patronymic-trainer-prof', $arrInfoAboutTrainers, $_POST))
            $this->mysqlInsertUpdateDelete("INSERT INTO `trainer`(`name`, `lastname`, `patronymic`) VALUES ('{$nameTrainer}', '{$lastnameTrainer}', '{$patronymicTrainer}')");

        $query = "SELECT id_city FROM `city` WHERE name= '{$nameCity}'";
        $idCity = $this->mysqlResultToArr($query)[0]['id_city'];

        $query = "SELECT id_team FROM `team` WHERE name= '{$nameTeam}'";
        $idTeam = $this->mysqlResultToArr($query)[0]['id_team'];

        $query = "SELECT id_trainer FROM `trainer` WHERE name= '{$nameTrainer}' AND lastname = '{$lastnameTrainer}' AND patronymic = '{$patronymicTrainer}'";
        $idTrainer = $this->mysqlResultToArr($query)[0]['id_trainer'];

        $query = "SELECT id_sports_category FROM `sports_category` WHERE name= '{$nameCategory}'";
        $idCategory = $this->mysqlResultToArr($query)[0]['id_sports_category'];

        $query = "UPDATE `athlete` SET `id_trainer`='$idTrainer',`id_sports_category`='$idCategory',`id_city`='$idCity',`id_team`='$idTeam',
                    `name`='{$_POST['name-athlete-prof']}',`lastname`='{$_POST['lastname-athlete-prof']}',`patronymic`='{$_POST['patronymic-athlete-prof']}',`weight`='{$_POST['weight-prof']}',`max_press`='{$_POST['weight-press-prof']}',
                    `max_rod`='{$_POST['weight-rod-prof']}',`max_squat`='{$_POST['weight-squat-prof']}' WHERE login = '{$login}'";

        $this->mysqlResultToArr($query, true);
        header('Location:http://powerlift/');
        die();
    }

    protected function saveChangesInformationAboutCurrentUser() {
        $arr = $this->infoAboutCurrentAthlete;
        $keysForCurrentArrInfoAboutAthlete = $this->getArrKeysInfoAboutCurrentUser();
        $keysForChangedArrInfoAboutAthlete = $this->getArrKeysInfoAboutAthleteProf();

        for($i = 0; $i < count($keysForCurrentArrInfoAboutAthlete); $i++) {
            if($arr[0][$keysForCurrentArrInfoAboutAthlete[$i]] !== $_POST[$keysForChangedArrInfoAboutAthlete[$i]]) {
                $this->setInfoAboutCurrentAthlete();
                return;
            }
        }
    }


    protected function setValuesForReg() {
        $this->setArrInfoAboutAthleteReg();
        $this->setArrInfoAboutCities();
        $this->setArrInfoAboutTeams();
        $this->setArrInfoAboutTrainers();
    }

    protected function setArrInfoAboutAthleteReg() {
        $keys = $this->getArrKeysInfoAboutAthleteReg();
        $value = $this->getArrValuesInfoAboutAthleteReg();

        $this->arrInfoAboutAthleteReg = array_combine($keys, $value);
    }

    protected function getArrInfoAboutAthleteReg() {
        return $this->arrInfoAboutAthleteReg;
    }

    protected function getArrInfoAboutCities() {
        return $this->arrInfoAboutCities;
    }

    protected function getArrValuesInfoAboutAthleteReg() {
        return $this->arrValuesInfoAboutAthleteReg;
    }

    protected function getArrKeysInfoAboutAthleteReg() {
        return $this->arrKeysInfoAboutAthleteReg;
    }

    protected function setArrInfoAboutCities() {
        $this->arrInfoAboutCities = $this->mysqlResultToArr('SELECT * FROM `city`');
    }

    protected function setArrInfoAboutTeams() {
        $this->arrInfoAboutTeams = $this->mysqlResultToArr('SELECT * FROM `team`');
    }

    protected function getArrInfoAboutTeams() {
        return $this->arrInfoAboutTeams;
    }

    protected function setArrInfoAboutTrainers() {
        $this->arrInfoAboutTrainers = $this->mysqlResultToArr('SELECT * FROM `trainer`');
    }

    protected function getArrInfoAboutTrainers() {
        return $this->arrInfoAboutTrainers;
    }

    protected function setArrValuesInfoAboutAthleteReg($arr) {
        $this->arrValuesInfoAboutAthleteReg = $arr;
    }

    protected function setArrInfoAboutSportsCategories($arr) {
        $this->arrInfoAboutSportsCategories = $this->mysqlResultToArr('SELECT * FROM `sports_category`');
    }

    protected function getArrInfoAboutSportsCategories() {
        return $this->arrInfoAboutSportsCategories;
    }

    public function getCurrentCompetition($arr, $currentPage, $amountCompetitionOnPage) {
        $result = [];
        $offset = ($currentPage-1) * $amountCompetitionOnPage;
        $count = 0;

        for ($i = $offset; ; $i++) {
            if($count == 2 || empty($arr[$i])) break;

            $arrValuesForJudge = $this->getValuesForJudge($arr[$i]['id_judge']);

            $result[] = $arr[$i];
            $result[$count]['name_judge'] = $arrValuesForJudge[0]['name'];
            $result[$count]['lastname_judge'] = $arrValuesForJudge[0]['lastname'];
            $result[$count]['patronymic_judge'] = $arrValuesForJudge[0]['patronymic'];
            $count++;
        }

        return $result;
    }

    protected function getValuesForJudge($id) {
        $query = "SELECT * FROM `judge` WHERE id_judge='{$id}'";
        return $this->mysqlResultToArr($query);
    }

    public function getDateCurrentCompetition($arrDate){
        $arr = [];
        for($i = 0; $i < count($arrDate); $i++) {
            preg_match_all('#\d{2}:\d{2}(?=:)#iu',$arrDate[$i]['date'], $arr);
            $arrDate[$i]['time'] = $arr[0][0];
            $arrDate[$i]['date'] = preg_replace('# \d{2}:\d{2}:\d{2}#iu', '', $arrDate[$i]['date']);
        }

        return $arrDate;
    }

    public function getValueUserCookie($name = '') {
        if(isset($_COOKIE[$name])) {
            $patterns = ['#_#iu', '#\%40#iu'];
            $replace = ['\.', '\@'];
            return preg_replace($patterns, $replace, $_COOKIE[$name]);
        }
    }

    public function getNameUserCookie() {
        if(isset($_COOKIE['user']))
            return 'user';
        elseif(isset($_COOKIE['admin']))
            return 'admin';
    }


    public function getMaxSum($arr) {
        $arrResult = [];

        foreach ($arr as $item) {
            $p = max(intval($item['p1']), intval($item['p2']), intval($item['p3']));
            $t = max(intval($item['t1']), intval($item['t2']), intval($item['t3']));
            $g = max(intval($item['g1']), intval($item['g2']), intval($item['g3']));

            $arrResult[] = $p + $t+ $g;
        }

        return $arrResult;
    }

    public function getNextPage($arr, $currentPage, $amountCompetitionOnPage) {
        $result = 1;
        $offset = ($currentPage-1) * $amountCompetitionOnPage + 2;
        $count = 0;

        for ($i = $offset; ; $i++) {
            if($count == 2 || empty($arr[$i])){
                $result = $currentPage;
                break;
            }

            if(empty($arr[$i]))
                $count++;
            else {
                $result = $currentPage + 1;
                break;
            }
        }

        return $result;
    }

    public function getPrevPage() {

        if(empty($_GET['pag']))
            $pag = 1;
        else
            $pag = intval($_GET['pag']);

        if(!empty($_GET['pag']) && $pag > 1)
            return $pag - 1;
        else
            return 1;
    }

    public function getArrSportsCategories() {
        return $this->mysqlResultToArr('SELECT * FROM `sports_category`');
    }

    public function getArrCities() {
        return $this->mysqlResultToArr('SELECT name FROM `sports_category`');
    }

    public function getArrKeysInfoAboutAthleteProf() {
        return $this->arrKeysInfoAboutAthleteProf;
    }

    protected function getCurrentLogin($person = '') {
        if(!empty($person))
            return preg_replace('#\.(?=(gmail|mail).(com|ru))#iu', '@', $_COOKIE[$person]);
    }

    protected function getArrKeysInfoAboutCompetitionReg() {
        return $this->arrKeysInfoAboutCompetitionReg;
    }

    public function setCompetition() {
        if(!isset($_POST['submit-competition-reg']))
            return false;
        $keys = $this->getArrKeysInfoAboutCompetitionReg();

        for($i = 0; $i < count($keys); $i++) {
            if(empty($_POST[$keys[$i]]))
                return false;
        }

        if(!$this->checkDate($_POST['date-reg'])){
            $_SESSION['errorReg'] = 'Введите корректную дату!';
            return false;
        }

        if(!$this->checkTime($_POST['time-reg'])){
            $_SESSION['errorReg'] = 'Введите корректное время!';
            return false;
        }

        if(!$this->checkJudge('', $_POST['name-judge-reg'], $_POST['lastname-judge-reg'], $_POST['patronymic-judge-reg']))
            $this->setJudge($_POST['name-judge-reg'], $_POST['lastname-judge-reg'], $_POST['patronymic-judge-reg']);

        $idJudge = $this->getJudge($_POST['name-judge-reg'], $_POST['lastname-judge-reg'], $_POST['patronymic-judge-reg'])[0]['id_judge'];
        $idAdmin = $this->getAdmin($this->getCurrentLogin('admin'))[0]['id_admin'];

        $query = "INSERT INTO `competition`( `id_admin`, `id_judge`, `date`, `name`, `description`, `url`) VALUES ('{$idAdmin}','{$idJudge}','{$_POST['date-reg']} {$_POST['time-reg']}:00','{$_POST['name-competition-reg']}','{$_POST['description-competition-reg']}','images/competitions/{$_POST['photo-reg']}')";
        $this->mysqlResultToArr($query, true);

        header('Location:http://powerlift/##');
        die();
    }

    protected function checkJudge($id = '', $name = '', $lastname = '', $patronymic = '') {
        if(!empty($id))
            $query = "SELECT * FROM `judge` WHERE `id_judge`='{$id}'";
        elseif(!empty($name) && !empty($lastname) && !empty($patronymic))
            $query = "SELECT * FROM `judge` WHERE `name`='{$name}' AND `lastname`='{$lastname}' AND `patronymic`='{$patronymic}'";
        else
            return false;

        if(!empty($this->mysqlResultToArr($query)[0]['id_judge'])){
            if(($this->mysqlResultToArr($query)[0]['id_judge']) !== null)
                return true;
        }

        return false;
    }

    protected function getAdmin($login = ''){
        if(!empty($login)) {
            $query = "SELECT * FROM `admin` WHERE login = '{$login}'";
            return $this->mysqlResultToArr($query);
        }
    }

    protected function getJudge($name = '', $lastname = '', $patronymic = ''){
        if(!empty($name) && !empty($lastname) && !empty($patronymic)) {
            $query = "SELECT * FROM `judge` WHERE name = '{$name}' AND lastname = '{$lastname}' AND patronymic = '{$patronymic}'";
            return $this->mysqlResultToArr($query);
        }
    }

    protected function setJudge($name = '', $lastname = '', $patronymic = ''){
        if(!empty($name) && !empty($lastname) && !empty($patronymic)) {
            $query = "INSERT INTO `judge`(`name`, `lastname`, `patronymic`) VALUES  ('{$name}', '{$lastname}', '{$patronymic}')";
            $this->mysqlResultToArr($query);
        }
    }

    protected function checkDate($date) {
        if(!preg_match('#^20\d{2}-(01|02|03|04|05|06|07|08|09|10|11|12)-([0-2][0-9]|30|31)$#ui', $date))
            return false;

        if($date < date('Y-m-d'))
            return false;

        return true;
    }

    protected function checkTime($time) {
        if(!preg_match('#^[0-2]\d:[0-5]\d$#ui', $time))
            return false;

        return true;
    }

    protected function getArrKeysInfoAboutCompetitionChange(){
        return $this->arrKeysInfoAboutCompetitionChange;
    }

    protected function delCompetition($id){
        $query = "SELECT id_questionnaire FROM `questionnaire` WHERE id_competition='{$id}'";
        $arr = $this->mysqlResultToArr($query);

        for($i = 0; $i < count($arr); $i++) {
            $query = "DELETE FROM `approach` WHERE id_questionnaire='{$arr[$i]['id_questionnaire']}'";
            $this->mysqlResultToArr($query);
        }

        $query = "DELETE FROM `questionnaire` WHERE id_competition='{$id}'";
        $this->mysqlResultToArr($query);

        $query = "DELETE FROM `competition` WHERE id_competition='{$id}'";
        $this->mysqlResultToArr($query);

        header('Location:http://powerlift/##');
        die();
    }

    public function changeCompetition() {
        $keys = $this->getArrKeysInfoAboutCompetitionChange();

        for($i = 0; $i < count($keys)-1; $i++) {
            if(empty($_POST[$keys[$i]]))
                return;
        }

        if(isset($_POST['submit-competition-del'])){
            $this->delCompetition($_POST['id-change']);
            return;
        }

        if(!isset($_POST['submit-competition-change']))
            return false;

        if(!$this->checkJudge('', $_POST['name-judge-change'], $_POST['lastname-judge-change'], $_POST['patronymic-judge-change']))
            $this->setJudge($_POST['name-judge-change'], $_POST['lastname-judge-change'], $_POST['patronymic-judge-change']);

        $idJudge = $this->getJudge($_POST['name-judge-change'], $_POST['lastname-judge-change'], $_POST['patronymic-judge-change'])[0]['id_judge'];
        $idAdmin = $this->getAdmin($this->getCurrentLogin('admin'))[0]['id_admin'];

        if(!empty($_POST['photo-change'])) {
            $query = "UPDATE `competition` SET `id_admin`='{$idAdmin}',`id_judge`={$idJudge},`date`='{$_POST['date-change']} {$_POST['time-change']}',`name`='{$_POST['name-competition-change']}',
                    `description`='{$_POST['description-competition-change']}', `url`='images/competitions/{$_POST['photo-change']}' WHERE `id_competition`='{$_POST['id-change']}'";
            $this->mysqlResultToArr($query);
        }else {
            $query = "UPDATE `competition` SET `id_admin`='{$idAdmin}',`id_judge`={$idJudge},`date`='{$_POST['date-change']} {$_POST['time-change']}',`name`='{$_POST['name-competition-change']}',
                    `description`='{$_POST['description-competition-change']}' WHERE `id_competition`='{$_POST['id-change']}'";
            $this->mysqlResultToArr($query);
        }

        $_SESSION['successMessageForChangeCompetition'] = 'Данные успешно изменены!';

        header('Location:http://powerlift/');
        die();
    }

    public function addNewResult() {
        if(!isset($_POST['submit-add-result']))
            return;

        $keys = $this->getArrKeysForAddNewResult();

        for($i = 0; $i < count($keys); $i++) {
            if(empty($_POST[$keys[$i]])) {
                $_SESSION['errorAddResult'] = 'Заполните основную информацию!';
                return;
            }
        }

        if(!$this->checkAthlete('', $_POST['name-athlete-result'], $_POST['lastname-athlete-result'], $_POST['patronymic-athlete-result'])){
            $_SESSION['errorAddResult'] = 'Данного пользователя не существует!';
            return;
        }

        $idAthlete = $this->getInfoAboutAthlete('', $_POST['name-athlete-result'], $_POST['lastname-athlete-result'], $_POST['patronymic-athlete-result'])[0]["id_athlete"];


        $query = "INSERT INTO `questionnaire`(`id_athlete`, `id_competition`, `category`) VALUES ('{$idAthlete}','{$_POST['id-competition-result']}','{$_POST['category-result']}')";
        $this->mysqlResultToArr($query);

        $query ='SELECT `id_questionnaire` FROM `questionnaire` ORDER BY `id_questionnaire` DESC LIMIT 1';
        $idQuestionnaire = $this->mysqlResultToArr($query)[0]['id_questionnaire'];

        $keys = $this->getArrKeysForAddApproach();

        for($i = 0; $i < count($keys); $i++) {
            $idView = $i + 1;
            for($j = 0; $j < count($keys); $j++) {
                $number = $j + 1;
                $query = "INSERT INTO `approach`(`id_questionnaire`, `id_view`, `number`, `result`) VALUES ('{$idQuestionnaire}','{$idView}','{$number}','{$_POST[$keys[$i][$j]]}')";
                $this->mysqlResultToArr($query);
            }
        }

        header("Location:http://powerlift/?pag={$_GET['pag']}#popup-add-result{$_POST['id-competition-result']}");
        die();
    }

    protected function getArrKeysForAddApproach(){
        return $this->arrKeysForAddApproach;
    }

    protected function getInfoAboutAthlete($id = '', $name = '', $lastname = '', $patronymic = '') {
        if(!empty($id))
            $query = "SELECT * FROM `athlete` WHERE id_athlete='{$id}'";

        if(!empty($name) && !empty($lastname) && !empty($patronymic))
            $query = "SELECT * FROM `athlete` WHERE name='{$name}' AND lastname='{$lastname}' AND patronymic='{$patronymic}'";

        return $this->mysqlResultToArr($query);
    }

    protected function getArrKeysForAddNewResult() {
        return $this->arrKeysForAddNewResult;
    }

    protected function getArrKeysForChangeResults() {
        return $this->arrKeysForChangeResults;
    }

    protected function getArrKeysForChangeApproachId() {
        return $this->arrKeysForChangeApproachId;
    }

    protected function getArrKeysForChangeApproachResults() {
        return $this->arrKeysForChangeApproachResults;
    }

    public function changeResult() {
        if(isset($_POST['submit-del-result'])) {
            $query = "DELETE FROM `approach` WHERE `id_questionnaire`='{$_POST['id-questionnaire-result']}'";
            $this->mysqlResultToArr($query);

            $query = "DELETE FROM `questionnaire` WHERE `id_questionnaire`='{$_POST['id-questionnaire-result']}'";
            $this->mysqlResultToArr($query);

            header("Location:http://powerlift/?pag={$_GET['pag']}");
            die();
        }

        if(!isset($_POST['submit-change-result']))
            return;

        $keys = $this->getArrKeysForChangeResults();

        for($i = 0; $i < count($keys); $i++) {
            if(empty($_POST[$keys[$i]])) {
                $_SESSION['errorChangeResult'] = 'Заполните основную информацию!';
                return;
            }
        }

        if(!$this->checkAthlete('', $_POST['name-athlete-change-result'], $_POST['lastname-athlete-change-result'], $_POST['patronymic-athlete-change-result'])){
            $_SESSION['errorChangeResult'] = 'Данного пользователя не существует!';
            return;
        }

        $query = "SELECT id_athlete FROM `athlete` WHERE `name`='{$_POST['name-athlete-change-result']}' AND `lastname`='{$_POST['lastname-athlete-change-result']}' AND `patronymic`='{$_POST['patronymic-athlete-change-result']}'";
        $idAthlete = $this->mysqlResultToArr($query)[0]['id_athlete'];

        $query = "UPDATE `questionnaire` SET `id_athlete`='{$idAthlete}', `category`='{$_POST['category-change-result']}' WHERE id_questionnaire='{$_POST['id-questionnaire-result']}'";
        $this->mysqlResultToArr($query);

        $this->setExercise();

        header("Location:http://powerlift/?pag={$_GET['pag']}#popup-change-result{$_POST['id-competition-result']}{$idAthlete}");
        die();
    }

    protected function setExercise() {
        $keysForId = $this->getArrKeysForChangeApproachId();
        $keysForResults = $this->getArrKeysForChangeApproachResults();

        for($i = 0; $i < count($keysForId); $i++){
            if(empty($_POST[$keysForResults[$i]]))
                $_POST[$keysForResults[$i]] = '0';

            $query = "UPDATE `approach` SET `result`='{$_POST[$keysForResults[$i]]}' WHERE id_approach='{$_POST[$keysForId[$i]]}'";
            $this->mysqlResultToArr($query);
        }
    }

    protected function mysqlResultToArr($query = '', $fl = false) {
        if($query === '')
            return [];

        $result = mysqli_query($this->db, $query);
        $count = 0;

        if($result == false || $fl || $result === true)
            return [];

        $arr[] = mysqli_fetch_assoc($result);

        while($row = mysqli_fetch_assoc($result)) {
            foreach ($arr as $item) {
                if($item != $row)
                    $count +=1;
            }

            if($count === count($arr))
                $arr[] = $row;

            $count = 0;
        }

        return $arr;
    }

    protected function mysqlInsertUpdateDelete($query) {
        mysqli_query($this->db, $query);
    }

    public function PHPExcel() {
        if(!isset($_POST['save-report']))
            return false;

        $this->objPHPExcel = new PHPExcel();
        $this->objPHPExcel->setActiveSheetIndex(0);
        $nameFile = '';

        $this->activeSheet = $this->objPHPExcel->getActiveSheet();

        $this->activeSheet->getPageSetup()
            ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $this->activeSheet->getPageSetup()
            ->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        if(isset($_POST['id-competition-for-download-report'])) {
            $this->downloadReportAboutCompetition();
            $nameFile = 'Отчет по соревнованию';
        }

        if(isset($_POST['id-athlete-for-download-report'])) {
            $this->downloadReportAboutAthlete();
            $nameFile = 'Отчет по спортсмену';
        }

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$nameFile.xls");

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    protected function downloadReportAboutAthlete() {
        $date = date('Y-m-d');
        $this->activeSheet->mergeCells('A1:N1');
        $this->activeSheet->getRowDimension('1')->setRowHeight(40);
        $this->activeSheet->setCellValue('A1','Информация об атлете');

        $this->activeSheet->setCellValue('A2','Имя');
        $this->activeSheet->setCellValue('B2','Фамилия');
        $this->activeSheet->setCellValue('C2','Отчество');
        $this->activeSheet->setCellValue('D2','Вес');
        $this->activeSheet->setCellValue('E2','Имя тренера');
        $this->activeSheet->setCellValue('F2','Фамилия тренера');
        $this->activeSheet->setCellValue('G2','Отчество тренера');
        $this->activeSheet->setCellValue('H2','Место проживания');
        $this->activeSheet->setCellValue('I2','Разряд по спорту');
        $this->activeSheet->setCellValue('J2','Вес на 1 подход присед');
        $this->activeSheet->setCellValue('K2','Вес на 1 подход тяги');
        $this->activeSheet->setCellValue('L2','Вес на 1 подход жим');
        $this->activeSheet->setCellValue('M2','Максимальная сумма');
        $this->activeSheet->setCellValue('N2','Название команды');

        $this->activeSheet->setCellValue('N5',$date);

        $this->activeSheet->setTitle("Спортсмен");

        $styleHeader = array(
            'font'=>array(
                'bold' => true,
                'name' => 'Times New Roman',
                'size' => 20
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
            ),
            'fill' => array(
                'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
                'color'=>array(
                    'rgb' => 'CFCFCF'
                )
            ),
        );

        $styleContent = array(
            'font'=>array(
                'name' => 'Times New Roman',
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
            )
        );

        $styleDate = array(
            'font'=>array(
                'name' => 'Times New Roman',
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
            ),
            'fill' => array(
                'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
                'color'=>array(
                    'rgb' => 'CED8F6'
                ))
        );

        $this->activeSheet->setCellValue('A3', $this->infoAboutCurrentAthlete[0]['name']);
        $this->activeSheet->setCellValue('B3', $this->infoAboutCurrentAthlete[0]['lastname']);
        $this->activeSheet->setCellValue('C3', $this->infoAboutCurrentAthlete[0]['patronymic']);
        $this->activeSheet->setCellValue('D3', $this->infoAboutCurrentAthlete[0]['weight']);
        $this->activeSheet->setCellValue('E3', $this->infoAboutCurrentAthlete[0]['name_trainer']);
        $this->activeSheet->setCellValue('F3', $this->infoAboutCurrentAthlete[0]['lastname_trainer']);
        $this->activeSheet->setCellValue('G3', $this->infoAboutCurrentAthlete[0]['patronymic_trainer']);
        $this->activeSheet->setCellValue('H3', $this->infoAboutCurrentAthlete[0]['city']);
        $this->activeSheet->setCellValue('I3', $this->infoAboutCurrentAthlete[0]['category']);
        $this->activeSheet->setCellValue('J3', $this->infoAboutCurrentAthlete[0]['max_squat']);
        $this->activeSheet->setCellValue('K3', $this->infoAboutCurrentAthlete[0]['max_rod']);
        $this->activeSheet->setCellValue('L3', $this->infoAboutCurrentAthlete[0]['max_press']);
        $this->activeSheet->setCellValue('M3', $this->infoAboutCurrentAthlete[0]['max_sum']);
        $this->activeSheet->setCellValue('N3', $this->infoAboutCurrentAthlete[0]['name_team']);

        $this->activeSheet->getStyle('A2:N2')->applyFromArray($styleContent);
        $this->activeSheet->getStyle('A3:N3')->applyFromArray($styleContent);
        $this->activeSheet->getStyle('N5')->applyFromArray($styleDate);

        $this->activeSheet->getStyle('A1:N1')->applyFromArray($styleHeader);

        $this->activeSheet->getColumnDimension('A')->setWidth(15);
        $this->activeSheet->getColumnDimension('B')->setWidth(15);
        $this->activeSheet->getColumnDimension('C')->setWidth(17);
        $this->activeSheet->getColumnDimension('D')->setWidth(7);
        $this->activeSheet->getColumnDimension('E')->setWidth(17);
        $this->activeSheet->getColumnDimension('F')->setWidth(17);
        $this->activeSheet->getColumnDimension('G')->setWidth(18);
        $this->activeSheet->getColumnDimension('H')->setWidth(19);
        $this->activeSheet->getColumnDimension('I')->setWidth(17);
        $this->activeSheet->getColumnDimension('J')->setWidth(23);
        $this->activeSheet->getColumnDimension('K')->setWidth(21);
        $this->activeSheet->getColumnDimension('L')->setWidth(21);
        $this->activeSheet->getColumnDimension('M')->setWidth(21);
        $this->activeSheet->getColumnDimension('N')->setWidth(19);
    }

    protected function downloadReportAboutCompetition() {
        $idCompetition = $_POST['id-competition-for-download-report'];
        $query = "SELECT name FROM `competition` WHERE id_competition='{$idCompetition}'";
        $nameCompetition = $this->mysqlResultToArr($query)[0]['name'];

        $this->activeSheet->mergeCells('A1:N1');
        $this->activeSheet->getRowDimension('1')->setRowHeight(40);
        $this->activeSheet->setCellValue('A1',$nameCompetition);

        $this->activeSheet->setCellValue('A2','ФИО');
        $this->activeSheet->setCellValue('B2','Вес');
        $this->activeSheet->setCellValue('C2','Категория');
        $this->activeSheet->setCellValue('D2','Разряд');
        $this->activeSheet->setCellValue('E2','П1');
        $this->activeSheet->setCellValue('F2','П2');
        $this->activeSheet->setCellValue('G2','П3');
        $this->activeSheet->setCellValue('H2','Ж1');
        $this->activeSheet->setCellValue('I2','Ж2');
        $this->activeSheet->setCellValue('J2','Ж3');
        $this->activeSheet->setCellValue('K2','Т1');
        $this->activeSheet->setCellValue('L2','Т2');
        $this->activeSheet->setCellValue('M2','Т3');
        $this->activeSheet->setCellValue('N2','Сумма');

        $this->activeSheet->setTitle("Соревнование");

        $styleHeader = array(
            'font'=>array(
                'bold' => true,
                'name' => 'Times New Roman',
                'size' => 20
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
            ),
            'fill' => array(
                'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
                'color'=>array(
                    'rgb' => 'CFCFCF'
                )
            ),
        );

        $styleContent = array(
            'font'=>array(
                'name' => 'Times New Roman',
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
            )
        );

        $startRow = 3;
        $arrMaxSum = $this->getMaxSum($this->arrPopupResult);

        for($i = 0; $i < count($this->arrPopupResult); $i++) {

            if($this->arrPopupResult[$i]['id'] === $idCompetition) {
                $this->activeSheet->setCellValue('A'.$startRow,$this->arrPopupResult[$i]['name'] . ' ' . $this->arrPopupResult[$i]['lastname'] . ' ' . $this->arrPopupResult[$i]['patronymic']);
                $this->activeSheet->setCellValue('B'.$startRow,$this->arrPopupResult[$i]['weight']);
                $this->activeSheet->setCellValue('C'.$startRow,$this->arrPopupResult[$i]['category']);
                $this->activeSheet->setCellValue('D'.$startRow,$this->arrPopupResult[$i]['name_sports_category']);
                $this->activeSheet->setCellValue('E'.$startRow,$this->arrPopupResult[$i]['t1']);
                $this->activeSheet->setCellValue('F'.$startRow,$this->arrPopupResult[$i]['t2']);
                $this->activeSheet->setCellValue('G'.$startRow,$this->arrPopupResult[$i]['t3']);
                $this->activeSheet->setCellValue('H'.$startRow,$this->arrPopupResult[$i]['p1']);
                $this->activeSheet->setCellValue('I'.$startRow,$this->arrPopupResult[$i]['p2']);
                $this->activeSheet->setCellValue('J'.$startRow,$this->arrPopupResult[$i]['p3']);
                $this->activeSheet->setCellValue('K'.$startRow,$this->arrPopupResult[$i]['g1']);
                $this->activeSheet->setCellValue('L'.$startRow,$this->arrPopupResult[$i]['g2']);
                $this->activeSheet->setCellValue('M'.$startRow,$this->arrPopupResult[$i]['g3']);
                $this->activeSheet->setCellValue('N'.$startRow,$arrMaxSum[$i]);

                $this->activeSheet->getStyle('A' . $startRow .':N' .$startRow)->applyFromArray($styleContent);
                $this->activeSheet->getStyle('A2:N2')->applyFromArray($styleContent);

                $startRow++;
            }
        }

        $this->activeSheet->getStyle('A1:N1')->applyFromArray($styleHeader);

        $this->activeSheet->getColumnDimension('A')->setWidth(40);
        $this->activeSheet->getColumnDimension('C')->setWidth(18);
    }
}