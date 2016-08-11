<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome</title>
</head>
<body>

	<h1>Welcome to my blog</h1>
	
	<a href="/new-post">New post</a>
	<hr>
	<? foreach ($data['posts'] as $post): ?>
		<h1><a href="/post/<? echo $post['id']; ?>"><? echo $post['title']; ?></a></h1>
		<p><? echo $post['body']; ?></p>
		<date><? echo $post['created_at']; ?></date>
	<? endforeach; ?>
	<hr>

	<? if ($data['pagination']['total'] > 1): ?>
	<div class="pagination">
		<ul>
			<? for($i = 1; $i < $data['pagination']['total'] + 1; $i++): ?>
				<? if($data['pagination']['current'] == $i): ?>
					<li><? echo $i; ?></li>
				<? else: ?>
					<li><a href="/?page=<? echo $i; ?>"><? echo $i; ?></a></li>
				<? endif; ?>
			<? endfor; ?>
		</ul>
	</div>
	<? endif; ?>
</body>
</html>