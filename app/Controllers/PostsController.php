<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\Person;

final class PostsController extends Controller
{
    public function index(): string
    {
        $model = new Post();
        $posts = $model->all();
        return $this->render('posts/index', compact('posts'));
    }

    public function view(int $id): string
    {
        $model = new Post();
        $post = $model->find($id);
        if (!$post) {
            http_response_code(404);
            return 'Post not found';
        }
        return $this->render('posts/view', compact('post'));
    }

    public function create(): string
    {
        $persons = (new Person())->all();
        return $this->render('posts/form', compact('persons'));
    }

    public function delete(int $id): string
    {
        header('Content-Type: application/json');
        $id = (int) $id;
        if ($id <= 0) {
            http_response_code(400);
            return json_encode(['Success' => false, 'error' => 'Invalid ID']);
        }
        (new Post())->delete($id);
        return json_encode(['Success' => true, 'id' => $id]);
    }
    public function store(): string
    {
        header('Content-Type: application/json');
        $personBaseId = isset($_POST['person_base_id']) ? (int) $_POST['person_base_id'] : 0;
        $content = trim((string) ($_POST['content'] ?? ''));
        $postDate = trim((string) ($_POST['post_date'] ?? ''));
        if ($personBaseId <= 0 || $content === '' || $postDate === '') {
            http_response_code(422);
            return json_encode(['Success' => false, 'error' => 'Missing required fields']);
        }

        $model = new Post();
        $id = $model->insert([
            'person_base_id' => $personBaseId,
            'content' => $content,
            'post_date' => $postDate,
        ]);

        return json_encode(['Success' => true, 'id' => $id]);
    }

    public function update(int $id): string
    {
        header('Content-Type: application/json');
        $id = (int) $id;
        if ($id <= 0) {
            http_response_code(400);
            return json_encode(['Success' => false, 'error' => 'Invalid ID']);
        }

        $data = [];
        if (isset($_POST['person_base_id'])) {
            $data['person_base_id'] = (int) $_POST['person_base_id'];
        }
        if (isset($_POST['content'])) {
            $data['content'] = trim((string) $_POST['content']);
        }
        $d = isset($_POST['post_date_date']) ? trim((string) $_POST['post_date_date']) : '';
        $t = isset($_POST['post_date_time']) ? trim((string) $_POST['post_date_time']) : '';
        if (!empty($_POST['post_date'])) {
            $data['post_date'] = trim((string) $_POST['post_date']);
        } elseif ($d !== '' && $t !== '') {
            $data['post_date'] = $d . ' ' . $t . ':00';
        }
        if ($data === []) {
            http_response_code(422);
            return json_encode(['Success' => false, 'error' => 'No fields to update']);
        }

        $model = new Post();
        $model->update($id, $data);
        return json_encode(['Success' => true, 'id' => $id]);
    }
}


