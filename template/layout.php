<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ReTodo | Сервис коллективных задач</title>
        <?php echo $links?>
        <link rel="stylesheet" href="/assets/main.css">
    </head>
    <body>

        <div class="contentWrapper" >
            <div class="mainHeader pageRootElem"><?php echo $header ?></div>
            <?php echo $content ?>
            <div class="mainFooter pageRootElem"><?php echo $footer ?></div>
        </div>

    </body>
</html>