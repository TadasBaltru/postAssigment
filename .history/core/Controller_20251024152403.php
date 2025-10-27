<?php
declare(strict_types=1);

namespace Core;

abstract class Controller
{
	protected function render(string $viewRelativePath, array $data = []): string
	{
		$base = __DIR__ . '/../app/Views/';
		$viewFile = $base . ltrim($viewRelativePath, '/');
		if (!str_ends_with($viewFile, '.php')) {
			$viewFile .= '.php';
		}
		if (!is_file($viewFile)) {
			throw new \RuntimeException("View not found: {$viewRelativePath}");
		}
		extract($data, EXTR_SKIP);
		ob_start();
		require $viewFile;
		return (string) ob_get_clean();
	}
}


