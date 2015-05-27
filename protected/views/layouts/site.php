<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="ru" />
    <title><?php echo $this->pageTitle;?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox.css" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/KitAnimate.css" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" type="text/css">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jssor.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jssor.slider.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/TweenMax.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/swipe.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/carousel.lite.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/KitProgress.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/KitAnimate.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/device.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/KitSend.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
    <?php foreach ($this->scripts AS $script): ?><script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/<?php echo $script?>.js"></script><? endforeach; ?>
</head>
<body>
    <div class="b b-1">
        <div class="b-block clearfix">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/i/logo.png">
        </div>
    </div>
    <div class="b b-2">
        <div class="b-block ">
            <div class="header clearfix">
                <div class="left clearfix">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/i/str-1.png">
                    <h2>Личный Кабинет</h2>
                </div>
                <div class="clearfix right">
                    <h4><? echo $this->user->usr_name; ?></h4>
                    <h3><?=$this->adminMenu["cur"]->name?></h3>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/i/blue-str.png">
                </div>
            </div>
            <div class="clearfix">
                <div class="left">
                    <ul class="b-menu">
                        <?foreach ($this->adminMenu["items"] as $i => $menuItem):?>
                            <? if( $menuItem->code=="inst" ): ?>
                                <li data-name="<?=$menuItem->code?>" class="clearfix b-menu-instruction"><div class="b-menu-img"></div><a href="<?php echo $this->createUrl('/'.$menuItem->code.'/Index')?>"><?=$menuItem->name?></a></li>
                            <?endif;?>
                        <?endforeach;?>
                       <!--  <li class="clearfix b-menu-instruction active"><div class="b-menu-img"></div><a href="#">Инструкция</a></li>                        
                        <li class="clearfix b-menu-news"><div class="b-menu-img"></div><a href="#">Новости</a></li>
                        <li class="clearfix b-menu-expense"><div class="b-menu-img"></div><a href="#">Мой счет</a></li>
                        <li class="clearfix b-menu-agreement"><div class="b-menu-img"></div><a href="#">Договора</a></li>
                        <li class="clearfix b-menu-data"><div class="b-menu-img"></div><a href="#">Мои данные</a></li>
                        <li class="clearfix b-menu-referrals"><div class="b-menu-img"></div><a href="#">Мои рефералы</a></li>
                        <li class="clearfix b-menu-settings"><div class="b-menu-img"></div><a href="#">Настройки кабинета</a></li>
                        <li class="clearfix b-menu-support"><div class="b-menu-img"></div><a href="#">Служба поддержки</a></li>
                        <li class="clearfix b-menu-exit"><div class="b-menu-img"></div><a href="#">Выход</a></li>   -->                     
                    </ul>
                </div>
                <div class="right content">
                    <?php echo $content;?>
                </div>
            </div>
        </div>
    </div>
<div style="display:none;">
    <div id="b-popup-1">
            <div class="for_all b-popup" >
                <h3>Оставьте заявку</h3>
                <h4>и наши специалисты<br>свяжутся с Вами в ближайшее время</h4>
                <form action="kitsend.php" method="POST" id="b-form-1" data-block="#b-popup-1">
                    <div class="b-popup-form">
                        <label for="name">Введите Ваше имя</label>
                        <input type="text" id="name" name="name" required/>
                        <label for="tel">Введите Ваш номер телефона</label>
                        <input type="text" id="tel" name="phone" required/>
                        <input type="hidden" name="subject" value="Заказ"/>
                        <input type="submit" class="ajax b-orange-butt" value="Заказать">
                    </div>
                </form>
            </div>
        </div>
        <div id="b-popup-2">
            <div class="b-thanks b-popup">
                <h3>Спасибо!</h3>
                <h4>Ваша заявка успешно отправлена.<br/>Наш менеджер свяжется с Вами в течение часа.</h4>
                <input type="submit" class="b-orange-butt" onclick="$.fancybox.close(); return false;" value="Закрыть">
            </div>
        </div>
        <div id="b-popup-error">
            <div class="b-thanks b-popup">
                <h3>Ошибка отправки!</h3>
                <h4>Приносим свои извинения. Пожалуйста, попробуйте отправить Вашу заявку позже.</h4>
                <input type="submit" class="b-orange-butt" onclick="$.fancybox.close(); return false;" value="Закрыть">
            </div>
        </div>
    </div>
</body>
</html>