<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="/public/css/main.css">
</head>
<body>

	<div class="container">
	
		<h1>Welcome to my blog</h1>
		
		<a href="/new-post" class="button">New post</a>
		<hr id="topHorizon">

		<section class="posts">
			
		<? foreach ($data['posts'] as $post): ?>
			<article class="post">
				<h1>
					<a href="/post/<? echo $post['id']; ?>">
						<? echo $post['title']; ?>
					</a>
				</h1>
				<div class="body">					
					<? echo App\Helpers::delimiter($post['body']); ?>
				</div>
				<date><? echo $post['created_at']; ?></date>
			</article>
		<? endforeach; ?>

		</section>
		<hr>

		
		<? if ($data['pagination']['total'] > 1): ?>
		<div class="pagination">
			<ul>
				<? for($i = 1; $i < $data['pagination']['total'] + 1; $i++): ?>
					<? if($data['pagination']['current'] == $i): ?>
						<li><span class="pagination-link"><? echo $i; ?></span></li>
					<? else: ?>
						<li><a class="pagination-link" href="/?page=<? echo $i; ?>"><? echo $i; ?></a></li>
					<? endif; ?>
				<? endfor; ?>
			</ul>
		</div>
		<? endif; ?>
		
	</div>

	<!-- Javascript Files -->
	<script src="/public/js/jquery.js"></script>
	<script src="/public/js/main.js"></script>
</body>
</html>