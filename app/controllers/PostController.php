<?php

	use App\Views\View as View;
	use App\Database as DB;
	use App\Config\Config as Config;
	use App\Core\Validator\Validator as Validator;

	class PostController {

		private $db;

		function __construct() {
			$this->db = new DB;
			$this->db = $this->db::$connection;
		}

		public function create() {


			$data = [];
			$data['title'] = filter_input(INPUT_POST, 'title');
			$data['body'] = filter_input(INPUT_POST, 'body');
			$data['created_at'] = date('Y-m-d H:i:s');

			$rules = [
				'title' => 'required',
				'body' => 'required'
			];

			$validator = new Validator;
			$validator->make($data, $rules);

			if(!$validator->passes()){
				return View::make('new-post', ['ErrorsBag' => $validator->getErrors()]);
			}

			try {

				
				$query = 'INSERT INTO posts ( id, title, body, created_at) VALUES ( NULL, :title, :body, :created_at )';


				$stmt = $this->db->prepare($query);
				$stmt->bindParam(':title', $data['title']);
				$stmt->bindParam(':body', $data['body']);
				$stmt->bindParam(':created_at', $data['created_at']);
				
				if ($stmt->execute()) {
					header('Location: ' . Config::get('baseUrl'));
				}else{
					echo "Error";
				}


			} catch (PDOException $e) {				
				echo "Error: " . $e->getMessage();
			}

		}

		public function read($params){

			$id = (int) $params['id'];

			$query = 'SELECT * FROM posts WHERE id=:id';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			if($stmt->rowCount() === 1) {
				$post = $stmt->fetch(PDO::FETCH_OBJ);

				View::make('show-post', ['post' => $post]);				
			}else{
				echo "The post was not found";
			}

		}

		public function update() {

			$data = [];
			$data['id'] = (int) filter_input(INPUT_POST, 'id');
			$data['title'] = filter_input(INPUT_POST, 'title');
			$data['body'] = filter_input(INPUT_POST, 'body');

			$query = "UPDATE posts SET title=:title, body=:body WHERE id=:id";
			$stmt = $this->db->prepare($query);

			$stmt->execute([
				'title' => $data['title'],
				'body' => $data['body'],
				'id' => $data['id']
			]);

			if ($stmt->rowCount() == 1) {
				header('Location: ' . Config::get('baseUrl') . '/post/' . $data['id']);
			}else{
				echo "Error trying to edit";
			}

		}

		public function delete($params) {

			$postId = (int) $params['id'];
			
			$query = "DELETE FROM posts where id=$postId";
			$stmt = $this->db->prepare($query);

			if ($stmt->execute()) {
				header('Location: ' . Config::get('baseUrl'));
			}else{
				echo "There was an error trying to delete the post";
			}

		}

	}