<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Редактирование новости</title>
    </head>
    <body>
    	<h1>Добавление новости</h1>
    	<div id="add">
            <form method="POST" action="">
                <div>
                    <label for="title">Заголовок</label><br/>
                    <input type="text" name="data[title]" id="title" value="<?php echo $new['title']?>"/>
                </div>

                <div>
                    <label for="content">Текст</label><br/>
                    <textarea name="data[content]" id="content"><?php echo $new['content']?></textarea>
                </div>
                <div>
                    <input type="submit" value="Редактировать"/>
                </div>
            </form>
        </div>
    </body>
</html>
