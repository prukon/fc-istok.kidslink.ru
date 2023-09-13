<!--1-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->

<!--<script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>-->
<!--<script src="jquery-ui-i18n.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>-->




<!--<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css">-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.js"></script>


<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/woocommerce/templates/myaccount/shedule/config.php';
$cur_user_id = get_current_user_id();
//Определение администратора
$sql = "SELECT meta_value FROM `wp_users`
LEFT JOIN wp_usermeta on wp_usermeta.user_id = wp_users.ID
WHERE wp_users.id = '" . $cur_user_id . "' and meta_key = 'wp_user_level'";
$result = $pdo->query($sql);

foreach ($result as $row) {
    $pravo[] = array(
        'meta_value' => $row['meta_value']);
}
$admin = $pravo[0]['meta_value'] == 10;
if ($admin) {


//получение текущего месяца
    $sql = "SELECT `type` FROM `one_pay` where id = 2";
    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $type[] = $row['type'];
    };

//получение групп
    $sql = "SELECT * FROM `team` where Enable = 1
order by order_by;

";

//    $sql = "SELECT * FROM `team` where Enable = 1 ";



    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $team_display_name[] = $row['display_name'];
        $team_id[] = $row['id'];
    };

//переиндексировать массив с 1
    $team_display_name = array_values($team_display_name);
    array_unshift($team_display_name, NULL);
    unset($team_display_name[0]);




//многомерный
    $sql = "SELECT display_name, prices
FROM `team_prices`
LEFT JOIN team on team.id = team_prices.team_id
where month = '$type[0]'
and team.Enable = 1 
order BY team.order_by";
    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $teamData[] = array(
            'display_name' => $row['display_name'],
            'prices' => $row['prices'],
        );
    }

//получение сумм в группах
//$sql = "SELECT * FROM `team_prices`
//where month = '$type[0]' and team_id = '3'";
//$result = $pdo->query($sql);
//foreach ($result as $row) {
//    $priceArsenal = $row['prices'];
//};
//$sql = "SELECT * FROM `team_prices`
//where month = '$type[0]' and team_id = '2'";
//$result = $pdo->query($sql);
//foreach ($result as $row) {
//    $priceBars = $row['prices'];
//};
    ?>
    <div>
        <!--            Ежегодное обновление-->
        <select class='#' id="focus_date">
            <option>июнь 2019</option>
            <option>июль 2019</option>
            <option>август 2019</option>
            <option>сентябрь 2019</option>
            <option>октябрь 2019</option>
            <option>ноябрь 2019</option>
            <option>декабрь 2019</option>
            <option>январь 2020</option>
            <option>февраль 2020</option>
            <option>март 2020</option>
            <option>апрель 2020</option>
            <option>май 2020</option>
            <option>июнь 2020</option>
            <option>июль 2020</option>
            <option>август 2020</option>

            <option>сентябрь 2020</option>
            <option>октябрь 2020</option>
            <option>ноябрь 2020</option>
            <option>декабрь 2020</option>
            <option>январь 2021</option>
            <option>февраль 2021</option>
            <option>март 2021</option>
            <option>апрель 2021</option>
            <option>май 2021</option>
            <option>июнь 2021</option>
            <option>июль 2021</option>
            <option>август 2021</option>

            <option>сентябрь 2021</option>
            <option>октябрь 2021</option>
            <option>ноябрь 2021</option>
            <option>декабрь 2021</option>
            <option>январь 2022</option>
            <option>февраль 2022</option>
            <option>март 2022</option>
            <option>апрель 2022</option>
            <option>май 2022</option>
            <option>июнь 2022</option>
            <option>июль 2022</option>
            <option>август 2022</option>

            <option>сентябрь 2022</option>
            <option>октябрь 2022</option>
            <option>ноябрь 2022</option>
            <option>декабрь 2022</option>
            <option>январь 2023</option>
            <option>февраль 2023</option>
            <option>март 2023</option>
            <option>апрель 2023</option>
            <option>май 2023</option>
            <option>июнь 2023</option>
            <option>июль 2023</option>
            <option>август 2023</option>

            <option>сентябрь 2023</option>
            <option>октябрь 2023</option>
            <option>ноябрь 2023</option>
            <option>декабрь 2023</option>
            <option>январь 2024</option>
            <option>февраль 2024</option>
            <option>март 2024</option>
            <option>апрель 2024</option>
            <option>май 2024</option>
            <option>июнь 2024</option>
            <option>июль 2024</option>
            <option>август 2024</option>









        </select>
        <script>
            let currentMonth = <?php  echo json_encode($type[0]) ?>;
            let allMonths = document.querySelectorAll('#focus_date option');
            //    let a = 'июль 2019';
            for (let i = 0; i < allMonths.length; i++) {
                if (allMonths[i].value == currentMonth) {
                    allMonths[i].selected = true;
                }
            }
        </script>
        <button class="woocommerce-button button view student setup_sheduled setup_sheduled_download"
                id="setupSheduleTeams">Применить
        </button>
        <button class="woocommerce-button button view student setup_sheduled setup_sheduled_download setup_sheduled_download_players"
                id="setupShedule"
                disabled="">Применить
        </button>



        <button class="woocommerce-button button view display-none btn-refresh-users ">
            <span class=" refresh-wrap woocommerce-button"><i class="fa fa-refresh refresh-users"></i></span>


        </button>







        <!--        вывод групп c сервера-->
        <?php
        echo "<ul class='group_price'>";
        $i = 1;
        foreach ($teamData as $result => $row) {
            echo "<li>";
            echo "<span class='price-team-num'>" . $i . ". </span>";
            echo "<span class='price-team-name'>" . $row['display_name'] . "</span>";
            echo "<input class='input-group-price' type='number' value='" . $row['prices'] . "'>";
            echo "<input class='input-group-setup-individual' type='button' value='ok' id ='input-group-setup-individual'>";
            echo "<input class='input-group-setup' type='button' value='Подробно' id ='input-group-setup'>";
            echo "</li>";
            $i++;
        }
        echo "</ul>";
        ?>
        <script>
            //получение суммы в группах в массив для дальнейшей отправки
            function getTeamData() {
                let teamData = [...document.querySelectorAll('.group_price > li')]
                    .map(el => [el.querySelector('.price-team-name').innerText, el.querySelector('.input-group-price').value])
                    .reduce((acc, [key, val]) => ({...acc, [key]: val}), {});
                return teamData;
            }

            function getTeamData2() {
                let teamData = [...document.querySelectorAll('.userInGroup > li')]
                    .map(el => [el.querySelector('.price-players-name').innerText, el.querySelector('.input-group-price').value])
                    .reduce((acc, [key, val]) => ({...acc, [key]: val}), {});
                return teamData;
            }


        </script>
        <!--        вывод учеников-->
        <ul class='userInGroup'>
            <script>
                for (let i = 1; i < 25; i++) {
                    document.write(' <li><span class="price-team-num">' + i + '. </span>   <span class="price-players-name"></span>  <input class=\'input-group-price\' type=\'number\' placeholder=\'\'> <span class="fa fa-check display-none green-check"><span></li>');
                }
            </script>
        </ul>
    </div>
    <script>
        let team_display_name = <?php  echo json_encode($team_display_name) ?>;
        let team_id = <?php  echo json_encode($team_id) ?>;
        var userInGroupMain = document.querySelectorAll('userInGroup'); //все ученики
        let userInGroup = document.querySelectorAll('.price-players-name'); //все ученики *(только имена)
        let inputGroupPrice = document.querySelectorAll('.group_price li'); //все группы (li)
        let setupSheduleTeams = document.querySelector('#setupSheduleTeams'); //применить (над группами)
        let setupShedule = document.querySelector('#setupShedule'); //применить (над юзерами)
        var userInGroupMain = document.querySelector('.userInGroup');




        let allUserInGroup = document.querySelectorAll('.userInGroup li'); //все ученики (li)
        var refreshUsers = document.querySelector('.refresh-users');
        var refreshWrap = document.querySelector('.refresh-wrap');


        //ajax
        //Передача месяца для установки цен (изменение месяца)
        $("#focus_date").change(function () {
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/download-ajax.php",
                data: {
                    focus_date: $("#focus_date").val(),
                },
                success: function (result) {
                    location.reload();
                },
                type: "POST"
            });
        });
        //клик по "Подробно"
        for (let i = 0; i < inputGroupPrice.length; i++) {
            inputGroupPrice[i].children[4].addEventListener("click", function () {
                $("#setupShedule").prop("disabled", true);
                $.ajax({
                    url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/download-ajax.php",
                    data: {
                        inputGroupSetup: $("#input-group-setup").val(),
                        // team_display_name: team_display_name[i],
                        team_id: team_id[i],
                        focus_date: $("#focus_date").val(),
                    },
                    success: function (result) {
                        //      location.reload();
                        result = JSON.parse(result);
                        window.display_name_users = result.display_name_users; //получение списка учеников в группе
                        var object_length = Object.keys(team_display_name).length;
                        for (let j = 0; j < object_length; j++) {

                            //закоментил 7 сентября 2023. Выдавало ошибку
                            //
                            try {

                                inputGroupPrice[j].classList.remove("actionGroup")
                            } catch (err) {

                                // обработка ошибки

                            }
                        }
                        inputGroupPrice[i].classList.add("actionGroup");
                        //апенд учеников в группу

                        if (display_name_users) {

                            userInGroupMain.style.display = "block"; //отображение  блока с ученика








                            for (let i = 0; i < 100; i++) { //общий перебор

                                try {
                                    userInGroup[i].textContent = "";
                                    allUserInGroup[i].children[3].style.display = 'none'; //скрытие всех галочек
                                    allUserInGroup[i].children[2].disabled = false;
                                    // inputGroupPrice[i].children[2].classList.remove("add_new_value");
                                    allUserInGroup[i].children[2].classList.remove("add_new_value");
                                    allUserInGroup[i].children[2].classList.remove("add_value");
                                }catch (e) {
                                }
                            }






                            for (let i = 0; i < display_name_users.length; i++) {
                                userInGroup[i].textContent = display_name_users[i].display_name;
                                allUserInGroup[i].children[2].value = display_name_users[i].prices;

                                if (display_name_users[i].paid == "1") { //если оплаечено сумма у юзера
                                    //  allUserInGroup[i].append('1');
                                    allUserInGroup[i].children[3].style.display = 'inline';  //показываем галочку
                                    allUserInGroup[i].children[2].disabled = true; //Блокировка оплаченного инпута
                                }

                                //добавление галочки
                                // allUserInGroup[i].append('<p>Меня тут не было!</p>');
                                //   allUserInGroup[i].append('2');
                                //    var span = document.createElement('span');
                                //    span.className = "fa fa-camera-retro fa-lg";
                                //    allUserInGroup[i].append(span);

                            }
                            $("#setupShedule").prop("disabled", false);

                        } else {
                            userInGroupMain.style.display = "none"; //скрытие блока с ученика


                            try {
                                for (let i = 0; i < 100; i++) {
                                    userInGroup[i].textContent = "";
                                }
                            }catch (e) {

                            }

                        }



                        try {
                            for (let i = 0; i < 101; i++) {
                                if (userInGroup[i].textContent == "") {
                                    userInGroup[i].parentNode.style.display = 'none';
                                } else {
                                    userInGroup[i].parentNode.style.display = 'block';
                                }
                            }
                        }catch (e) {

                        }








                        //Отображение кнопки рефреш
                        refreshWrap.style.display = 'inline';


                    },
                    type: "POST"
                });
            })
        }




        //клик по "Ок"
        for (let i = 0; i < inputGroupPrice.length; i++) {
            inputGroupPrice[i].children[3].addEventListener("click", function (e) {
                $("#setupShedule").prop("disabled", true);
                $.ajax({
                    url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/download-ajax.php",
                    data: {
                        inputGroupSetupIndividual: $("#input-group-setup-individual").val(),
                        team_display_name: team_display_name[i],
                        team_id: team_id[i],
                        team_individual_price: e.target.parentNode.children[2].value,
                        focus_date: $("#focus_date").val(),
                    },
                    success: function (result) {
                        console.log(e.target.parentNode.children[2]);

                        e.target.parentNode.children[2].classList.add("add_value");
                        e.target.parentNode.children[2].classList.remove("add_new_value");
                    },
                    type: "POST"
                });
            })
        }













        //Снятие add_value при изменении стоимости в группе
        for (let i = 0; i < inputGroupPrice.length; i++) {
            inputGroupPrice[i].children[2].addEventListener("input", function () {
                inputGroupPrice[i].children[2].classList.remove("add_value");
                inputGroupPrice[i].children[2].classList.add("add_new_value");
            })
        }

        //Снятие add_value при изменении стоимости в группе
        for (let i = 0; i < allUserInGroup.length; i++) {
            allUserInGroup[i].children[2].addEventListener("input", function () {
                allUserInGroup[i].children[2].classList.remove("add_value");
                allUserInGroup[i].children[2].classList.add("add_new_value");
            })
        }


        <?php
        $teamDataGet[] = array(
            'display_name' => $row['display_name'],
            'prices' => $row['prices'],
        );
        ?>
        //Клик по "применить" над группами
        setupSheduleTeams.addEventListener('click', function () {
            // ежегодное обновление При инсерте новых месяцев для оплат привести sendData к единице
            // let sendData = 1;
            let sendData = getTeamData();
            console.log(1);


            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/download-ajax.php",
                data: {
                    setupSheduleTeams: sendData,
                    focus_date: $("#focus_date").val(),
                    test: "4",
                },
                success: function (result) {
                    //       location.reload();
                    console.log(2);

                    //всем ценам в группах зеленый цвет после применения
                    for (let i = 0; i < inputGroupPrice.length; i++) {
                        inputGroupPrice[i].children[2].classList.remove("add_new_value");
                        inputGroupPrice[i].children[2].classList.add("add_value");
                    }
                },
                type: "POST"
            });
        })
        //Клик по "применить" над юзерами
        setupShedule.addEventListener('click', function () {
            let sendData2 = getTeamData2();
            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/download-ajax.php",
                data: {
                    setupShedule: sendData2,
                    focus_date: $("#focus_date").val(),
                },
                success: function (result) {
                    //       location.reload();


                    //всем ученикам в группах зеленый цвет после применения
                    for (let i = 0; i < allUserInGroup.length; i++) {
                        allUserInGroup[i].children[2].classList.remove("add_new_value");

                        if (allUserInGroup[i].children[3].style.display == 'inline') {
                            // allUserInGroup[i].children[2].classList.add("add_new_value");


                        } else {
                            allUserInGroup[i].children[2].classList.add("add_value");
                        }
                    }

                },
                type: "POST"
            });
        })

    </script>

    <script>
        // Кручение кнопки
        refreshUsers.addEventListener('click', function (e) {
            var actionGroup = document.querySelector('.actionGroup');
            e.target.classList.add("fa-spin");

            function hide() {
                refreshUsers.classList.remove("fa-spin");
            }

            setTimeout(hide, 1000);
            var actionGroup = document.querySelector('.actionGroup');

            $.ajax({
                url: "/wp-content/plugins/woocommerce/templates/myaccount/shedule/download-ajax.php",
                data: {
                    focus_date: $("#focus_date").val(),
                    refreshUsers: 1,
                    actionGroup: actionGroup.children[1].textContent,

                },
                success: function (result) {
                    // location.reload();
                },
                type: "POST"
            });
        })
    </script>


    <?php
} else {
    ?>
    <script>
        var menu = document.querySelectorAll('.woocommerce-MyAccount-navigation ul li');
        menu [2].style.display = 'none';
    </script>
    <?php
}
?>





<?php
/**
 * Downloads
 *
 * Shows downloads on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$downloads = WC()->customer->get_downloadable_products();
$has_downloads = (bool)$downloads;

do_action('woocommerce_before_account_downloads', $has_downloads); ?>

<?php if ($has_downloads) : ?>

    <?php do_action('woocommerce_before_available_downloads'); ?>

    <?php do_action('woocommerce_available_downloads', $downloads); ?>

    <?php do_action('woocommerce_after_available_downloads'); ?>

<?php else : ?>
    <!--    <
    div
    class
    = "woocommerce-Message woocommerce-Message--info woocommerce-info" >-->
    <!-- < a
class
= "woocommerce-Button button"
href = "--><?php //echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?><!--
">-->
    <!--            -->
    <!---->
    <!---->
    <!--			--><?php //esc_html_e( 'Go shop', 'woocommerce' ) ?>
    <!-- < /a>-->
    <!--		--><?php //esc_html_e( 'No downloads available yet.', 'woocommerce' ); ?>

<?php endif; ?>

<?php do_action('woocommerce_after_account_downloads', $has_downloads); ?>
