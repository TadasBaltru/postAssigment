<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\Group;
use App\Models\Person;

final class HomeController extends Controller
{
	public function index(): string
	{
        $filters = [];
        if (isset($_GET['group_id'])) { $filters['group_id'] = (int) $_GET['group_id']; }
        if (isset($_GET['date'])) { $filters['date'] = (string) $_GET['date']; }
        $posts = (new Post())->all($filters);
        $groups = (new Group())->all();
        $persons = (new Person())->allUnique();

        // If partial requested (AJAX/flag), return only the grid HTML
        if (!empty($_GET['partial']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower((string)$_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
            ob_start();
            require __DIR__ . '/../Views/home/_grid.php';
            return (string) ob_get_clean();
        }

        return $this->render('home/index', compact('posts', 'groups', 'persons'));
	}


}


