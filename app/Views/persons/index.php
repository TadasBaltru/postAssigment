<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Management</title>  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/css/new_app.css">
  

</head>
<body>

        
        
            <div class="main-container">
                <i class="globe-icon-container"><img class="globe-icon " src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/globe-01.svg"></i>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="page-title mb-0">Posts</h1>
                    <button id="openCreate" class="btn btn-primary mobile-view" style="width: 40px; height: 36px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-plus icon-bold"></i>
                    </button>
                    <button id="openCreateDesktop" class="btn btn-primary desktop-view">
                    <i class="bi bi-plus"></i> Add Post
                </button>                
                </div>

                
                <div class="row g-2 g-md-3 align-items-stretch mb-3 filter-row">
                    <div class="col-12 col-md-6">
                        <div class="search-container input-group h-100">
                            <span class="input-group-text" style="background-color: #FFFFFF !important; border: 1px solid var(--border-color); border-right: none;">
                                <img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/search-lg.svg" alt="search" width="16" height="16">
                            </span>
                            <input type="text" class="form-control search-input" placeholder="Search for posts...">
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="filter-select form-select h-100" id="mobileGroupFilter">
                            <option>Group filter</option>
                            <option>Design</option>
                            <option>News</option>
                            <option>Marketing</option>
                            <option>Group x</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="input-group date-filter-group h-100">
                            <span class="input-group-text" style="background-color: #FFFFFF !important; border: 1px solid var(--border-color); border-right: none;">
                                <img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/calendar.svg" alt="calendar" width="16" height="16">
                            </span>
                            <input class="form-control search-input" id="dateFilter" type="text" placeholder="Select date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="posts-list desktop-view py-4">
                <div class="table-responsive posts-table-wrapper main-container">
                    <table class="table posts-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 11%;">Date</th>
                                <th scope="col" style="width: 11%;">Group</th>
                                <th scope="col" style="width: 50%;">Post</th>
                                <th scope="col" style="width: 11%;">Author</th>
                                <th scope="col" style="width: 11%;">Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php require __DIR__ . '/_new_desktop_grid.php'; ?>
                        </tbody>
                    </table>
                    <?php
                        $page = isset($page) ? (int)$page : 1;
                        $perPage = isset($perPage) ? (int)$perPage : 5;
                        $total = isset($total) ? (int)$total : (isset($posts) ? count($posts) : 0);
                        $totalPages = isset($totalPages) ? (int)$totalPages : 1;
                        $buildPages = function(int $page, int $totalPages): array {
                            if ($totalPages <= 6) {
                                return range(1, max(1, $totalPages));
                            }
                            return [1,2,3,'…', max(1,$totalPages-1), $totalPages];
                        };
                        $pagesList = $buildPages($page, $totalPages);
                    ?>
                    <div class="desktop-pagination desktop-view">
                        <div class="desktop-pagination-wrapper">
                            <div class="desktop-pagination-left">
                                <div class="desktop-pagination-info">
                                    <span class="desktop-pagination-label">Rodomų įrašų skaičius</span>
                                    <span class="desktop-pagination-subtitle">Dabar rodoma <?= $perPage ?> iš <?= $total ?></span>
                                </div>
                                <select class="form-select desktop-pagination-select">
                                    <option value="5" <?= $perPage === 5 ? 'selected' : '' ?>>5</option>
                                    <option value="10" <?= $perPage === 10 ? 'selected' : '' ?>>10</option>
                                    <option value="25" <?= $perPage === 25 ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= $perPage === 50 ? 'selected' : '' ?>>50</option>
                                </select>
                            </div>
                            <div class="desktop-pagination-nav" data-current="<?= $page ?>" data-total="<?= $totalPages ?>">
                                <button class="desktop-page-btn desktop-page-btn-prev <?= $page <= 1 ? 'disabled' : '' ?>" data-page="prev">Buvęs</button>
                                <?php foreach ($pagesList as $p): ?>
                                    <?php if ($p === '…'): ?>
                                        <button class="desktop-page-btn dots" disabled>...</button>
                                    <?php else: ?>
                                        <button class="desktop-page-btn <?= ($p === $page) ? 'active' : '' ?>" data-page="<?= $p ?>"><?= $p ?></button>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <button class="desktop-page-btn desktop-page-btn-next <?= $page >= $totalPages ? 'disabled' : '' ?>" data-page="next">Kitas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-posts-list main-container mobile-view">
                <?php require __DIR__ . '/_mobile_grid.php'; ?>
            </div>
            <div class="mobile-pagination mobile-view">
                <div class="mobile-pagination-card">
                    <div class="mobile-pagination-top">
                        <div class="mobile-pagination-info">
                            <span class="mobile-pagination-label">Rodomų įrašų skaičius</span>
                            <span class="mobile-pagination-subtitle">Dabar rodoma <?= $perPage ?> iš <?= $total ?></span>
                        </div>
                        <select class="form-select mobile-pagination-select">
                            <option value="5" <?= $perPage === 5 ? 'selected' : '' ?>>5</option>
                            <option value="10" <?= $perPage === 10 ? 'selected' : '' ?>>10</option>
                            <option value="25" <?= $perPage === 25 ? 'selected' : '' ?>>25</option>
                            <option value="50" <?= $perPage === 50 ? 'selected' : '' ?>>50</option>
                        </select>
                    </div>
                    <div class="mobile-pagination-nav" data-current="<?= $page ?>" data-total="<?= $totalPages ?>">
                        <button class="mobile-page-btn prev <?= $page <= 1 ? 'disabled' : '' ?>" data-page="prev">Buvęs</button>
                        <?php foreach ($pagesList as $p): ?>
                            <?php if ($p === '…'): ?>
                                <button class="mobile-page-btn dots" disabled>...</button>
                            <?php else: ?>
                                <button class="mobile-page-btn <?= ($p === $page) ? 'active' : '' ?>" data-page="<?= $p ?>"><?= $p ?></button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <button class="mobile-page-btn next <?= $page >= $totalPages ? 'disabled' : '' ?>" data-page="next">Kitas</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Post Modal (Create/Edit) -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Post create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php require __DIR__ . '/_post_form.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            // Character counter for textareas
            $('textarea').on('input', function() {
                const maxLength = 255;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;
                
                // Find the character count element
                const charCount = $(this).siblings('.char-count');
                charCount.text(remaining + ' symbols left');
            });
            
            flatpickr("#dateFilter", {
                dateFormat: "Y-m-d",
                allowInput: true,
                placeholder: "Select date"
            });
            flatpickr("#createDateInput", {
                dateFormat: "Y-m-d",
                allowInput: true,
                placeholder: "Select date"
            });
            // Open modal using shared form
            $('#openCreate, #openCreateDesktop').on('click', function(){
                $('#postModalLabel').text('Create Post');
                $('#postForm')[0].reset();
                $('#postForm [name=id]').val('');
                const modal = new bootstrap.Modal(document.getElementById('postModal'));
                modal.show();
            });
        });
    </script>
</body>
</html>