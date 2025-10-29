<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\Person;

final class PostsController extends Controller
{
    public function view(int $id): string
    {
        $post = (new Post())->find($id);
        if (!$post) {
            http_response_code(404);
            return 'Post not found';
        }
        return $this->render('posts/view', compact('post'));
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
        $person = (new Person())->findByBaseIdAndDate($personBaseId, $postDate);
        if (!$person) {
            http_response_code(422);
            return json_encode(['Success' => false, 'error' => 'Person has no valid activity on this date']);
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
        $postDate = trim((string) ($_POST['post_date'] ?? ''));
        $person = (new Person())->findByBaseIdAndDate($data['person_base_id'], $postDate);
        if (!$person) {
            http_response_code(422);
            return json_encode(['Success' => false, 'error' => 'Person has no valid activity on this date']);
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
