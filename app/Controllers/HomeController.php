<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;

final class HomeController extends Controller
{
	public function index(): string
	{
		$message = 'Welcome to the Home page';
		$posts = new Post();
		$posts = $posts->all();
		return $this->render('home/index', compact('message', 'posts'));
	}

	public function hello(string $name = 'World'): string
	{
		return "Hello, " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "!";
	}

	public function store(): string
	{
		$name = $_POST['name'] ?? 'anonymous';
		return "Stored " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	}
}


