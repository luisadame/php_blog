<?php
	
	use App\Views\View as View;
	use App\Database as DB;	
	use App\Helpers as Help;

	class MainController {

		private $db;

		function __construct() {
			$this->db = new DB;
			$this->db = $this->db::$connection;
		}

		public function index() {

			$maxPost = 5;

			$page = Help::httpQueries()['page'] ?? 1;

			$first = ($page - 1) * $maxPost;
			$second = $page * $maxPost;
			$total = $this->db->query('SELECT COUNT(*) FROM posts')->fetch()[0];
			$pages = $total / $maxPost;

			$pagination = ['current' => $page, 'total' => $pages];

			$posts = $this->db->query('SELECT * FROM posts ORDER BY id DESC LIMIT '.$first.','.$second.'');
			$posts = $posts->fetchAll(PDO::FETCH_ASSOC); 

			return View::make('welcome', ['posts' => $posts, 'pagination' => $pagination]);
		}

		public function newPost() {
			return View::make('new-post');
		}

		public function editPost($params) {
			$postId = $params['id'];

			$post = $this->db->query("SELECT * FROM posts WHERE id=$postId")->fetchObject();

			return View::make('edit-post', ['post' => $post]);
		}

	}