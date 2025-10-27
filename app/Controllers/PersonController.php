<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Person;

final class PersonController extends Controller
{
	public function index(): string
	{
		$persons = (new Person())->all();
        return $this->render('persons/index', compact('persons'));

	}
}


