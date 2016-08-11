<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Blog - <? echo $data['post']->title; ?></title>

</head>
<body>

	<h1>#<? echo $data['post']->id ;?> <? echo $data['post']->title ;?></h1>
	<a href="/edit/<? echo $data['post']->id ;?>">Edit</a>
	<a href="/delete/<? echo $data['post']->id ;?>">Delete</a>
	<p>	<? echo $data['post']->body ;?> </p>
	<? echo $data['post']->created_at ;?>
	
	
</body>
</html>