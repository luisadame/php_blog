<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit a post</title>
	<link rel="stylesheet" type="text/css" href="/public/css/main.css">
	<link rel="stylesheet" href="/public/css/bubbleIt.css">
	<style>
	.container{
		/*width: 60%;*/
	}
	form {
		display: flex;
		flex-direction: column;
	}

	form > div{
		margin-bottom: 1em;
		padding: 1em;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}

	form > div > input,textarea{
		width: 70%;
		padding: 1em;
		border-radius: 2px;
	}

	form > div > textarea{
		height: 500px;
		font-family: Arial, Helvetica;
		line-height: 2em;
	}

	input[type=submit]{
		margin-bottom: 3em;
	}
	</style>
</head>
<body>

	<div class="container">
		<h1>Edit post</h1>		
		<form action="/update-post" method="POST">
			<input type="hidden" name="id" value="<? echo $data['post']->id; ?>">
			<div>
				<label for="name">Título del artículo:</label>
				<input type="text" id="name" name="title" value="<? echo $data['post']->title; ?>">
			</div>
			<div>
				<label for="body">Cuerpo del artículo:</label>
				<textarea id="body" name="body"><? echo $data['post']->body; ?></textarea>
			</div>
			<div class="bubbleIt">Submit</div>
		</form>		
	</div>
	

	<script src="/public/js/jquery.js"></script>
	<script src="/public/js/bubbleIt.js"></script>
	<script>
		$('.bubbleIt').click(function(){
			$('form').submit();
		});
	</script>
</body>
</html>