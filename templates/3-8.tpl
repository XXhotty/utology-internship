<form method="post" action="">
    時間<input type="text" name="name" value="" />
    コメント<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>
<!-- ここに、書き込まれたデータを表示する -->


{foreach from=$messages item=message}
    <p>{$message['name']}:{$message['comment']}.{$message['created']}</p>
{/foreach}