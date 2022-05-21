<!DOCTYPE html>
<?php
  session_start();
?>
<html>
	<head>
		<meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Главная страница</title>
		<link href = "style/styleMain.css" rel = "stylesheet" type = "text/css"/>
        <script src="scripts/home.js"></script>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Laila:wght@600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
	</head>

    <?php
	include 'header.php';
    ?>

    <body>
        <div>
            <img src = "images/main/фон.png" class = "fonKitchen">
            <img src = "images/main/фон-06.png" class = "fonKitchenWave">
            <img src = "images/main/человечик тело03.png" class = "fonPeopleBody">
            <img src = "images/main/человечик рука03.png" class = "fonPeopleArm">
            <img src = "images/main/фон для букв.png" class = "fonMainTitle">


            <div class = "MainTitle">
                <div class = "MainTitle_1">ПОДБЕРИ</div>
                <div class = "MainTitle_1">ИДЕАЛЬНЫЙ</div>
                <div class = "MainTitle_1">РЕЦЕПТ</div>
            </div>

            <a href="#" class = "start" onclick="location.href='../searchRecipe.php'">НАЧАТЬ</a>

            <div class = "steps4">Сделай это в 4 шага!</div>

            <img src="images/main/фон3-06.png" class = "fon_People">
            <div class = "people_all">
                <div class = "flex">
                    <img src = "images/main/пиплы-03.png" class = "people">
                    <div class = "description">Выбери продукты,
                                                которые у тебя есть </div>
                </div>

                <div class = "flex">
                    <img src = "images/main/пиплы-06.png" class = "people">
                    <div class = "description">Выбери один
                                                из предложеных
                                                рецептов</div>
                </div>

                <div class = "flex">
                    <img src = "images/main/пиплы-04.png" class = "people">
                    <div class = "description">Приготовь блюдо по
                                                подобранному рецепту</div>
                </div>

                <div class = "flex">
                    <img src = "images/main/пиплы-05.png" class = "people">
                    <div class = "description">и... Наслаждайся!<br> <br>   
                    </div>
                </div>
            </div>
        </div>

        <img src = "images/main/фон-07.png" class = "fonWave">
        <img src = "images/main/fonUp.png" class = "fonTraining_1">
        <img src = "images/main/фон-08.png" class = "fonWaveInversion">
        <div class = "training_1">
            <img src = "images/main/глв челики 1.png" class = "mainPeople">
            <div class = "descriptionTraining_1">
                <div class = "headingTraining_1">На нашем сайте уже более
                                                100 рецептов!</div>
                <div class = "textTraining_1">Совсеми рецептами на нашем
                                            сайте ты можешь ознакомиться нажав
                                            на кноку ниже, а если у тебя есть
                                            свой уникальный рецепт и ты хочешь
                                            им поделиться, то отправь его нам,
                                            заполнив по форме, которая находится
                                            в твоем личном кабинете!</div>
                <a href="#" class = "btn1" onclick="location.href='../searchRecipe.php'">Посмотреть рецепты</a>
            </div>
        </div>


        <img src = "images/main/фон3-06.png" class = "fonTraining_2">
        <div class = "training_2">
            <div class = "descriptionTraining_1">
                <div style = "color:#250000" class = "headingTraining_1">Мы сами составим твой список покупок!</div>
                <div style = "color: #643E3E" class = "textTraining_1">Для этого на выбранном рецепте нажми
                                            «довабить в список покупок» и все ингридиенты из этого списка
                                            появяться в  твоем личном списке покупок, с которым
                                            ты можешь ознакомиться, нажав на эту кнопку</div>
                <a href="#" class = "btn2" onclick="location.href='../shoppingList.php'">Список покупок</a>
            </div>
            <img src = "images/main/глв челики 2.png" class = "mainPeople_2">
        </div>


        <div class = "training_3">
            <img src = "images/main/глв челики 3.png" class = "mainPeople">
            <div class = "descriptionTraining_1">
                <div style = "color:#250000" class = "headingTraining_1"> В чём будем готовить?</div>
                <div style = "color: #643E3E" class = "textTraining_1">Не забудь составить список имеющихся
                                                                        у  тебя кухоных принадлежностей,  для этого
                                                                        нажми на эту кнопку. Помни рецепты включающие
                                                                        в себя посуду,  которой нету в этом списке,
                                                                        не отобразяться в поиске рецептов!</div>
                <a href="#" class = "btn2" onclick="location.href='../inventory.php'">Инвентарь</a>
            </div>
        </div>

        <img src = "images/main/fon_down.png" class = "fonWaveDown">
        <img src = "images/main/fonDown.png" class = "fonDown"></div>
        <div class = ></div>

        <div class = "headingFinal">Приятного аппетита!</div>
        <img src = "images/main/глв челики 4.png" class = "mainPeopleFinal">

        <?php
        include 'menuMobile.php';
        ?>

    </body>
</html>
