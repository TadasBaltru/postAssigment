<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Group;

final class GroupController extends Controller
{
	public function index(): string
	{
		$groups = (new Group())->all();
		return $this->render('groups/index', compact('groups'));
	}
}



