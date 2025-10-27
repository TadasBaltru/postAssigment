<?php
declare(strict_types=1);

namespace Core;

final class Router
{
	/** @var array<string, array<int, array{pattern: array{regex:string,paramNames:array<int,string>}, handler: mixed}>> */
	private array $routes = [];

	private string $basePath = '';

	public function __construct(?string $basePath = null)
	{
		if ($basePath === null) {
			$scriptName = (string) ($_SERVER['SCRIPT_NAME'] ?? '');
			$detected = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
			$basePath = ($detected === '/' || $detected === '.') ? '' : $detected;
		}
		$this->basePath = $basePath;
	}

	public function get(string $path, $handler): void { $this->addRoute('GET', $path, $handler); }
	public function post(string $path, $handler): void { $this->addRoute('POST', $path, $handler); }

	private function addRoute(string $method, string $path, $handler): void
	{
		$this->routes[$method][] = [
			'pattern' => $this->convertPathToRegex($path),
			'handler' => $handler,
		];
	}

	public function dispatch(string $requestMethod, string $requestUri): void
	{
		$method = strtoupper($requestMethod);
		$path = $this->normalize(parse_url($requestUri, PHP_URL_PATH) ?: '/');
		$path = $this->stripBasePath($path);

		foreach ($this->routes[$method] ?? [] as $route) {
			if (preg_match($route['pattern']['regex'], $path, $matches)) {
				$params = [];
				foreach ($route['pattern']['paramNames'] as $i => $name) {
					$params[$name] = $matches[$i + 1] ?? null;
				}
				$this->invoke($route['handler'], $params);
				return;
			}
		}

		http_response_code(404);
		echo '404 Not Found';
	}

	private function normalize(string $path): string
	{
		if ($path !== '/' && str_ends_with($path, '/')) {
			$path = rtrim($path, '/');
		}
		return $path === '' ? '/' : $path;
	}

	/** @return array{regex:string,paramNames:array<int,string>} */
	private function convertPathToRegex(string $path): array
	{
		$paramNames = [];
		$normalized = $this->normalize($path);
		$regex = preg_replace_callback(
			'#\{([a-zA-Z_][a-zA-Z0-9_]*)(?::([^}]+))?\}#',
			function ($m) use (&$paramNames) {
				$paramNames[] = $m[1];
				$pat = $m[2] ?? '[^/]+';
				return '(' . $pat . ')';
			},
			$normalized
		);
		return [
			'regex' => '#^' . $regex . '$#',
			'paramNames' => $paramNames,
		];
	}

	private function stripBasePath(string $path): string
	{
		if ($this->basePath === '' || $this->basePath === '/') {
			return $path;
		}
		// Exact match to base path -> root
		if ($path === $this->basePath) {
			return '/';
		}
		// Prefixed with base path -> trim it
		$prefix = $this->basePath . '/';
		if (str_starts_with($path, $prefix)) {
			$trimmed = substr($path, strlen($this->basePath));
			return $this->normalize($trimmed);
		}
		return $path;
	}

	/** @param mixed $handler */
	private function invoke($handler, array $params): void
	{
		if (is_callable($handler)) {
			echo (string) (call_user_func_array($handler, $params) ?? '');
			return;
		}

		if (is_array($handler) && count($handler) === 2) {
			[$controller, $method] = $handler;
			if (is_string($controller)) {
				$controller = $this->resolveControllerClass($controller);
			}
			$instance = is_object($controller) ? $controller : new $controller();
			echo (string) (call_user_func_array([$instance, $method], $params) ?? '');
			return;
		}

		throw new \InvalidArgumentException('Invalid route handler');
	}

	private function resolveControllerClass(string $controller): string
	{
		$class = $controller;
		if (!str_contains($class, '\\')) {
			$base = ucfirst($class);
			if (!str_ends_with(strtolower($base), 'controller')) {
				$base .= 'Controller';
			}
			$class = 'App\\Controllers\\' . $base;
		}
		if (!class_exists($class)) {
			throw new \RuntimeException("Controller {$class} not found");
		}
		return $class;
	}
}


