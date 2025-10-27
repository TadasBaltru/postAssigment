<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>
  <link rel="stylesheet" href="/assets/css/app.css" />
</head>
<body>
  <h1><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></h1>
  <form method="post" action="/submit">
    <input name="name" placeholder="Your name" />
    <button type="submit">Send</button>
  </form>
  <script src="/assets/js/app.js"></script>
</body>
</html>


