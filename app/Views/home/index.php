<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Posts</title>
  <link rel="stylesheet" href="/assets/css/app.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="/assets/js/app.js"></script>
</head>
<body>
  <?php require __DIR__ . '/../partials/nav.php'; ?>
  <h1>Posts</h1>
  <div style="margin-bottom:1rem">
    <button class="btn btn--primary" id="openCreate">Create post</button>
  </div>
  <form id="homeFilter" style="margin-bottom:1rem; display:flex; gap:.5rem; flex-wrap:wrap; align-items:center;">
    <select name="group_id" id="groupSelect" class="field__input">
      <option value="">All groups</option>
      <?php
      foreach ($groups as $g): ?>
        <option value="<?= $g['id'] ?>"><?= $g['name'] ?></option>
      <?php endforeach; ?>
      ?>
    </select>

    <input class="field__input date-input"  type="date" name="date" id="dateInput" />
    <button type="submit" class="btn" id="applyFilter">Filter</button>
    <button type="button" class="btn btn--ghost" id="resetFilter">Reset</button>
  </form>

  <?php require __DIR__ . '/_grid.php'; ?>
  <?php require __DIR__ . '/_post_modal.php'; ?>
</body>
</html>


