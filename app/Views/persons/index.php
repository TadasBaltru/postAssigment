<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        :root {
            --primary-color: #96DCE7;
            --secondary-color: #9fa6b2;
            --border-color: #9fa6b2;
            --card-bg: #f8f9fa;
            --primary-hover-color: #61C0CF;
            --posts-list-color: #E9FCFF;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: #333;
            background-color: #fff;
        }
        
        .main-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: #1a1a1a;
        }
        
        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }
        
        .search-container {
            flex-grow: 1;
            max-width: 400px;
        }
        
        .search-input {
            border-radius: 8px;
            padding: 10px 15px 10px 0 !important;
            border: 1px solid var(--border-color);
            border-left: none!important;
            width: 100%;
        }

        
        .filter-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            background-color: white;
            min-width: 150px;
        }
        
        .divider {
            border-top: 1px solid var(--border-color);
            margin: 25px 0;
        }
        
        .section-title {
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.25rem;
        }
        
        .post-item {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 0;
            gap: 15px;
        }
        
        .post-date-group {
            min-width: 150px;
            font-weight: 500;
        }
        
        .post-content {
            flex-grow: 1;
        }
        
        .post-author {
            min-width: 150px;
            text-align: right;
        }
        
        .action-buttons {
            display: flex;
            justify-content: flex-end; /* optional */
            overflow: hidden;
            height: 44px;
            width: auto; /* fixed width */
        }

        .action-buttons .btn-icon {
            height: 100%;
            width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary-color);
            cursor: pointer;
            background-color: #FFFFFF;

        }

        .btn-edit {
            border: 1px solid var(--border-color);
            border-right: none;       /* remove right border to join with next */
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .btn-delete {
            border: 1px solid var(--border-color);
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .action-buttons .btn-icon:hover {
            color: var(--primary-color);

        }

        
        .posts-list {
            background-color: var(--posts-list-color);
        }
        .mobile-posts-list {
            background-color: var(--posts-list-color);
        }
        /* Mobile Styles */
        .mobile-post-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .mobile-post-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .mobile-post-group {
            font-weight: 600;
            color: black;
            border: 1px solid var(--posts-list-color);
            background-color: var(--posts-list-color);
            padding: 2px 8px;
            border-radius: 22px;
        }
        
        
        .mobile-post-content {
            margin-bottom: 10px;
            line-height: 1.4;
            color: black;
        }
        
        .mobile-post-author {
            font-size: 0.9rem;
            color: black;
        }
        
        .mobile-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 10px 0;
        }
        
        .pagination-info {
            font-size: 0.9rem;
            color: var(--secondary-color);
        }
        
        .pagination-controls {
            display: flex;
            gap: 5px;
        }
        
        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: white;
        }
        
        .page-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 20px 25px;
        }
        
        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            width: 100%;
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .char-count {
            text-align: left;
            font-size: 0.9rem;
            color: var(--secondary-color);
            margin-top: 5px;
        }
        
        .modal-footer {
            border-top: 1px solid var(--border-color);
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: black;
            box-shadow: 0px 1px 4.3px #818181;
            font-size: 1.2rem;
            &:hover {
                background-color: var(--primary-hover-color);
            }
        }
        
        .btn-secondary {
            background-color: white;
            color: #333;
            border: 1px solid var(--border-color);
            font-size: 1.2rem;
        }

        .icon-bold {
            font-size: 1.5rem !important;
            text-shadow: 0 0 1px currentColor;
        }
        .btn-edit img {
            width: 40px;
            height: 42px;
            object-fit: fill;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .filter-section {
                flex-direction: column;
            }
            
            .search-container {
                max-width: 100%;
            }
            
            .desktop-view {
                display: none;
            }
            
            .mobile-view {
                display: block;
            }
            
            .form-row {
                flex-direction: column;
                gap: 20px;
            }
            
            .modal-body {
                padding: 20px;
            }
            .form-btn-width {
                width: 100% !important;
             }
        }
        
        @media (min-width: 769px) {
            .mobile-view {
                display: none;
            }
            
            .desktop-view {
                display: block;
            }
            .form-btn-width {
            width: 45% !important;
         }
        }

        /* Calendar Styles */
        .calendar {
            width: 100%;
            border-collapse: collapse;
        }
        
        .calendar th {
            text-align: center;
            padding: 10px;
            font-weight: 500;
            color: var(--secondary-color);
        }
        
        .calendar td {
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        
        .calendar td:hover {
            background-color: #f0f0f0;
        }
        
        .calendar td.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .calendar .other-month {
            color: #ccc;
        }
        .globe-icon-container {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: var(--Featured-fill, #E9FCFF);        
        display: flex;               /* make container flex */
        align-items: center;         /* vertical center */
        justify-content: center;     /* horizontal center */
    }
    .globe-icon {

        display: block;
        border: 6px solid #CDF2F7;
        background-color: #CDF2F7;
        border-radius: 50%;
    }
    .flatpickr-day.selected {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: black !important;
    }
    </style>
</head>
<body>

        
        <!-- Desktop View -->
        <div class="desktop-view main-container">
        <i class="globe-icon-container"><img class="globe-icon " src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/globe-01.svg"></i>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title mb-0 bold"> Posts</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">
                    <i class="bi bi-plus"></i> Add Post
                </button>
            </div>
            
            <div class="filter-section">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search for posts...">
                </div>
                <select class="filter-select" id="groupFilter">
                    <option>Group filter</option>
                    <option>Design</option>
                    <option>News</option>
                    <option>Marketing</option>
                    <option>Group x</option>
                    <option>Group x</option>
                    <option>Group x</option>
                    <option>Group x</option>
                    <option>Group x</option>
                    <option>Group x</option>

                </select>
                <!-- <input class="filter-select" id="dateFilter" type="text" placeholder="Select date"> -->
            </div>
            
            <div class="divider"></div>
            
            <h2 class="section-title">News</h2>
            
            <div class="posts-list">
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
        </div>
        
        <!-- Mobile View -->
        <div class="mobile-view">
            <div class="main-container">
                <i class="globe-icon-container"><img class="globe-icon " src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/globe-01.svg"></i>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="page-title mb-0">Posts</h1>
                    <button class="btn btn-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;" data-bs-toggle="modal" data-bs-target="#createPostModal">
                        <i class="bi bi-plus icon-bold"></i>
                    </button>
                </div>
                
                <div class="search-container mb-3 input-group">
                    <span class="input-group-text" style="background-color: #FFFFFF !important; border: 1px solid var(--border-color); border-right: none;">
                        <img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/search-lg.svg" alt="search" width="16" height="16">
                    </span>
                    <input type="text" class="form-control search-input" placeholder="Search for posts...">
                </div>
                
                <div class="d-flex mb-3 flex-row">
                    <select class="filter-select form-select me-2 w-50" id="mobileGroupFilter">
                        <option>Group filter</option>
                        <option>Design</option>
                        <option>News</option>
                        <option>Marketing</option>
                        <option>Group x</option>
                    </select>
                    <div class="input-group w-50">
                        <span class="input-group-text " style="background-color: #FFFFFF !important; border: 1px solid var(--border-color); border-right: none;">
                            <img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/calendar.svg" alt="calendar" width="16" height="16">
                        </span>
                        <input class="form-control search-input " style="width:85%" id="dateFilter" type="text" placeholder="Select date">
                    </div>
                </div>
            </div>
            <div class="mobile-posts-list main-container">
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