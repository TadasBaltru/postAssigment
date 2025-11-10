<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\Group;
use App\Models\Person;

final class PersonController extends Controller
{
    public function index(): string
    {
        $filters = [];
        if (isset($_GET['group_id'])) {
            $filters['group_id'] = (int) $_GET['group_id'];
        }
        if (isset($_GET['date'])) {
            $filters['date'] = (string) $_GET['date'];
        }
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? max(1, (int)$_GET['per_page']) : 5;
        $offset = ($page - 1) * $perPage;

        $postModel = new Post();
        $total = $postModel->countAll($filters);
        $posts = $postModel->all($filters, $perPage, $offset);
        $totalPages = (int)ceil($total / $perPage);

        $groups = (new Group())->all();
        $persons = (new Person())->allUnique();

        // If partial requested (AJAX/flag), return only the grid HTML
        if (!empty($_GET['partial']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower((string)$_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
            header('X-Total-Count: ' . (string)$total);
            header('X-Page: ' . (string)$page);
            header('X-Per-Page: ' . (string)$perPage);
            ob_start();
            if (!empty($_GET['view']) && $_GET['view'] === 'mobile') {
                require __DIR__ . '/../Views/persons/_mobile_grid.php';
            } else {
                require __DIR__ . '/../Views/persons/_new_desktop_grid.php';
            }
            return (string) ob_get_clean();
        }

        return $this->render('persons/index', compact('posts', 'groups', 'persons', 'page', 'perPage', 'total', 'totalPages'));
    }
}
