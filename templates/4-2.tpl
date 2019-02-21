<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
</head>
<body>
<h1>メイン画面</h1>

{foreach from=$result item=result}
    <p>{$result['name']}:{$result['title']}.{$result['created']}</p>
{/foreach}
</body>