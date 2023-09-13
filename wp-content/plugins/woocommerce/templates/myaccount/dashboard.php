<!--3 коммит-->

<!-- download-ajax.php -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->

<!--<script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>-->


<!--dashboard.php-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script <!---->src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.js"></script>

<!--<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">



<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<script src="https://use.fontawesome.com/87f83dec41.js"></script>


<!--<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>-->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<!--модалка-->
<div class="modal">
    <div class="modal-wrapper">
        <img id="my-image" src="#"/>
    </div>
    <input class=" button view" id="cancel" type="button" value="Отмена">
    <button class="button view" id="use">Готово</button>
    <!--<input class="button view" id = "done" type="button" value="Готово">  -->
    <img id="result" src="">
</div>


<?php


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
/* translators: 1: user display name 2: logout url */
printf(
    __('Добро пожаловать,  %1$s', 'woocommerce'),
    '<strong>' . esc_html($current_user->display_name) . '</strong>' . ".",
    esc_url(wc_logout_url(wc_get_page_permalink('myaccount')))
);
//printf(
//    __('Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce'),
//    '<strong>' . esc_html($current_user->display_name) . '</strong>',
//    esc_url(wc_logout_url(wc_get_page_permalink('myaccount')))
//);

include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/woocommerce/templates/myaccount/shedule/config.php';
$cur_user_id = get_current_user_id();
$new_month = ($curdate[5] . $curdate[6]) - 1;
if (strlen($new_month) == 1) {
    $new_month = '0' . $new_month;
}
$curdate = $curdate[0] . $curdate[1] . $curdate[2] . $curdate[3] . $curdate[4] . $new_month . $curdate[7] . $curdate[8] . $curdate[9];


//Обработка дня рождения из бд
$default_birthday = function ($birthday_player) {
    if ($birthday_player == null || $birthday_player == "0000-00-00") {
        $birthday_player = "<span style='visibility: hidden'>none</span>";
    } else {
        $birthday_player = $birthday_player[5] . $birthday_player[6] . "/" . $birthday_player[8] . $birthday_player[9] . "/" . $birthday_player[0] . $birthday_player[1] . $birthday_player[2] . $birthday_player[3];
    }
    return $birthday_player;
};
$birthday_player = $default_birthday($birthday_player);

//Определение администратора
$sql = "SELECT meta_value FROM `wp_users`
LEFT JOIN wp_usermeta on wp_usermeta.user_id = wp_users.ID
WHERE wp_users.id = '" . $cur_user_id . "' and meta_key = 'wp_user_level'";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $pravo[] = array(
        'meta_value' => $row['meta_value']);
}

//получение данных с чек бокса
$sql = "SELECT type FROM `one_pay`";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $check_status = $row['type'];
};
$admin = $pravo[0]['meta_value'] == 10;


$main_sheduled = " <div class='main-sheduled'>
        <span class='sheduled'></span>
        <span class='shedule-name'> - Тренировка</span>
        <span class='sheduled-paid'></span>
        <span class='shedule-name'> - Оплаченная тренировка</span>
        <span class='sheduled-disease'></span>
        <span class='shedule-name'> - Заморозка</span>
    </div>";


if ($admin) {
if ($check_status == 1) {
    $check = "checked";
}

//$del_number = function ($test) {
//    $first_simvol = $test[0];
//    if ($first_simvol == 1 || $first_simvol == 2 || $first_simvol == 3 || $first_simvol == 4 || $first_simvol == 5 || $first_simvol == 6 || $first_simvol == 7 || $first_simvol == 8 || $first_simvol == 9)
//    {
//        $test = preg_replace('/^\S+ /', '', $test);
//    }
//    return $test;
//};
//
//
//$tesname = "1. Устьян Евгений";
//echo "<pre>";
//print_r($tesname);
//echo "</pre>";
//
//$tesname = $del_number($tesname);
//echo "<pre>";
//print_r($tesname);
//echo "</pre>";
//
//$tesname = $del_number($tesname);
//echo "<pre>";
//print_r($tesname);
//echo "</pre>";


echo <<<_END
   <!--  <div>
    <label>
    <input type='checkbox' id='pay-one-day' . $check> Оплаты за 1 день</label>
    </div> -->
   <!--<button class="woocommerce-button button view student setup_sheduled" id="defaultSetupPrukon">Сброс значений Устьяна Е.А.</button>  -->
    
    <!--<p>-->
    <!--<button class="woocommerce-button button view student setup_sheduled" id="defaultSetup">Сброс значений</button>-->

    <!--<button class="woocommerce-button button view student setup_sheduled" id="insert_pay">Установка оплаты</button>-->
    <br>
    
    
    <!--Скрыл обновление счетчиков 05.09.2021-->
    <!--Ежегобное обновление-->
<!--<button class="woocommerce-button button view student setup_sheduled" id="setup_pay31">обновление счетчиков</button>-->  
_END;


echo "<h4 class='header_main'>Выбор ученика:</h4>";


//выбор всех студентов в селект
$sql = "SELECT id, display_name
FROM `wp_users`
LEFT JOIN wp_usermeta on wp_usermeta.user_id = wp_users.ID
WHERE meta_key = 'wp_user_level'
and meta_value !=10
 ORDER BY display_name ASC";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $players[] = array(
        'id' => $row['id'],
        'display_name' => $row['display_name'],
    );
};

$user_list = function ($players) {
    echo "<select class='student' id='change_student'>";
    echo "<option></option>";
    $x = 1;
    foreach ($players as $result => $row) {
        echo "<option>";
        echo $x . ". " . $row['display_name'];
        echo "</option>";
        $x = $x + 1;
    }
    echo "</select>";
};
$user_list($players);




//новый вывод групп
//выбор всех групп в селект
$sql = "SELECT *
FROM `team`
where Enable = 1
ORDER BY order_by ASC";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $teams[] = array(
        'id' => $row['id'],
        'display_name' => $row['display_name'],
        'Enable' => $row['Enable'],
        'order_by' => $row['order_by'],


    );
};


//array_push($teams, array('1110' => ['id' => '10000', 'display_name' => 'Все', 'Enable' => '1']);
array_unshift($teams, ['id' => '10000', 'display_name' => 'Все', 'Enable' => '1', 'order_by' => 0]);

//echo "<pre>";
//print_r($teams);
//echo "</pre>";

;
$team_list = function ($teams) {
    echo "<span class=\"change_team_wrapper\">";
    echo " <select class='change_team student' id=\"change_team\">";
    $x = 1;
    foreach ($teams as $result => $row) {
        echo '<option title="' . $row['id'] . '">';
        //   echo $x . ". " . $row['display_name'];
        echo  $x .'. '  . $row['display_name'];

        echo "</option>";
        $x = $x + 1;
    }
    echo "</select>";
    echo "</span>";
};
$team_list($teams);


?>



    <!--старый вывод групп-->
    <!--    <span class="change_team_wrapper">-->
    <!--         <select class='change_team student' id="change_team">-->
    <!--        <option>Все</option>-->
    <!--            <option>Барселона</option>-->
    <!--        <option>Барс</option>-->
    <!--        <option>Сокол</option>-->
    <!--        <option>Шторм</option>-->
    <!--        <option>Алмаз</option>-->
    <!--        <option>Буран</option>-->
    <!--        <option>Милан</option>-->
    <!--        <option>Легион</option>-->
    <!--        <option>Галактикос</option>-->
    <!--        <option>Исток 630</option>-->
    <!--    </select>-->
    <!--    </span>-->

<input id="inlineCalendar" type="text">
    <i class="fa fa-calendar" aria-hidden="true"></i>
    <button class="woocommerce-button button view student setup_sheduled setup_sheduled-dashbord" id="setupShedule">
        Установить
    </button>


    <script type="text/javascript">
        try {
            $(function () {
                $('#inlineCalendar').datepicker({
                    firstDay: 1,
                    dateFormat: "dd.mm.yy",
                    defaultDate: new Date(),
                    monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                    dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
                    dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
                    dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                });
                $('#inlineCalendar').datepicker('setDate', new Date());
            });
        } catch (e) {

        }

    </script>
    </head>
<body>
<script>
    function GetData() {
        // получаем индекс выбранного элемента
        var selind = document.getElementById("change_student").options.selectedIndex;
        var txt = document.getElementById("change_student").options[selind].text;
        var val = document.getElementById("change_student").options[selind].value;
        return txt;
    }
</script>
<div class="week_day_box">
    <label><p class="week_day hide_day" name="Пн">
            <input class="day_1 input" type="checkbox" value="Пн"> Понедельник</p></label>
    <label><p class="week_day hide_day" name="Вт">
            <input class="day_2" type="checkbox" value="Вт"> Вторик</p></label>
    <label><p class="week_day hide_day" name="Ср">
            <input class="day_3" type="checkbox" value="Ср"> Среда</p></label>
    <label><p class="week_day hide_day" name="Чт">
            <input class="day_4" type="checkbox" value="Чт"> Четверг</p></label>
    <label><p class="week_day hide_day" name="Пт">
            <input class="day_5" type="checkbox" value="Пт"> Пятница</p></label>
    <label><p class="week_day hide_day" name="Сб">
            <input class="day_6" type="checkbox" value="Сб"> Суббота</p></label>
    <label><p class="week_day hide_day" name="Вск">
            <input class="day_7" type="checkbox" value="Вск"> Воскресенье</p></label>
</div>


<?php

if ($avatar_crop == null) {
    $avatar_crop = "default.png";

    echo <<<_END
<div class="avatar_wrapper">
    <div class="left_avatar">
        <div class="avatar_student">
        <img src="https://fc-istok.kidslink.ru/wp-content/uploads/avatars/$avatar_crop">
_END;
} else

    echo <<<_END
<div class="avatar_wrapper">
    <div class="left_avatar">
        <div class="avatar_student">
        <a data-fancybox="gallery" class="fancybox" title="Lorem ipsum" href="https://fc-istok.kidslink.ru/wp-content/uploads/avatars/$avatar_image">
        <img src="https://fc-istok.kidslink.ru/wp-content/uploads/avatars/$avatar_crop">
        </a>
_END;


echo <<<_END
<form id="form1" runat="server"  enctype="multipart/form-data" action="/wp-content/plugins/woocommerce/templates/myaccount/shedule/main-controller.php" method="POST">


<input type='file' id="imgInp" name="avatarka" />



<input type="submit" class="button view download-avatar" value="Загрузить">  
  <img id="my-image" src="#" />
</form>
</div>
    </div>
    <div class="rigt_avatar">
        <div class="description_name">
            <ul class="header_main">
            <li>ГРУППА:</li>
            <li>ДАТА РОЖДЕНИЯ:</li>
            <li>КОЛИЧЕСТВО ТРЕНИРОВОК:</li>
            <!--<li>№ ИГРОКА:</li>-->
            <!--<li>КОЛИЧЕСТВО СЫГРАННЫХ ИГР:</li>-->
            <!--<li>ПРОЙДЕННЫХ СПОРТИВНЫХ СБОРОВ:</li>--> 
            </ul>
        </div>
        <div class="description_value">
             <ul class="header_main">
            <li id = "team"> <span class="teamName">$team_display_name</span> <span class="teamChange">(изменить)</span>  </li>
            <li id = 'birthday'> <input id="birthdaycalendar" type="text"></li> 
            <li id = "count_training">$count_training</li> 
            <!--<li>11</li>-->
            <!--<li>3</li>-->
            <!--<li>2</li>-->
            </ul>
     
</div>
</div>    
</div>
_END;

echo "<h5 class='header_main'>Расписание:</h5>";
//echo $main_sheduled;


}
else {
    ?>
    <script>
        var menu = document.querySelectorAll('.woocommerce-MyAccount-navigation ul li');
        menu[2].style.display = 'none';
    </script>
    <?php


    $block_date = date("Y-m-d");

//получение данных о количестве тренировок
    $sql = "SELECT COUNT(id) as count
FROM `schedule`
WHERE `wp_users_id` = '$cur_user_id' and
    schedule !='0' 
     and `scheduledate` < '$block_date'
     ";


//получение данных о количестве тренировок
//    $sql = "SELECT COUNT(id) a count
//FROM `schedule`
//WHERE `wp_users_id` = '$cur_user_id' and
//    schedule !='0'
//     and `scheduledate` > $block_date";


    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $count_training = $row['count'];
    };


    $count_training = $count_training + 1;
    if ($count_training < 0) {
        $count_training = 0;
    }

//получение данных о группе
    $sql = "
    SELECT  team.id, team.display_name
FROM `wp_users`
LEFT JOIN team on team.id = wp_users.team
WHERE wp_users.ID ='" . $cur_user_id . "' ";
    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $team_id = $row['id'];
        $team_display_name = $row['display_name'];
    };

//    echo "<pre>";
//    print_r($team_id);
//    echo "</pre>";



    //получение данных о дне рождения
    $sql = "
    SELECT *
FROM `wp_users` WHERE wp_users.ID ='" . $cur_user_id . "' ";
    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $birthday_player = $row['birthday'];
        $avatar_image = $row['avatar'];
        $avatar_crop = $row['avatarcrop'];
    };
    $birthday_player = $default_birthday($birthday_player);


//устьян Е.А.


    if ($avatar_crop == null) {
        $avatar_crop = "default.png";

        echo <<<_END
<div class="avatar_wrapper">
    <div class="left_avatar">
        <div class="avatar_student">
        <img src="https://fc-istok.kidslink.ru/wp-content/uploads/avatars/$avatar_crop">
_END;
    } else

        echo <<<_END
<div class="avatar_wrapper">
    <div class="left_avatar">
        <div class="avatar_student">
        <a data-fancybox="gallery" class="fancybox" title="Lorem ipsum" href="https://fc-istok.kidslink.ru/wp-content/uploads/avatars/$avatar_image">
        <img src="https://fc-istok.kidslink.ru/wp-content/uploads/avatars/$avatar_crop">
        </a>
_END;


    echo <<<_END
<form id="form1" runat="server"  enctype="multipart/form-data" action="/wp-content/plugins/woocommerce/templates/myaccount/shedule/main-controller.php" method="POST">


<input type='file' id="imgInp" name="avatarka" />



<input type="submit" class="button view download-avatar" id="sendfullavatar" value="Загрузить">  
  <img id="my-image" src="#" />
</form>

    <!--<div class="file_upload">-->
        <!--<button type="button">Выбрать</button>-->
        <!--<div>Файл не выбран</div>-->
        <!--<input type="file">-->
    <!--</div>-->

</div>
    </div>
<!--    Изменение правой колонки у юзера)-->
    <div class="rigt_avatar">
        <div class="description_name">
            <ul class="header_main">
            <li>ГРУППА:</li>
            <li>ДАТА РОЖДЕНИЯ:</li>
            <li>КОЛИЧЕСТВО ТРЕНИРОВОК:</li>
            <!--<li>№ ИГРОКА:</li>-->
            <!--<li>КОЛИЧЕСТВО СЫГРАННЫХ ИГР:</li>-->
            <!--<li>ПРОЙДЕННЫХ СПОРТИВНЫХ СБОРОВ:</li>-->
            </ul>
        </div>
        <div class="description_value">
             <ul class="header_main">
            <li id = "team">$team_display_name</li>
            <li> <input id="birthdaycalendar" placeholder='__.__.____' type="text">  </li>
           
            <li>$count_training</li>
            <!--<li>11</li>-->
            <!--<li>3</li>-->
            <!--<li>2</li>-->
            </ul>
</div>
</div>    
</div>
_END;


//    echo "<h5>Всего тренировок: $count_training </h5>";
//    echo "<h5>Ваша группа: $team_display_name </h5>";
    echo "<h5 class='header_main'>Ваше расписание:</h5>";
//    echo $main_sheduled;
}


//Обработка даты расписания из БД Сбор тренировок
$sql = "SELECT  `wp_users_id`, `scheduledate`, `schedule` FROM `schedule` WHERE `wp_users_id` = '" . $cur_user_id . "' AND schedule = 1";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $only_date[] = $row['scheduledate'];
};

//пересобираем дату в JSON
$grouped = [];
foreach ($only_date as $d) {
    $parts = explode('-', $d);
    $grouped[$parts[0]][intval($parts[1])][] = intval($parts[2]);
}
$collectionDays = function ($a, $type) {                    //выбираем дни из даты и записываем в массив
    if ($type == 1) {
        //   $num1 = $a[$i][8] . $a[$i][9];
    }
    if ($type == 1) {
        //  $num1 = $a[$i][8] . $a[$i][9];
    }

    for ($i = 0; $i < count($a); $i++) {
        $num1 = $a[$i][8] . $a[$i][9];
        $num1 = (int)$num1;
        $days[] = $num1;
    }
    return $days;
};
$collectionMonths = function ($a) {                    //выбираем дни из даты и записываем в массив
    for ($i = 0; $i < count($a); $i++) {
        $num1 = $a[$i][5] . $a[$i][6];
        $num1 = (int)$num1;
        $months[] = $num1;
    }
    return $months;
};

//замены для пустых дат
$nulldate = ["0" => 7];
$null_grouped = [2019 => [1 => [0 => 1]],
    2020 => [1 => [0 => 1]]];


//$null_grouped_2019 = [2019 => [1 => [0 => 1]]];


$shedule_days = $collectionDays($only_date);
$shedule_months = $collectionMonths($only_date);


//Обработка даты расписания из БД Сбор больничных
$sql = "SELECT * FROM `schedule` WHERE wp_users_id =  '" . $cur_user_id . "' and hospital = '1'";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $only_date_hospital[] = $row['scheduledate'];
};
//пересобираем дату в JSON
$grouped_hospital = [];
foreach ($only_date_hospital as $d) {
    $parts = explode('-', $d);
    $grouped_hospital[$parts[0]][intval($parts[1])][] = intval($parts[2]);
}

//$collectionDays = function ($a) {                    //выбираем дни из даты и записываем в массив
//    for ($i = 0; $i < count($a); $i++) {
//        $num1 = $a[$i][8] . $a[$i][9];
//        $num1 = (int)$num1;
//        $days[] = $num1;
//    }
//    return $days;
//};
//замены для пустых дат
//$nulldate = ["0" => 7];
//$null_grouped = [2018 => [1 => [0 => 1]]];
$shedule_days = $collectionDays($only_date_hospital);

//$collectionMonths = function ($a) {                    //выбираем дни из даты и записываем в массив
//    for ($i = 0; $i < count($a); $i++) {
//        $num1 = $a[$i][5] . $a[$i][6];
//        $num1 = (int)$num1;
//        $months[] = $num1;
//    }
//    return $months;
//};
$shedule_months = $collectionMonths($only_date);


//Обработка даты расписания из БД Сбор оплаченных
$sql = "SELECT * FROM `schedule` WHERE wp_users_id =  '" . $cur_user_id . "' and paid = '1'";
$result = $pdo->query($sql);
foreach ($result as $row) {
    $only_date_paid[] = $row['scheduledate'];
};
//пересобираем дату в JSON
$grouped_paid = [];
foreach ($only_date_paid as $d) {
    $parts = explode('-', $d);
    $grouped_paid[$parts[0]][intval($parts[1])][] = intval($parts[2]);
}
//echo "<pre>";
//print_r($grouped_paid);
//echo "</pre>";

//$collectionDays = function ($a) {                    //выбираем дни из даты и записываем в массив
//    for ($i = 0; $i < count($a); $i++) {
//        $num1 = $a[$i][8] . $a[$i][9];
//        $num1 = (int)$num1;
//        $days[] = $num1;
//    }
//    return $days;
//};
//замены для пустых дат
//$nulldate = ["0" => 7];
//$null_grouped = [2018 => [1 => [0 => 1]]];
//$shedule_days = $collectionDays($only_date_hospital);


//$collectionMonths = function ($a) {                    //выбираем дни из даты и записываем в массив
//    for ($i = 0; $i < count($a); $i++) {
//        $num1 = $a[$i][5] . $a[$i][6];
//        $num1 = (int)$num1;
//        $months[] = $num1;
//    }
//    return $months;
//};
//$shedule_months = $collectionMonths($only_date);


?>
<div class="main-schedule" align=center>
    <div class="calendar-schedule">
        <table id="calendar" border="0" cellspacing="0" cellpadding="1">
            <thead>
            <tr>
                <td class="swith"><b>‹</b>
                <td class="month" colspan="5">
                <td class="swith"><b>›</b>
            <tr>
                <td>Пн</td>
                <td>Вт</td>
                <td>Ср</td>
                <td>Чт</td>
                <td>Пт</td>
                <td>Сб</td>
                <td>Вск</td>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<span hidden="true" id="comment"><textarea id="commentArea" placeholder="Текст комментария" cols="30"
                                           rows="10"></textarea></span>

<!--Контекстное меню-->
<nav id="context-menu" class="context-menu">
    <ul class="context-menu__items">
        <li class="context-menu__item">
            <a href="#" id="hospital" class="context-menu__link" data-action="hospital">
                <i class="fa fa-edit"></i>
                Заморозка</a>
        </li>
        <li class="context-menu__item">
            <a href="#" id="add_training" class="context-menu__link" data-action="add_training">
                <i class="fa fa-edit"></i>
                Добавление тренировки</a>
        <li class="context-menu__item">
            <a href="#" id="delete_training" class="context-menu__link" data-action="Delete">
                <i class="fa fa-times"></i>
                Удаление тренировки</a>
        </li>
        </li>
        <li class="context-menu__item">
            <a href="#" id="add_paid" class="context-menu__link" data-action="hospital">
                <i class="fa fa-edit"></i>
                Добавление оплаты</a>
        </li>

        <li class="context-menu__item">
            <a href="#" id="delete_paid" class="context-menu__link" data-action="Delete">
                <i class="fa fa-times"></i>
                Удаление оплаты</a>
        </li>
    </ul>
</nav>


<h4 class="say-of-pay">Друзья, просьба оплачивать занятия своевременно до 15 числа каждого месяца.</h4>

<script>
    sheduleDate = null;
    sheduleDate_hospital = null;
    sheduleDate_paid = null;


    var birthday_player = <?php  echo json_encode($birthday_player) ?>;
    var cur_user_id = <?php  echo json_encode($cur_user_id) ?>;

    var sheduleDate = <?php  echo json_encode($grouped) ?>;
    var sheduleDate_hospital = <?php  echo json_encode($grouped_hospital) ?>;
    var sheduleDate_paid = <?php  echo json_encode($grouped_paid) ?>;


    var current_days = <?php  echo json_encode($shedule_days) ?>;
    var nulldate = <?php  echo json_encode($nulldate) ?>;
    var null_grouped = <?php  echo json_encode($null_grouped) ?>;
    // var null_grouped_2019 = <?php  echo json_encode($null_grouped_2019) ?>;

    var current_months = <?php  echo json_encode($shedule_months) ?>;
    var all_days = <?php  echo json_encode($a)?>;

    if (current_days == null || current_months == null) {
        current_days = nulldate;
        current_months = nulldate;
    }

    function calendar(id, year, month) {
        var Dlast = new Date(year, month + 1, 0).getDate(),
            D = new Date(year, month, Dlast),
            DNlast = new Date(D.getFullYear(), D.getMonth(), Dlast).getDay(),
            DNfirst = new Date(D.getFullYear(), D.getMonth(), 1).getDay(),
            calendar = '<tr>',
            month = [];
        month[1] = "Январь";
        month[2] = "Февраль";
        month[3] = "Март";
        month[4] = "Апрель";
        month[5] = "Май";
        month[6] = "Июнь";
        month[7] = "Июль";
        month[8] = "Август";
        month[9] = "Сентябрь";
        month[10] = "Октябрь";
        month[11] = "Ноябрь";
        month[12] = "Декабрь";

        month = month.slice(1, 13);

        if (current_days == null || current_months == null) {
            current_days = nulldate;
            current_months = nulldate;
        }


        if (DNfirst != 0) {
            for (var i = 1; i < DNfirst; i++) calendar += '<td>';
        } else {
            for (var i = 0; i < 6; i++) calendar += '<td>';
        }
        var a = {month: $("[data-month]").attr('data-month') + 1};


        for (var i = 1; i <= Dlast; i++) {
            if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
                calendar += '<td class="today day">' + i;
            }
            // else if (current_days.indexOf(i) != -1 && current_months.indexOf(D.getMonth()) != -1) {
            //     calendar += '<td>' + i;
            // }

            else {
                calendar += '<td class="day">' + i;
            }
            if (new Date(D.getFullYear(), D.getMonth(), i).getDay() == 0) {
                calendar += '<tr>';
            }
        }
        for (var i = DNlast; i < 7; i++) calendar += '<td> ';
        document.querySelector('#' + id + ' tbody').innerHTML = calendar;
        document.querySelector('#' + id + ' thead td:nth-child(2)').innerHTML = month[D.getMonth()] + ' ' + D.getFullYear();
        document.querySelector('#' + id + ' thead td:nth-child(2)').dataset.month = D.getMonth() + 1;
        document.querySelector('#' + id + ' thead td:nth-child(2)').dataset.year = D.getFullYear();
        if (document.querySelectorAll('#' + id + ' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
            document.querySelector('#' + id + ' tbody').innerHTML += '<tr><td> <td> <td> <td> <td> <td> <td> ';
        }
    }


    //Обработка пустых тренировок и больничных
    var testsheduleDate = function (sheduleDate) {
        // console.log(sheduleDate);
        if (sheduleDate.length == 0) {
            //доделать
            sheduleDate = null_grouped;
            // var test_year =  $('#calendar td[data-year]').attr('data-year');
            // console.log(test_year);

            // if ($('#calendar td[data-year]').attr('data-year') == "2018") {
            //     sheduleDate = null_grouped;
            //     console.log("null_grouped - 2018");
            // }
            // if ($('#calendar td[data-year]').attr('data-year') == "2019") {
            //     sheduleDate = null_grouped_2019;
            //     console.log("null_grouped - 2019");
            // }
        }
        // if (sheduleDate == NULL) {
        //     sheduleDate = null_grouped;
        // }
        return sheduleDate;
    };

    sheduleDate = testsheduleDate(sheduleDate);
    sheduleDate_hospital = testsheduleDate(sheduleDate_hospital)
    sheduleDate_paid = testsheduleDate(sheduleDate_paid)


    calendar("calendar", new Date().getFullYear(), new Date().getMonth());


    // переключатель минус месяц
    document.querySelector('#calendar thead tr:nth-child(1) td:nth-child(1)').onclick = function () {
        calendar("calendar", document.querySelector('#calendar thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar thead td:nth-child(2)').dataset.month) - 2);


    }
    // переключатель плюс месяц
    document.querySelector('#calendar thead tr:nth-child(1) td:nth-child(3)').onclick = function () {
        calendar("calendar", document.querySelector('#calendar thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar thead td:nth-child(2)').dataset.month));
    }
    //закрашивание ячеек в календаре
    var tableColor = function () {
        try {
            $("#calendar td").each(function () {
                if ($(this).text() == 1) {
                    if ($('table .month').attr('data-month') == 1) {
                        $(this).addClass('defaulday');
                    }
                }
                if (parseInt($(this).text())) {
                    var yearMonth = sheduleDate[$('#calendar td[data-year]').attr('data-year')][$('#calendar td[data-month]').attr('data-month')];
                    if (yearMonth) {
                        if (yearMonth.indexOf(parseInt($(this).text())) !== -1) {
                            $(this).addClass('scheduleday')
                        }
                    }
                }
            })
        } catch (e) {
        }
    }
    tableColor();
    var tableColor_hospital = function () {
        try {
            $("#calendar td").each(function () {
                if (parseInt($(this).text())) {
                    var yearMonth_hospital = sheduleDate_hospital[$('#calendar td[data-year]').attr('data-year')][$('#calendar td[data-month]').attr('data-month')];
                    if (yearMonth_hospital) {
                        if (yearMonth_hospital.indexOf(parseInt($(this).text())) !== -1) {
                            $(this).addClass('hospitalday')
                        }
                    }
                }
            })
        } catch (e) {
        }
    }
    tableColor_hospital();
    var tableColor_paid = function () {
        try {
            $("#calendar td").each(function () {
                if (parseInt($(this).text())) {
                    var yearMonth_paid = sheduleDate_paid[$('#calendar td[data-year]').attr('data-year')][$('#calendar td[data-month]').attr('data-month')];
                    if (yearMonth_paid) {
                        if (yearMonth_paid.indexOf(parseInt($(this).text())) !== -1) {
                            $(this).addClass('paidday')
                        }
                    }
                }
            })
        } catch (e) {
        }

    }
    tableColor_paid();

    //Удаление класса с ячейки (удаление тренировки)
    var delete_tableColor = function (n, type) {
        if (type == 1) {
            type_class = "scheduleday";
        }
        if (type == 2) {
            type_class = "paidday";
        }
        if (type == 3) {
            type_class = "hospitalday";
        }
        if (n > 0) {
            $('#calendar td').each(function () {
                if ($(this).text() == n) {
                    $(this).removeClass(type_class);
                }
            })
        }
        if (n == "all") {                 //Если n = all то удаляются все строки
            $('#calendar td').each(function () {
                $(this).removeClass(type_class);
            })
        }
    }


    //Добавление класса больничного к ячейке
    var hospital_tableColor = function (n) {
        $('#calendar td').each(function () {
            if ($(this).text() == n) {
                $(this).addClass("hospitalday");
            }
        })
    }

    //установка галочек во всем календаре
    var tableTick = function () {
        $("#calendar td").each(function () {

            if (parseInt($(this).text())) {

                //установка галочек комента
                for (let i in result) {
                    if (parseInt(i) && result[i] == 'day') {
                        $('td').each(function (j, el) {
                            if ($.trim($(el).text()) == i) {
                                if ($('.shedule-comment.length')) {
                                    if (i.length == 1) {
                                        $(this).append("<span class='shedule-comment'></span>");
                                    } else {
                                        $(this).append("<span class='shedule-comment-2'></span>");
                                    }
                                }
                            }
                        });
                    }
                }
            }
        })
    }
    tableColor()
    //вызов закрашивая ячеек при смене месяца
    $("td.swith").click(function () {
        tableColor();
        tableColor_hospital();
        tableColor_paid();
    })
    //вызов блока для ввода комментария
    let selectedtd;
    $(document).on('click', '#calendar td', function () {
        if (parseInt($(this).text())) {
            //выключение комментария
            // $('#comment').attr('hidden', false);
            // selectedtd = this.innerHTML
        }
    });
    //передача данных для комментария
    $(document).on('click', function (evt) {

        if (!$(evt.target).closest('textarea,td').length) {
            if ($('#commentArea:visible').length) {

                $.ajax({
                    url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
                    data: {
                        comment: $("#comment textarea").val(),
                        day: selectedtd,
                        month: $("[data-month]").attr('data-month'),
                        year: $("[data-year]").attr('data-year')
                    },
                    success: function (result) {
                        result = JSON.parse(result);

                        //установка галочек комента
                        for (let i in result) {
                            if (parseInt(i) && result[i] == 'day') {
                                $('td').each(function (j, el) {
                                    if ($.trim($(el).text()) == i) {
                                        if ($('.shedule-comment.length')) {
                                            if (i.length == 1) {
                                                $(this).append("<span class='shedule-comment'></span>");
                                            } else {
                                                $(this).append("<span class='shedule-comment-2'></span>");

                                            }
                                        }
                                    }
                                });
                            }
                        }
                    },
                    type: "POST"
                });
            }
            $('#comment').attr('hidden', true)
        }
    });
    //Установка оплат на 31.12
    $("#setup_pay31").click(function () {
        $.ajax({
            url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
            data: {
                setup_pay31: 1
            },
            success: function (result) {
                //location.reload();
            },
            type: "POST"
        });
    });


    //передача данных об установке расписания (Сброс)
    $("#defaultSetup").click(function () {
        $.ajax({
            url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
            data: {
                default: 1
            },
            success: function (result) {
                location.reload();
            },
            type: "POST"
        });
    });

    //Установка оплаченного дня (14 СЕНТЯБРЯ У УСТЬЯНА)
    // $("#insert_pay").click(function () {
    //     $.ajax({
    //         url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
    //         data: {
    //             insert_pay: 1
    //         },
    //         success: function (result) {
    //             location.reload();
    //         },
    //         type: "POST"
    //     });
    // });


    $(".week_day input").change(function () {
        check_have_chacked()
    })
    var checked = [];
    //передача данных об установке расписания (Установить)
    $("#setupShedule").click(function () {

        //Получение выбранных дней недели при установке дней недели (установка чек бокса)
        var checked = [];
        $('.week_day input:checkbox:checked').each(function () {
            checked.push($(this).val());
        });
//разблокировка кнопки при смене чек бокса
        // check_have_chacked()
        //  $("#setupShedule").prop("disabled", false);
        $.ajax({
            url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
            data: {
                // display_name: $("#change_student").val(),
                display_name: $("#change_student option:selected").text(),
                team: $("#change_team").val(),
                team_id: document.querySelector('.change_team_wrapper .select2-selection__rendered').attributes['title'].value,


                //type: $("#change_shedule").val(),
                date: $("#inlineCalendar").val(),
                checked: checked
            },
            success: function (result) {
                result = JSON.parse(result);
                window.sheduleDate = result.sheduleDate;
                window.team = result.team;

                sheduleDate = testsheduleDate(sheduleDate);
                sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                sheduleDate_paid = testsheduleDate(sheduleDate_paid);

                tableColor();
                tableColor_hospital();
                tableColor_paid();

                $('#team_name').html(team)
                // location.reload();
            },
            type: "POST"
        });
    });

    //Сброс дней недели по умолчанию
    var default_team_days = function () {
        $('.week_day input:checkbox').prop('checked', false);
    }


    // var adminPrice = document.querySelector('.price_admin');
    // var textDiv = document.createElement('div');
    // var textIcon = document.createElement('i');
    //
    // textDiv.className = "text";
    // textIcon.className = 'fa fa-chevron-down';
    // textDiv.innerHTML = "Сезон 2019 - 2020 г.";

    //Передача имени пользователя при смене селекта ученика (смена селекта ученика)
    var change_student = function (defaultDays) {
        $.ajax({
            url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
            data: {
                change_student_display_name: $("#change_student option:selected").text(),
            },
            success: function (result) {


                season2020 = document.querySelector('.season-2020').style.display = 'none';
                season2019 = document.querySelector('.season-2019').style.display = 'none';



                //Блкокировка кнопки
                $("#setupShedule").prop("disabled", true);
                //сброс группы
                //$('#change_team :nth-child(1)').attr("selected", "selected");

                //снятие всех чек боксов
                if (defaultDays == 1) {
                    default_team_days(); //сброс дней недели по умолчанию
                }
                result = JSON.parse(result);
                window.sheduleDate = result.sheduleDate;
                window.current_days = result.current_days;
                window.current_months = result.current_months;
                window.team = result.team;
                window.all_days = result.all_days;
                window.day_of_week = result.day_of_week;

                // window.all_days = result.$team_id_now;

                window.sheduleDate_hospital = result.sheduleDate_hospital;
                window.sheduleDate_paid = result.sheduleDate_paid;
                window.countTraining = result.countTraining;
                window.birthday_player = result.birthday_player;
                window.avatar_crop = result.avatar_crop;
                window.avatar_image = result.avatar_image;
                window.return_price = result.return_price;


                calendar("calendar", new Date().getFullYear(), new Date().getMonth());
                // переключатель минус месяц
                document.querySelector('#calendar thead tr:nth-child(1) td:nth-child(1)').onclick = function () {
                    calendar("calendar", document.querySelector('#calendar thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar thead td:nth-child(2)').dataset.month) - 2);
                }
                // переключатель плюс месяц
                document.querySelector('#calendar thead tr:nth-child(1) td:nth-child(3)').onclick = function () {
                    calendar("calendar", document.querySelector('#calendar thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar thead td:nth-child(2)').dataset.month));
                }

                sheduleDate = testsheduleDate(sheduleDate);
                sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                sheduleDate_paid = testsheduleDate(sheduleDate_paid);
                tableColor();

                tableColor_hospital();

                // tableColor_paid();

                $('#team_name').html(team)
                check_have_chacked()

                //апенд группы
                $('#team .teamName').text(team);
                //апенд даты рождения
                $('#birthday').text(birthday_player);
                //апенд кол-ва тренировок
                $('#count_training').text(countTraining);
                //апенд аватарки
                //$('#team').text(avatar_image);

                //вставка пустого поля в ДР
                if ($("#birthday").text() == " ") {
                    $("#birthday").append('<span  style="visibility: hidden">null</span>')
                }

                if (avatar_crop) {
                    //$('.avatar_student').html("<img src='https://fc-istok.kidslink.ru/wp-content/uploads/avatars/"+avatar_crop+"' >");


                    $('.avatar_student').html(" <a data-fancybox='gallery' class='fancybox'  href='https://fc-istok.kidslink.ru/wp-content/uploads/avatars/" + avatar_image + "'>\n" + "<img src=\"https://fc-istok.kidslink.ru/wp-content/uploads/avatars/" + avatar_crop + "\">\n" + "</a>");

                } else {
                    $('.avatar_student').html("<img src='https://fc-istok.kidslink.ru/wp-content/uploads/avatars/default.png' >");
                }
                $(".avatar_wrapper").removeClass("hide_day");


                <!--Ежегодное обновление-->
                var createSeason = function (year, description, cssClass) {
                    //вывод цены учеников
                    var adminPrice = document.querySelector(cssClass);


                    if (year == 2019) {
                        for (var i = 0; i < 12; i++) {
                            // Если стоимость не указана - вовзращать 0
                            if (return_price[i][1] == null) {
                                return_price[i][1] = 0;
                                return_price[i][3] = "Оплатить";
                            }
                            adminPrice.querySelectorAll('.price-value')[i].textContent = return_price[i][1];
                            adminPrice.querySelectorAll('.new-button-price')[i].textContent = return_price[i][3];
                            adminPrice.querySelectorAll('.new-price-description')[i].textContent = return_price[i][2];
                            adminPrice.querySelectorAll('.new-button-price')[i].classList.remove('paidBtn');
                            if (return_price[i][3] == "Оплачено") {
                                adminPrice.querySelectorAll('.new-button-price')[i].className += " paidBtn";
                            }
                        }
                    }

                    if (year == 2020) {
                        var j = 12;
                        for (var i = 0; i < 12; i++) {
                            // Если стоимость не указана - вовзращать 0
                            if (return_price[i][1] == null) {
                                return_price[i][1] = 0;
                                return_price[i][3] = "Оплатить";
                            }
                            adminPrice.querySelectorAll('.price-value')[i].textContent = return_price[j][1];
                            adminPrice.querySelectorAll('.new-button-price')[i].textContent = return_price[j][3];
                            adminPrice.querySelectorAll('.new-price-description')[i].textContent = return_price[j][2];
                            adminPrice.querySelectorAll('.new-button-price')[i].classList.remove('paidBtn');
                            if (return_price[j][3] == "Оплачено") {
                                adminPrice.querySelectorAll('.new-button-price')[i].className += " paidBtn";
                            }
                            j++;
                        }
                        season2020 = document.querySelector('.season-2020').style.display = 'block';
                    }



                    if (year == 2021) {
                        var j = 24;
                        for (var i = 0; i < 12; i++) {
                            // Если стоимость не указана - вовзращать 0
                            if (return_price[i][1] == null) {
                                return_price[i][1] = 0;
                                return_price[i][3] = "Оплатить";
                            }

                            if(return_price[j][1]==null){return_price[j][1] = 0}

                            adminPrice.querySelectorAll('.price-value')[i].textContent = return_price[j][1];
                            adminPrice.querySelectorAll('.new-button-price')[i].textContent = return_price[j][3];
                            adminPrice.querySelectorAll('.new-price-description')[i].textContent = return_price[j][2];
                            adminPrice.querySelectorAll('.new-button-price')[i].classList.remove('paidBtn');
                            if (return_price[j][3] == "Оплачено") {
                                adminPrice.querySelectorAll('.new-button-price')[i].className += " paidBtn";
                            }
                            j++;
                        }
                        season2021 = document.querySelector('.season-2021').style.display = 'block';
                    }



                    if (year == 2022) {
                        var j = 36;
                        for (var i = 0; i < 12; i++) {
                            // Если стоимость не указана - вовзращать 0
                            if (return_price[i][1] == null) {
                                return_price[i][1] = 0;
                                return_price[i][3] = "Оплатить";
                            }

                            if(return_price[j][1]==null){return_price[j][1] = 0}

                            adminPrice.querySelectorAll('.price-value')[i].textContent = return_price[j][1];
                            adminPrice.querySelectorAll('.new-button-price')[i].textContent = return_price[j][3];
                            adminPrice.querySelectorAll('.new-price-description')[i].textContent = return_price[j][2];
                            adminPrice.querySelectorAll('.new-button-price')[i].classList.remove('paidBtn');
                            if (return_price[j][3] == "Оплачено") {
                                adminPrice.querySelectorAll('.new-button-price')[i].className += " paidBtn";
                            }
                            j++;
                        }
                        season2022 = document.querySelector('.season-2022').style.display = 'block';
                    }






                    if (year == 2023) {
                        var j = 48;
                        for (var i = 0; i < 12; i++) {
                            // Если стоимость не указана - вовзращать 0
                            if (return_price[i][1] == null) {
                                return_price[i][1] = 0;
                                return_price[i][3] = "Оплатить";
                            }

                            if(return_price[j][1]==null){return_price[j][1] = 0}

                            adminPrice.querySelectorAll('.price-value')[i].textContent = return_price[j][1];
                            adminPrice.querySelectorAll('.new-button-price')[i].textContent = return_price[j][3];
                            adminPrice.querySelectorAll('.new-price-description')[i].textContent = return_price[j][2];
                            adminPrice.querySelectorAll('.new-button-price')[i].classList.remove('paidBtn');
                            if (return_price[j][3] == "Оплачено") {
                                adminPrice.querySelectorAll('.new-button-price')[i].className += " paidBtn";
                            }
                            j++;
                        }
                        season2023 = document.querySelector('.season-2023').style.display = 'block';
                    }






                }
                <!--Ежегодное обновление-->
                createSeason(2023, 'Сезон 2023 - 2024 г.', '.season-2023');
                createSeason(2022, 'Сезон 2022 - 2023 г.', '.season-2022');
                createSeason(2021, 'Сезон 2021 - 2022 г.', '.season-2021');
                createSeason(2020, 'Сезон 2020 - 2021 г.', '.season-2020');
                createSeason(2019, 'Сезон 2019 - 2020 г.', '.season-2019');

//скрытие 2019
                var season2019 = document.querySelector('.season-2019');
                for (let i = 0; i < season2019.querySelectorAll('.new-main-price').length; i++) {
                    var Credit = 0;
                    var Credit20 = 0;
                    season2019.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    // season2019.querySelector('#header-season-2019 i').classList.toggle('fa-chevron-down');
                    // season2019.querySelector('#header-season-2019 i').classList.toggle('fa-chevron-up');
                }

//скрытие 2020
                var season2020 = document.querySelector('.season-2020');
                for (let i = 0; i < season2020.querySelectorAll('.new-main-price').length; i++) {
                    season2020.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    // if (season2020.querySelector('#header-season-2020 i').classList.value == 'fa fa-chevron-up'){
                    //     season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-down')
                    // }
                    // else {
                    //     season2020.querySelector('#header-season-2020 i').classList.toggle('fa fa-chevron-up')
                    // }
                }

//скрытие 2021
                var season2021 = document.querySelector('.season-2021');
                for (let i = 0; i < season2021.querySelectorAll('.new-main-price').length; i++) {
                    season2021.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    // if (season2021.querySelector('#header-season-2021 i').classList.value == 'fa fa-chevron-up'){
                    //     season2021.querySelector('#header-season-2021 i').classList.toggle('fa-chevron-down')
                    // }
                }
//скрытие 2022
                var season2022 = document.querySelector('.season-2022');
                for (let i = 0; i < season2022.querySelectorAll('.new-main-price').length; i++) {
                    season2022.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    // if (season2022.querySelector('#header-season-2022 i').classList.value == 'fa fa-chevron-up'){
                    //     season2022.querySelector('#header-season-2022 i').classList.toggle('fa-chevron-down')
                    // }
                }

//скрытие 2023
                var season2023 = document.querySelector('.season-2023');
                for (let i = 0; i < season2023.querySelectorAll('.new-main-price').length; i++) {
                    season2023.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    // if (season2023.querySelector('#header-season-2023 i').classList.value == 'fa fa-chevron-up'){
                    //     season2023.querySelector('#header-season-2023 i').classList.toggle('fa-chevron-down')
                    // }
                }




                //установка "Имеется просроченная задолженность"
                var pushDebt = function () {
                    var Credit = 0;
                    var season2019 = document.querySelector('.season-2019');
                    season2019.style.display = 'none';
                    season2019.querySelector('.is_credit_value').textContent = 0;
                    season2019.querySelector('.is_credit').style.display = 'none';
                    for (let i = 0; i < season2019.querySelectorAll('.price-value').length; i++) {
                        if (season2019.querySelectorAll('.price-value')[i].textContent > 0 & season2019.querySelectorAll('.new-button-price')[i].classList.contains('paidBtn') == false) {
                            Credit = Number(Credit) + Number(season2019.querySelectorAll('.price-value')[i].textContent);
                            season2019.querySelector('.is_credit_value').textContent = Credit;
                            season2019.querySelector('.is_credit').style.display = 'block';
                        }
                        //Автовключение года, если  был хоть один платный месяц
                        if (season2019.querySelectorAll('.price-value')[i].textContent != 0) {
                            season2019.style.display = 'block';
                        }
                    }
                }
                pushDebt();


                var pushDebt20 = function () {
                    var Credit20 = 0;
                    var season2020 = document.querySelector('.season-2020');
                    season2020.querySelector('.is_credit_value').textContent = 0;
                    season2020.querySelector('.is_credit').style.display = 'none';
                    season2020.style.display = 'none';
                    for (let i = 0; i < season2020.querySelectorAll('.price-value').length; i++) {
                        if (season2020.querySelectorAll('.price-value')[i].textContent > 0 & season2020.querySelectorAll('.new-button-price')[i].classList.contains('paidBtn') == false) {
                            Credit20 = Number(Credit20) + Number(season2020.querySelectorAll('.price-value')[i].textContent);
                            season2020.querySelector('.is_credit_value').textContent = Credit20;
                            season2020.querySelector('.is_credit').style.display = 'block';
                        }
                        //Автовключение года, если  были платных месяцев
                        if (season2020.querySelectorAll('.price-value')[i].textContent != 0) {
                            season2020.style.display = 'block';
                        }
                    }
                }
                pushDebt20();

                var pushDebt21 = function () {
                    var Credit21 = 0;
                    var season2021 = document.querySelector('.season-2021');
                    season2021.querySelector('.is_credit_value').textContent = 0;
                    season2021.querySelector('.is_credit').style.display = 'none';
                    season2021.style.display = 'none';
                    for (let i = 0; i < season2021.querySelectorAll('.price-value').length; i++) {
                        if (season2021.querySelectorAll('.price-value')[i].textContent > 0 & season2021.querySelectorAll('.new-button-price')[i].classList.contains('paidBtn') == false) {
                            Credit21 = Number(Credit21) + Number(season2021.querySelectorAll('.price-value')[i].textContent);
                            season2021.querySelector('.is_credit_value').textContent = Credit21;
                            season2021.querySelector('.is_credit').style.display = 'block';
                        }
                        //Автовключение года, если  были платных месяцев
                        if (season2021.querySelectorAll('.price-value')[i].textContent != 0) {
                            season2021.style.display = 'block';
                        }
                    }
                }
                pushDebt21();


                var pushDebt22 = function () {
                    var Credit22 = 0;
                    var season2022 = document.querySelector('.season-2022');
                    season2022.querySelector('.is_credit_value').textContent = 0;
                    season2022.querySelector('.is_credit').style.display = 'none';
                    season2022.style.display = 'none';
                    for (let i = 0; i < season2022.querySelectorAll('.price-value').length; i++) {
                        if (season2022.querySelectorAll('.price-value')[i].textContent > 0 & season2022.querySelectorAll('.new-button-price')[i].classList.contains('paidBtn') == false) {
                            Credit22 = Number(Credit22) + Number(season2022.querySelectorAll('.price-value')[i].textContent);
                            season2022.querySelector('.is_credit_value').textContent = Credit22;
                            season2022.querySelector('.is_credit').style.display = 'block';
                        }
                        //Автовключение года, если  были платных месяцев
                        if (season2022.querySelectorAll('.price-value')[i].textContent != 0) {
                            season2022.style.display = 'block';
                        }
                    }
                }
                pushDebt22();




                var pushDebt23 = function () {
                    var Credit23 = 0;
                    var season2023 = document.querySelector('.season-2023');
                    season2023.querySelector('.is_credit_value').textContent = 0;
                    season2023.querySelector('.is_credit').style.display = 'none';
                    season2023.style.display = 'none';
                    for (let i = 0; i < season2023.querySelectorAll('.price-value').length; i++) {
                        if (season2023.querySelectorAll('.price-value')[i].textContent > 0 & season2023.querySelectorAll('.new-button-price')[i].classList.contains('paidBtn') == false) {
                            Credit23 = Number(Credit23) + Number(season2023.querySelectorAll('.price-value')[i].textContent);
                            season2023.querySelector('.is_credit_value').textContent = Credit23;
                            season2023.querySelector('.is_credit').style.display = 'block';
                        }
                        //Автовключение года, если  были платных месяцев
                        if (season2023.querySelectorAll('.price-value')[i].textContent != 0) {
                            season2023.style.display = 'block';
                        }
                    }
                }
                pushDebt23();




                // // Открытие сезона при клике
                // var open2019 = function () {
                //     var season2019 = document.querySelector('.season-2019');
                //     season2019.querySelector('#header-season-2019').addEventListener('click', function () {
                //         season2019.querySelector('#header-season-2019 i').classList.toggle('fa-chevron-down');
                //         season2019.querySelector('#header-season-2019 i').classList.toggle('fa-chevron-up');
                //         if (season2019.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                //             for (let i = 0; i < season2019.querySelectorAll('.new-main-price').length; i++) {
                //                 season2019.querySelectorAll('.new-main-price')[i].style.display = '';
                //             }
                //         } else {
                //             for (let i = 0; i < season2019.querySelectorAll('.new-main-price').length; i++) {
                //                 season2019.querySelectorAll('.new-main-price')[i].style.display = 'none';
                //             }
                //         }
                //     })
                // }
                // open2019();
                //
                // var open2020 = function () {
                //     var season2020 = document.querySelector('.season-2020');
                //     season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-down');
                //     season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-up');
                //     // Открытие сезона при клике
                //     season2020.querySelector('#header-season-2020').addEventListener('click', function () {
                //         season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-up');
                //         season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-down');
                //         if (season2020.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                //             for (let i = 0; i < season2020.querySelectorAll('.new-main-price').length; i++) {
                //                 season2020.querySelectorAll('.new-main-price')[i].style.display = '';
                //             }
                //         } else {
                //             for (let i = 0; i < season2020.querySelectorAll('.new-main-price').length; i++) {
                //                 season2020.querySelectorAll('.new-main-price')[i].style.display = 'none';
                //             }
                //         }
                //     })
                // }
                // open2020();








// изменение порядка групп с просрочками
                var s2019 = document.querySelector('.season-2019');
                var s2020 = document.querySelector('.season-2020');
                var s2021 = document.querySelector('.season-2021');
                var s2022 = document.querySelector('.season-2022');
                var s2023 = document.querySelector('.season-2023');



                var wrapPrice = document.querySelector('.wrap-price');

                if(s2023.querySelector('.is_credit').style.display == 'block'){
                    wrapPrice.prepend(s2023)
                } else {
                    wrapPrice.append(s2023)
                }


                if(s2022.querySelector('.is_credit').style.display == 'block'){
                    wrapPrice.prepend(s2022)
                } else {
                    wrapPrice.append(s2022)
                }

                if(s2021.querySelector('.is_credit').style.display == 'block'){
                    wrapPrice.prepend(s2021)
                } else {
                    wrapPrice.append(s2021)
                }

                if(s2020.querySelector('.is_credit').style.display == 'block'){
                    wrapPrice.prepend(s2020)
                } else {
                    wrapPrice.append(s2020)
                }


                if(s2019.querySelector('.is_credit').style.display == 'block'){
                    wrapPrice.prepend(s2019)
                }else {
                    wrapPrice.append(s2019)
                }



            },
            type: "POST"
        });
    }


    $("#change_student").change(function () {
        change_student(0);
    });

    //Вызов контекстного меню по белым полям
    // $('#calendar tbody').on('contextmenu', 'td', function (event) {
    // })


    // (Обработка в контекстом меню)
    $('table').on('contextmenu', 'td', function (event) {
        var delete_day = $(this).text();
        var detele_month = $('#calendar td[data-month]').attr('data-month');
        var delete_year = $('#calendar td[data-year]').attr('data-year');
        var delete_date = [delete_day, detele_month, delete_year];
        //установка больничного
        $("#hospital").off().on("click", function () {
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
                data: {
                    hospital_day: delete_day,
                    hospital_month: detele_month,
                    hospital_year: delete_year,
                    hospital_training: $("#delete_training").val(),
                    display_name: $("#change_student").val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    window.hospital_day = result.hospital_day;
                    // hospital_tableColor(hospital_day);
                    window.sheduleDate = result.sheduleDate;
                    window.sheduleDate_hospital = result.sheduleDate_hospital;
                    window.sheduleDate_paid = result.sheduleDate_paid;
                    sheduleDate = testsheduleDate(sheduleDate);
                    sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                    sheduleDate_paid = testsheduleDate(sheduleDate_paid);
                    tableColor();
                    tableColor_hospital();
                    tableColor_paid();
                    delete_tableColor(hospital_day, 2);

                },
                type: "POST"
            });
        });


        //установка 1 дня тренировки
        $("#add_training").off().on("click", function () {
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
                data: {
                    hospital_day: delete_day,
                    hospital_month: detele_month,
                    hospital_year: delete_year,
                    hospital_add_training: $("#add_training").val(),
                    display_name: $("#change_student").val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    window.hospital_day = result.hospital_day;
                    window.sheduleDate = result.sheduleDate;
                    window.sheduleDate_hospital = result.sheduleDate_hospital;
                    window.sheduleDate_paid = result.sheduleDate_paid;
                    sheduleDate = testsheduleDate(sheduleDate);
                    sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                    sheduleDate_paid = testsheduleDate(sheduleDate_paid);
                    tableColor();
                    tableColor_hospital();
                    tableColor_paid();

                },
                type: "POST"
            });
        });


        //установка оплаты
        $("#add_paid").off().on("click", function () {
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
                data: {
                    hospital_day: delete_day,
                    hospital_month: detele_month,
                    hospital_year: delete_year,
                    hospital_add_paid: $("#add_paid").val(),
                    display_name: $("#change_student").val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    window.hospital_day = result.hospital_day;
                    // hospital_tableColor(hospital_day);
                    window.sheduleDate = result.sheduleDate;
                    window.sheduleDate_hospital = result.sheduleDate_hospital;
                    window.sheduleDate_paid = result.sheduleDate_paid;
                    sheduleDate = testsheduleDate(sheduleDate);
                    sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                    sheduleDate_paid = testsheduleDate(sheduleDate_paid);
                    tableColor();
                    tableColor_hospital();
                    tableColor_paid();
                    // delete_tableColor(hospital_day, 2);

                },
                type: "POST"
            });
        });

        //Удаление тренировки
        $("#delete_training").off().on("click", function () {
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
                data: {
                    delete_day: delete_day,
                    detele_month: detele_month,
                    delete_year: delete_year,
                    delete_training: $("#delete_training").val(),
                    display_name: $("#change_student").val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    window.delete_day = result.delete_day;
                    window.sheduleDate = result.sheduleDate;
                    window.sheduleDate_hospital = result.sheduleDate_hospital;
                    window.sheduleDate_paid = result.sheduleDate_paid;
                    sheduleDate = testsheduleDate(sheduleDate);
                    sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                    sheduleDate_paid = testsheduleDate(sheduleDate_paid);
                    tableColor();
                    tableColor_hospital();
                    tableColor_paid();
                    delete_tableColor(delete_day, 2); //удаление оплаты
                    delete_tableColor(delete_day, 1); //удаление расписания
                },
                type: "POST"
            });
        });

        //Удаление оплаты
        $("#delete_paid").off().on("click", function () {
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
                data: {
                    delete_day: delete_day,
                    detele_month: detele_month,
                    delete_year: delete_year,
                    delete_paid_training: $("#delete_paid").val(),
                    display_name: $("#change_student").val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    window.delete_day = result.delete_day;
                    window.sheduleDate = result.sheduleDate;
                    window.sheduleDate_hospital = result.sheduleDate_hospital;
                    window.sheduleDate_paid = result.sheduleDate_paid;
                    sheduleDate = testsheduleDate(sheduleDate);
                    sheduleDate_hospital = testsheduleDate(sheduleDate_hospital);
                    sheduleDate_paid = testsheduleDate(sheduleDate_paid);
                    tableColor();
                    tableColor_hospital();
                    tableColor_paid();
                    delete_tableColor(delete_day, 2); //удаление оплаты
                },
                type: "POST"
            });
        });

    })
    //Передача имени пользователя при смене селекта группы (смена селекта группы)
    var day_week_send;
    $("#change_team").change(function () {

        $.ajax({
            url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
            data: {
                change_team_display_name: $("#change_team").val(),
                //  change_team_id: (parseInt(document.querySelector('#select2-change_team-container').title)),

                change_team_id: $("#change_team option:selected").attr('title'),



            },
            success: function (result) {

                //Блкокировка кнопки
                $("#setupShedule").prop("disabled", true);

                //снятие всех чек боксов
                // $('.week_day input:checkbox').prop('checked', false);
                default_team_days();

                result = JSON.parse(result);
                window.dayofweekday = result.dayofweekday;

                //вывод выбора дней недели
                $('.week_day').removeClass("show_day_base");
                $('.week_day').addClass("show_day");

                if (dayofweekday != null) {
                    for (var i = 0; i <= dayofweekday.length - 1; i++) {
                        if (dayofweekday.indexOf('Пн') != -1) {
                            $('p[name ="Пн"]').addClass("show_day_base");
                            $("p[name ='Пн'] input").attr("checked", "checked");
                        }
                        if (dayofweekday.indexOf('Вт') != -1) {
                            $('p[name ="Вт"]').addClass("show_day_base");
                            $("p[name ='Вт'] input").attr("checked", "checked");
                        }
                        if (dayofweekday.indexOf('Ср') != -1) {
                            $('p[name ="Ср"]').addClass("show_day_base");
                            $("p[name ='Ср'] input").attr("checked", "checked");
                        }
                        if (dayofweekday.indexOf('Чт') != -1) {
                            $('p[name ="Чт"]').addClass("show_day_base");
                            $("p[name ='Чт'] input").attr("checked", "checked");
                        }
                        if (dayofweekday.indexOf('Пт') != -1) {
                            $('p[name ="Пт"]').addClass("show_day_base");
                            $("p[name ='Пт'] input").attr("checked", "checked");
                        }
                        if (dayofweekday.indexOf('Сб') != -1) {
                            $('p[name ="Сб"]').addClass("show_day_base");
                            $("p[name ='Сб'] input").attr("checked", "checked");
                        }
                        if (dayofweekday.indexOf('Вск') != -1) {
                            $('p[name ="Вск"]').addClass("show_day_base");
                            $("p[name ='Вск'] input").attr("checked", "checked");
                        }
                    }
                }
                check_have_chacked();
                window.user_list = result.user_list;
                window.user_list_without_team = result.user_list_without_team;


                var now_student = $("#change_student option:selected").text();
                now_student = now_student.replace(/^\S+ /, '');

                //запоминаем текущего студента
                $("#change_student").empty();
                //установка новых учеников
                var select = $('#change_student');

                console.log(select);

                // if (select.prop) {
                //     var options = select.prop('options');
                // }
                // else {
                //     var options = select.attr('options');
                // }
                // $.each(user_list, function (val, text) {
                //     options[options.length] = new Option(text, val);
                // });

                //добавление  значения в начало
//var test= "Петя";
                if (user_list) {
                    var x = user_list.length;
                    for (var i = 0; i < user_list.length; i++) {
                        $("#change_student").prepend($('<option value="' + user_list[i] + '">' + x + '. ' + user_list[i] + '</option>  '));
                        x = x - 1;
                    }
                }

                if (user_list_without_team) {

                    for (var i = 0; i < user_list_without_team.length; i++) {
                        $("#change_student").prepend($('<option value="' + user_list_without_team[i] + '">' + user_list_without_team[i] + '</option>  '));
                    }

                    //Добавление класса ученикам без группыselect2
                    $('.select2-selection').click(function () {
                        if (typeof (user_list_without_team) != "undefined" && user_list_without_team !== null) {
                            for (var i = 0; i <= user_list_without_team.length; i++) {
                                $(".select2_wrapper .select2-results__options li:nth-child(" + i + ")").addClass('without_team')
                            }
                        }
                    })
                }

                //очищение календаря если в имени пусто
                if ($("#change_student option:selected").text() == "") {
                    delete_tableColor("all", 1);
                    delete_tableColor("all", 2);
                    delete_tableColor("all", 3);
                }


                //$("#change_student").prepend($('<option id="now_student" style="color: #e7a246;" value="' + now_student + '">' + now_student + '</option>')); //добавление  значения в начало

                //  $("#change_student option[value='+now_student+']").attr("selected", "selected"); //выбор выбранного значения


                if ($("#change_student").val() != null) {
                    change_student(0);
                }








            },
            type: "POST"
        });
    });
    $("#setupShedule").prop("disabled", true);
    //Передача типа оплаты 1 дня (смена чек бокса типа оплаты)
    $("#pay-one-day").change(function () {

        $.ajax({
            url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/dashboard-ajax.php",
            data: {
                change_team_display_name: $('#pay-one-day').is(':checked'),
            },
            success: function (result) {
                // location.reload();
            },
            type: "POST"
        });
    });
</script>
<script>
    //Определение блокировки кнопки отправки в зависимости от чек бокса
    var check_have_chacked = function () {
        var a = false;
        $("#setupShedule").prop("disabled", true);
        if ($('.week_day input:checkbox:checked').length) {
            a = true;
        }
        if (a) {
            $("#setupShedule").prop("disabled", false);
        }
    }
    $("#setupShedule").prop("disabled", true);

    //подключение select2
    $(document).ready(function () {
        $('#change_student').select2();
    });

    $(document).ready(function () {
        $('#change_team').select2(
            {
                minimumResultsForSearch: Infinity

            },
            // {
            //     maximumInputLength: 20
            // }
            // only allow terms up to 20 characters long}

        );
    });


    document.addEventListener('DOMContentLoaded', function () {
        //удаление пустого поля в выбора ученика
        $('.select2-selection').click(function () {
            $(".select2-results__options li").detach(":empty")
        })

        $('#change_student').select2({
            theme: 'default select2_wrapper'
        });


        //Скрытие модалки при отмене
// $('#use').click(function(){
//     $('.modal').css('display','none');
// });


        // wrapPrice.append(textDiv);
        // textDiv.addEventListener('click', function () {
        //
        //     if (textIcon.classList.contains("fa-chevron-down")) {
        //         adminPrice.style.display = 'none';
        //         textDiv.style.position = 'initial';
        //         textIcon.classList.remove("fa-chevron-down");
        //         textIcon.classList.add("fa-chevron-up");
        //     }
        //     if (textIcon.classList.contains("fa-chevron-up")) {
        //         textIcon.classList.remove("fa-chevron-up");
        //         textIcon.classList.add("fa-chevron-down");
        //         adminPrice.style.display = 'block';
        //          textDiv.style.position = '';
        //     }
        //
        // })




// Ежегодное обновление
        // Открытие сезона при клике
        var open2019 = function () {
            var season2019 = document.querySelector('.season-2019');
            season2019.querySelector('#header-season-2019').addEventListener('click', function () {
                season2019.querySelector('#header-season-2019 i').classList.toggle('fa-chevron-down');
                season2019.querySelector('#header-season-2019 i').classList.toggle('fa-chevron-up');
                if (season2019.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                    for (let i = 0; i < season2019.querySelectorAll('.new-main-price').length; i++) {
                        season2019.querySelectorAll('.new-main-price')[i].style.display = '';
                    }
                } else {
                    for (let i = 0; i < season2019.querySelectorAll('.new-main-price').length; i++) {
                        season2019.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    }
                }
            })
        }
        open2019();

        var open2020 = function () {
            var season2020 = document.querySelector('.season-2020');
            // Открытие сезона при клике
            season2020.querySelector('#header-season-2020').addEventListener('click', function () {
                season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-down');
                season2020.querySelector('#header-season-2020 i').classList.toggle('fa-chevron-up');
                if (season2020.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                    for (let i = 0; i < season2020.querySelectorAll('.new-main-price').length; i++) {
                        season2020.querySelectorAll('.new-main-price')[i].style.display = '';
                    }
                } else {
                    for (let i = 0; i < season2020.querySelectorAll('.new-main-price').length; i++) {
                        season2020.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    }
                }
            })
        }
        open2020();


        var open2021 = function () {
            var season2021 = document.querySelector('.season-2021');
            // Открытие сезона при клике
            season2021.querySelector('#header-season-2021').addEventListener('click', function () {
                season2021.querySelector('#header-season-2021 i').classList.toggle('fa-chevron-up');
                season2021.querySelector('#header-season-2021 i').classList.toggle('fa-chevron-down');
                if (season2021.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                    for (let i = 0; i < season2021.querySelectorAll('.new-main-price').length; i++) {
                        season2021.querySelectorAll('.new-main-price')[i].style.display = '';
                    }
                } else {
                    for (let i = 0; i < season2021.querySelectorAll('.new-main-price').length; i++) {
                        season2021.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    }
                }
            })
        }
        open2021();


        var open2022 = function () {
            var season2022 = document.querySelector('.season-2022');
            // Открытие сезона при клике
            season2022.querySelector('#header-season-2022').addEventListener('click', function () {
                season2022.querySelector('#header-season-2022 i').classList.toggle('fa-chevron-up');
                season2022.querySelector('#header-season-2022 i').classList.toggle('fa-chevron-down');
                if (season2022.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                    for (let i = 0; i < season2022.querySelectorAll('.new-main-price').length; i++) {
                        season2022.querySelectorAll('.new-main-price')[i].style.display = '';
                    }
                } else {
                    for (let i = 0; i < season2022.querySelectorAll('.new-main-price').length; i++) {
                        season2022.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    }
                }
            })
        }
        open2022();



        var open2023 = function () {
            var season2023 = document.querySelector('.season-2023');
            // Открытие сезона при клике
            season2023.querySelector('#header-season-2023').addEventListener('click', function () {
                season2023.querySelector('#header-season-2023 i').classList.toggle('fa-chevron-up');
                season2023.querySelector('#header-season-2023 i').classList.toggle('fa-chevron-down');
                if (season2023.querySelectorAll('.new-main-price')[0].style.display == 'none') {
                    for (let i = 0; i < season2023.querySelectorAll('.new-main-price').length; i++) {
                        season2023.querySelectorAll('.new-main-price')[i].style.display = '';
                    }
                } else {
                    for (let i = 0; i < season2023.querySelectorAll('.new-main-price').length; i++) {
                        season2023.querySelectorAll('.new-main-price')[i].style.display = 'none';
                    }
                }
            })
        }
        open2023();





    }, false);

</script>
<script src="https://fc-istok.kidslink.ru/wp-content/plugins/woocommerce/templates/myaccount/shedule/allscript.js"></script>
<?php if ($admin) { ?>
<script src="https://fc-istok.kidslink.ru/wp-content/plugins/woocommerce/templates/myaccount/shedule/script.js"></script>
<script>
    $(".avatar_wrapper").addClass("hide_day");
</script>


<!--У админа-->
<div class="wrap-price all-season">
<!--    Ежегодное обновление. -->
<!--    Не забыть в последнем году указать верный класс стрелочку fa fa-chevron-down-->




    <div class="elementor-container elementor-column-gap-default price_admin season-2023">
        <script>
            for (let i = 0; i < 12; i++) {
                document.write('<div class="border_price new-main-price">');
                document.write('<div  class="new-price">');
                document.write('<span class="hide-currency">₽</span>');
                document.write('<span  class="price-value"></span>');
                document.write('<div class="new-price-description"></div>');
                document.write('</div>');
                document.write('<div class="new-main-button">')
                document.write('<span class="new-button-price"></span>');
                document.write(' </div>');
                document.write('</div>');
            }
        </script>
        <div class="header-season" id="header-season-2023">Сезон 2023 - 2024 г.<i class="fa fa-chevron-up"></i></div>
        <span class="is_credit">
            Имеется просроченная задолженность в размере <span class="is_credit_value"></span> руб.
        </span>
    </div>






    <div class="elementor-container elementor-column-gap-default price_admin season-2022">
        <script>
            for (let i = 0; i < 12; i++) {
                document.write('<div class="border_price new-main-price">');
                document.write('<div  class="new-price">');
                document.write('<span class="hide-currency">₽</span>');
                document.write('<span  class="price-value"></span>');
                document.write('<div class="new-price-description"></div>');
                document.write('</div>');
                document.write('<div class="new-main-button">')
                document.write('<span class="new-button-price"></span>');
                document.write(' </div>');
                document.write('</div>');
            }
        </script>
        <div class="header-season" id="header-season-2022">Сезон 2022 - 2023 г.<i class="fa fa-chevron-down"></i></div>
        <span class="is_credit">
            Имеется просроченная задолженность в размере <span class="is_credit_value"></span> руб.
        </span>
    </div>




    <div class="elementor-container elementor-column-gap-default price_admin season-2021">
        <script>
            for (let i = 0; i < 12; i++) {
                document.write('<div class="border_price new-main-price">');
                document.write('<div  class="new-price">');
                document.write('<span class="hide-currency">₽</span>');
                document.write('<span  class="price-value"></span>');
                document.write('<div class="new-price-description"></div>');
                document.write('</div>');
                document.write('<div class="new-main-button">')
                document.write('<span class="new-button-price"></span>');
                document.write(' </div>');
                document.write('</div>');
            }
        </script>
        <div class="header-season" id="header-season-2021">Сезон 2021 - 2022 г.<i class="fa fa-chevron-down"></i></div>
        <span class="is_credit">
            Имеется просроченная задолженность в размере <span class="is_credit_value"></span> руб.
        </span>
    </div>




    <div class="elementor-container elementor-column-gap-default price_admin season-2020">
        <script>
            for (let i = 0; i < 12; i++) {
                document.write('<div class="border_price new-main-price">');
                document.write('<div class="new-price">');
                document.write('<span class="hide-currency">₽</span>');
                document.write('<span  class="price-value"></span>');
                document.write('<div class="new-price-description"></div>');
                document.write('</div>');
                document.write('<div class="new-main-button">')
                document.write('<span class="new-button-price"></span>');
                document.write(' </div>');
                document.write('</div>');
            }
        </script>
        <div class="header-season" id="header-season-2020">Сезон 2020 - 2021 г.<i class="fa fa-chevron-down"></i></div>
        <span class="is_credit">
            Имеется просроченная задолженность в размере <span class="is_credit_value"></span> руб.
        </span>
    </div>



    <div class="elementor-container elementor-column-gap-default price_admin season-2019">
        <script>
            for (let i = 0; i < 12; i++) {
                document.write('<div class="border_price new-main-price">');
                document.write('<div class="new-price">');
                document.write('<span class="hide-currency">₽</span>');
                document.write('<span  class="price-value"></span>');
                document.write('<div class="new-price-description"></div>');
                document.write('</div>');
                document.write('<div class="new-main-button">')
                document.write('<span class="new-button-price"></span>');
                document.write(' </div>');
                document.write('</div>');
            }
        </script>
        <div class="header-season" id="header-season-2019">Сезон 2019 - 2020 г.<i class="fa fa-chevron-down"></i></div>
        <span class="is_credit">
            Имеется просроченная задолженность в размере <span class="is_credit_value"></span> руб.
        </span>
    </div>


    <!--        Добавление балготворительности (Клубный взнос)-->
    <!--    закоментил клубный взнос 02.08, надо удостовериться что фича не сломалась-->

    <!--    <script>-->
    <!--        let wrap_charity = document.querySelector('.wrap_charity');-->
    <!--        let avatar_wrapper = document.querySelector('.avatar_wrapper');-->
    <!--        var wrapPrice = document.querySelector('.wrap-price');-->
    <!--        var adminPrice = document.querySelector('.price_admin');-->
    <!--        // avatar_wrapper.appendChild(wrap_charity);-->
    <!--    </script>-->
</div>
<?php
}
//У ЮЗЕРА
include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/woocommerce/templates/myaccount/shedule/price.php';


/**
 * My Account dashboard.
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');
/**
 * Deprecated woocommerce_before_my_account action.
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');
/**
 * Deprecated woocommerce_after_my_account action.
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
