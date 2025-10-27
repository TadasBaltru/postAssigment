<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\Group;

final class HomeController extends Controller
{
	public function index(): string
	{
        $filters = [];
        if (isset($_GET['group_id'])) { $filters['group_id'] = (int) $_GET['group_id']; }
        if (isset($_GET['date'])) { $filters['date'] = (string) $_GET['date']; }
        $posts = (new Post())->all($filters);
        $groups = (new Group())->all();

		return $this->render('home/index', compact('posts', 'groups'));
	}


}


