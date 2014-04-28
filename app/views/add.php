<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Добавление новости</title>
    </head>
    <body>
    	<h1>Добавление новости</h1>
    	<div id="add">
            <form method="POST" action="">
                <div>
                    <label for="title">Заголовок</label><br/>
                    <input type="text" name="data[title]" id="title"/>
                </div>

                <div>
                    <label for="content">Текст</label><br/>
                    <textarea name="data[content]" id="content"></textarea>
                </div>
                <div>
                    <input type="submit" value="Добавить"/>
                </div>
            </form>
        </div>
    </body>
</html>
