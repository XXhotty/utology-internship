<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>掲示板やんなー</title>
</head>
<body>
	<h1>掲示板やんなー</h1>
	<!-- 入力エリア -->
	<div class="input_area">
		<form action="./index.php" method="post" id="contact_form">
			<dl class="name">
				<dt>名前</dt>
				<dd><input type="text" name="name" value=""></dd>
			</dl>
			<dl class="email">
				<dt>メールアドレス</dt>
				<dd><input type="text" name="email" value=""></dd>
			</dl>
			<dl class="body">
				<dt>本文</dt>
				<dd><textarea name="body"></textarea></dd>
			</dl>
			<input type="hidden" name="eventId" value="save">
			<input type="submit" value="送信">
		</form>
	</div>
	<!-- //入力エリア -->
	<hr>
	<!-- 投稿表示エリア -->
	<div class="list">
		<div class="item">
			<div class="body">ここに文章がはいります。ここに文章がはいります。ここに文章がはいります。ここに文章がはいります。</div>
			<div class="date">YYYY/MM/DD HH:ii</div>
		</div>
		<div class="item">
			<div class="body">ここに文章がはいります。ここに文章がはいります。ここに文章がはいります。ここに文章がはいります。</div>
			<div class="date">YYYY/MM/DD HH:ii</div>
		</div>
		<div class="item">
			<div class="body">ここに文章がはいります。ここに文章がはいります。ここに文章がはいります。ここに文章がはいります。</div>
			<div class="date">YYYY/MM/DD HH:ii</div>
		</div>
	</div>
	<!-- // 投稿表示エリア-->
</body>
</html>