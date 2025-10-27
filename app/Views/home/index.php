<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>
  <link rel="stylesheet" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/css/app.css" />
</head>
<body>
  <h1><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></h1>
  <form method="post" action="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/submit">
    <input name="name" placeholder="Your name" />
    <button type="submit">Send</button>
  </form>
  <ul>
    <?php foreach ($posts as $post) : ?>
      <li><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
  </ul>
  <script src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/js/app.js"></script>
</body>
</html>


