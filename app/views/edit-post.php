<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit a post</title>
	<style>
	.container{
		/*width: 60%;*/
	}
	form {
		width: 20%;
		display: flex;
		flex-direction: column;
	}

	form input, textarea {
		margin-bottom: 1em;
	}
	</style>
</head>
<body>

	<div class="container">
		<h1>Edit post</h1>

		<form action="/update-post" method="POST">
			<input type="hidden" name="id" value="<? echo $data['post']->id; ?>">
			<input type="text" name="title" value="<? echo $data['post']->title; ?>">
			<textarea name="body"><? echo $data['post']->body; ?></textarea>
			<input type="submit" value="Edit post">
		</form>		
	</div>
	
</body>
</html>