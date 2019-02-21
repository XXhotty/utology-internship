<html>
<body>

{foreach from=$result item=result}
    <p>{$result['name']}:{$result['title']}.{$result['created']}</p>
{/foreach}
</body>