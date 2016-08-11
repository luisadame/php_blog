<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Create a new post</title>
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
		<h1>New post</h1>

		<form action="/store-post" method="POST">
			<input type="text" name="title" placeholder="Title">
			<textarea name="body" placeholder="Body"></textarea>
			<input type="submit" value="Create post">
		</form>		
	</div>
	
</body>
</html>