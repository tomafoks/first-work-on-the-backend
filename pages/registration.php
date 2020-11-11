<?php
require_once "./php/class.registration.php";
$reg = new RegistartionUser();
$title = 'Регистрация';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['Password'] == '' or $_POST['Password'] != $_POST['PasswordConfirm']) {
        $title = 'Пароли не совподают';
    } else {
        if(!$reg->addNewUser())
            $title = 'Такой майл существует';
        else 
            $title = 'Спасибо за регистрацию';
    }
}
?>
<div class="col-p-v">
    <h1>
        <?= $title ?>
    </h1>
    <div class="breads cs-br-1">
        <div class="breads-item icon-right-open-after cs-t-3">
            <a itemprop="item" href="../index.php" class="breads-item-link cs-l-3"><span itemprop="name">Главная</span></a>—
        </div>
        <div class="breads-item"><span class="breads-item-current cs-t-1">Регистрация</span></div>
    </div>
    <div class="row between-xs">
        <div class="col-xs-7">
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" name="regForm">
                <label class="row middle-xs">
                    <span class="col-xs-4">
                        <span class="form-field-name vertical-interval-xsmall input-required">Имя:</span>
                    </span>
                    <span class="col-xs-8">
                        <span class="form-field-input vertical-interval-xsmall">
                            <input class="input-small" id="FirstName" name="FirstName" required="required" type="text" placeholder="Иван" />
                        </span>
                    </span>
                </label>
                <label class="row middle-xs">
                    <span class="col-xs-4">
                        <span class="form-field-name vertical-interval-xsmall input-required">Фамилия:</span>
                    </span>
                    <span class="col-xs-8">
                        <span class="form-field-input vertical-interval-xsmall">
                            <input class="input-small" id="LastName" name="LastName" required="required" type="text" placeholder="Иванов" />
                        </span>
                    </span>
                </label>
                <label class="row middle-xs">
                    <span class="col-xs-4">
                        <span class="form-field-name vertical-interval-xsmall input-required">E-Mail:</span>
                    </span>
                    <span class="col-xs-8">
                        <span class="form-field-input vertical-interval-xsmall">
                            <input class="input-small" id="Email" name="Email" pattern="^([a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+)|(admin)$" required="required" type="email" placeholder="ivanich@mail.ru" />
                        </span>
                    </span>
                </label>
                <label class="row middle-xs">
                    <span class="col-xs-4">
                        <span class="form-field-name vertical-interval-xsmall input-required">Контактный телефон:</span>
                    </span>
                    <span class="col-xs-8">
                        <span class="form-field-input vertical-interval-xsmall">
                            <input class="input-small" id="Phone" name="Phone" type="text" placeholder="+7951*******" />
                        </span>
                    </span>
                </label>
                <label class="row middle-xs">
                    <span class="col-xs-4">
                        <span class="form-field-name vertical-interval-xsmall input-required">Пароль:</span>
                    </span>
                    <span class="col-xs-8">
                        <span class="form-field-input vertical-interval-xsmall">
                            <input class="input-small" id="Password" name="Password" type="password" />
                        </span>
                    </span>
                </label>
                <label class="row middle-xs">
                    <span class="col-xs-4">
                        <span class="form-field-name vertical-interval-xsmall input-required">Пароль (ещё раз):</span>
                    </span>
                    <span class="col-xs-8">
                        <span class="form-field-input vertical-interval-xsmall">
                            <input class="input-small" id="PasswordConfirm" name="PasswordConfirm" type="password" />
                        </span>
                    </span>
                </label>
                <div class="row middle-xs">
                    <div class="col-xs-offset-4 col-xs-8 col-p-v">
                        <input type="submit" class="btn btn-submit btn-middle group-reg" value="Зарегистрироваться" />
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-4">
            <div class="block-alt cs-bg-3">
                <div class="form-addon-text">
                    <div class="static-block">
                        <div class="title">Зачем нужна регистрация?</div>
                        <div class="new-user-text">Зарегистрировавшись на сайте Вы сможете получить личный кабинет, что
                            позволит Вам отслеживать историю заказов, быстрее оформлять заказы в нашем Интернет
                            магазине, так как вся информация о Вас будет доступна в нашем магазине и ее не нужно будет
                            повторно вносить</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>