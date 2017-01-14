<h3>Комментарии к записи</h3>
<h4><strong>Добавить коментарий</strong></h4>
<input id="name" type="text" placeholder="Имя"/><br/><br/>
<input id="message" type="text" placeholder="Сообщение"/><br/><br/>
<button onclick="addcomment()">Отправить</button>
<button onclick="loadComments()">Обновить</button>
<? foreach ($Comments as $comment): ?>
    <h4><?=$comment['author_name']?> <small><?=date('d-m-Y',$comment['date'])?></small></h4>
    <p style="margin-left: 1%"><?=$comment['text']?></p>
<? endforeach; ?>
