<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Главная - Удалить</title>
        <script>
            function goBack() {
                history.go(-1);
            }
        </script>
    </head>
    <body>
    	<div id="news">
    	<?php if ($new){?>
            <h2>Вы действительно хотите удалить запись "<?php echo $new['title']?>?"</h2>
            <form method="POST" action="">
                <a href="javascript:goBack();">Отмена</a>
                <input type="hidden" name="submit" value="true"/>
                <input type="submit" value="Delete"/>
            </form>
    	<?php }?>
    	</div>
    </body>
</html>
