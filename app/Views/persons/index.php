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
                    <button class="btn btn-primary mobile-view" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;" data-bs-toggle="modal" data-bs-target="#createPostModal">
                        <i class="bi bi-plus icon-bold"></i>
                    </button>
                    <button class="btn btn-primary desktop-view" data-bs-toggle="modal" data-bs-target="#createPostModal">
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
            <div class="posts-list desktop-view">
                <div class="post-item">
                    <div class="post-date-group">2025.02.11 News</div>
                    <div class="post-content">
                        <div>Lorem ipsum dolor sit amet consectetur. Diam proin quis at odio id eros vel. Faucibus blandit dictumst amet at laculis</div>
                    </div>
                    <div class="post-author">
                        Grace Wilson
                        <div class="action-buttons">
                            <button class="btn-icon" data-bs-toggle="modal" data-bs-target="#editPostModal">
                                <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg"></i>
                            </button>
                            <button class="btn-icon">
                                <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="post-item">
                    <div class="post-date-group">2025.02.11 Marketing</div>
                    <div class="post-content">
                        <div>Lorem ipsum dolor sit amet consectetur. Diam proin quis at odio id eros vel. Faucibus blandit dictumst amet at laculis</div>
                    </div>
                    <div class="post-author">
                        Grace Wilson
                        <div class="action-buttons">
                            <button class="btn-icon" data-bs-toggle="modal" data-bs-target="#editPostModal">
                                <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg"></i>
                            </button>
                            <button class="btn-icon">
                                <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="post-item">
                    <div class="post-date-group">2025.02.11 Design</div>
                    <div class="post-content">
                        <div>Lorem ipsum dolor sit amet consectetur. Diam proin quis at odio id eros vel. Faucibus blandit dictumst amet at laculis</div>
                    </div>
                    <div class="post-author">
                        Grace Wilson
                        <div class="action-buttons">
                            <button class="btn-icon" data-bs-toggle="modal" data-bs-target="#editPostModal">
                                <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg"></i>
                            </button>
                            <button class="btn-icon">
                                <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-posts-list main-container mobile-view">
                <div class="mobile-post-card">
                    <div class="mobile-post-header">
                        <span class="mobile-post-group">News</span>
                        <span class="mobile-post-date">2025.02.11</span>
                    </div>
                    <div class="mobile-post-content">
                        Lorem ipsum dolor sit amet consectetur. Diam proin quis at odio id eros vel. Faucibus blandit dictumst amet at iaculis ornare tellus semper.
                    </div>
                    <div class="mobile-post-author">
                        Author:<br> Grace Wilson
                    </div>
                    <div class="action-buttons mt-2 flex-row justify-content-end">
                        <button class="btn-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editPostModal">
                            <i><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg"></i>
                        </button>
                        <button class="btn-icon btn-delete">
                            <i><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mobile-post-card">
                    <div class="mobile-post-header">
                        <span class="mobile-post-group">Marketing</span>
                        <span class="mobile-post-date">2025.02.11</span>
                    </div>
                    <div class="mobile-post-content">
                        Lorem ipsum dolor sit amet consectetur. Diam proin quis at odio id eros vel. Faucibus blandit dictumst amet at iaculis ornare tellus semper.
                    </div>
                    <div class="mobile-post-author">
                    Author:<br> Grace Wilson
                    </div>
                    <div class="action-buttons mt-2 flex-row justify-content-end">
                        <button class="btn-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editPostModal">
                            <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg"></i>
                        </button>
                        <button class="btn-icon btn-delete">
                            <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mobile-post-card">
                    <div class="mobile-post-header">
                        <span class="mobile-post-group">Design</span>
                        <span class="mobile-post-date">2025.02.11</span>
                    </div>
                    <div class="mobile-post-content">
                        Lorem ipsum dolor sit amet consectetur. Diam proin quis at odio id eros vel. Faucibus blandit dictumst amet at iaculis ornare tellus semper.
                    </div>
                    <div class="mobile-post-author">
                    Author:<br> Grace Wilson

                    </div>
                    <div class="action-buttons mt-2 flex-row justify-content-end">
                        <button class="btn-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editPostModal">
                            <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg"></i>
                        </button>
                        <button class="btn-icon btn-delete">
                            <i ><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mobile-pagination main-container">
                <div class="pagination-info">
                    Rodomy jrasy skaizius<br>
                    Dabar rodoma 5 iš 100
                </div>
                <div class="pagination-controls">
                    <button class="page-btn">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">9</button>
                    <button class="page-btn">0</button>
                    <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
        </div>

    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Post create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Person</label>
                            <select class="form-control">
                                <option>Select a person</option>
                                <option>Grace Wilson</option>
                                <option>Delilah Kimber</option>
                                <option>John Smith</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="text" class="form-control" placeholder="Select date" id="createDateInput" data-bs-toggle="modal" data-bs-target="#calendarModal" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Content</label>
                        <textarea class="form-control form-textarea" placeholder="Create content..." maxlength="255"></textarea>
                        <div class="char-count">255 symbols left</div>
                    </div>
                </div>
                <div class="modal-footer d-flex flex-column-reverse flex-md-row  gap-2">
                    <button type="button" class="btn btn-secondary flex-fill form-btn-width" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary flex-fill form-btn-width">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Post edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Person</label>
                            <select class="form-control">
                                <option>Delilah Kimber</option>
                                <option>Grace Wilson</option>
                                <option>John Smith</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="text" class="form-control" value="2024-12-01" id="editDateInput" data-bs-toggle="modal" data-bs-target="#calendarModal" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Content</label>
                        <textarea class="form-control form-textarea" maxlength="255">Lorem ipsum dolor sit amet consectetur. Leo turpis ut posuere urna lobortis sit. Urna sodales pellentesque facilisis eleifend.</textarea>
                        <div class="char-count">130 symbols left</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm editing</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Modal -->
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Calendar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-sm btn-secondary"><i class="bi bi-chevron-left"></i></button>
                        <h6 class="mb-0">January, 2022</h6>
                        <button class="btn btn-sm btn-secondary"><i class="bi bi-chevron-right"></i></button>
                    </div>
                    <table class="calendar">
                        <thead>
                            <tr>
                                <th>Mo</th>
                                <th>Tu</th>
                                <th>We</th>
                                <th>Th</th>
                                <th>Fr</th>
                                <th>Sat</th>
                                <th>Su</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="other-month">26</td>
                                <td class="other-month">27</td>
                                <td class="other-month">28</td>
                                <td class="other-month">29</td>
                                <td class="other-month">30</td>
                                <td class="other-month">31</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                            </tr>
                            <tr>
                                <td>30</td>
                                <td>31</td>
                                <td class="other-month">1</td>
                                <td class="other-month">2</td>
                                <td class="other-month">3</td>
                                <td class="other-month">4</td>
                                <td class="other-month">5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
            
            // Calendar date selection
            let selectedDateInput = null;
            
            $('#createDateInput, #editDateInput').on('click', function() {
                selectedDateInput = $(this);
            });
            
            $('.calendar td:not(.other-month)').on('click', function() {
                if (selectedDateInput) {
                    const day = $(this).text();
                    const monthYear = $('#calendarModal .modal-body h6').text();
                    selectedDateInput.val(`${day} ${monthYear}`);
                    
                    // Close the calendar modal
                    const calendarModal = bootstrap.Modal.getInstance(document.getElementById('calendarModal'));
                    calendarModal.hide();
                }
            });
            
            // Initialize modals
            const createPostModal = new bootstrap.Modal(document.getElementById('createPostModal'));
            const editPostModal = new bootstrap.Modal(document.getElementById('editPostModal'));
            const calendarModal = new bootstrap.Modal(document.getElementById('calendarModal'));
            flatpickr("#dateFilter", {
                dateFormat: "Y-m-d",
                allowInput: true,
                placeholder: "Select date"
            });
        });
    </script>
</body>
</html>