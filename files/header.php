<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/iconsfont.css">
    <link rel="stylesheet" href="css/style.min.css">
    <title>Document</title>
</head>


<body>
<div class="header">
    <div class="header__body">
        <div class="header__top">
            <div class="header__top-list">
                <?php if(isset($_COOKIE['admin'])): ?>
                <div class="header__top-item">
                    <a href="#popup-sor">Добавить соревнование</a>
                </div>
                <?php endif; ?>
                <?php if(isset($_COOKIE['user'])): ?>
                <div class="header__top-item">
                    <a href="#popup-prof">
                        <i class="icon-user"></i>
                        <p>Личный кабинет</p>
                    </a>
                </div>
                <?php endif; ?>
                <?php if(empty($this->valueUserCookie)):?>
                <div class="header__top-item">
                    <a href="#popup-into">Войти</a>
                </div>
                <div class="header__top-item">
                    <a href="#popup-reg">Регистрация</a>
                </div>
                <?php endif; ?>
                <?php if(isset($_COOKIE['admin'])): ?>
                    <div class="header__top-item">
                        <a href="http://powerlift/?command=out">Выйти</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="header__content">
            <div class="header__content-title">
                Powerlifting
            </div>
        </div>
    </div>
</div>