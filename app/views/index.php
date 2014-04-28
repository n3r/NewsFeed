<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Главная - Новостная лента</title>
    </head>
    <body>
    	<h1>NewsFeed</h1>
    	<a href="/add">Добавить новость</a>
    	<div id="news">
    	<?php if ($news){
    		foreach ($news as $new){?>
    			<article>
    				<h3><?php echo $new['title'];?></h3>
    				<p><?php echo $new['content'];?></p>
    				<p><a href="/edit/id/<?php echo $new['id']?>">Редактировать</a> | <a href="/delete/id/<?php echo $new['id']?>">Удалить</a></p>
    				<p>Добавлена: <?php echo date('Y-m-d H:i:s', strtotime($new['date_created']));?> | Редактирована: <?php echo date('Y-m-d H:i:s', strtotime($new['date_updated']));?>
    				<div style="margin-bottom: 25px"></div>
    			</article>
    		<?php }
    	}?>
    	</div>
    </body>
</html>
