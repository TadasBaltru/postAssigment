/* global APP_BASE_PATH */
console.log('app.js loaded');
$(function() {
(function ($) {
	const BASE = window.APP_BASE_PATH || '';

	function escapeHtml(s) {
		return String(s || '')
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
	}

	function renderRows(items) {
		const $tbody = $('#postsTable tbody');
		const rows = items.map(function (p) {
			return '<tr>' +
				'<td>' + Number(p.id) + '</td>' +
				'<td>' + Number(p.person_base_id) + '</td>' +
				'<td>' + escapeHtml(p.content) + '</td>' +
				'<td>' + escapeHtml(p.post_date) + '</td>' +
				'<td><button type="button" class="edit-btn" data-id="' + Number(p.id) + '" data-person="' + Number(p.person_base_id) + '" data-content="' + escapeHtml(p.content) + '" data-date="' + escapeHtml(p.post_date) + '">Edit</button></td>' +
			'</tr>';
		}).join('');
		$tbody.html(rows);
	}
    // Home page: filter to cards
    function loadCards(){
        const params = $('#homeFilter').serialize();
        $.ajax({ url: BASE + '?' + params, dataType: 'html' })
            .done(function(html){
                const $grid = $(html).filter('#postsGrid');
                if ($grid.length) {
                    $('#postsGrid').replaceWith($grid);
                } else {
                    // Fallback: replace container content
                    $('.grid').replaceWith(html);
                }
            });
    }

	function createOrUpdatePost() {
        console.log('createOrUpdatePost');
		const $f = $('#postForm');
		const id = ($f.find('[name=id]').val() || '').trim();
		const url = id ? (BASE + '/posts/' + encodeURIComponent(id) + '/update') : (BASE + '/posts/store');
        console.log(url);
		$.ajax({ url: url, method: 'POST', data: $f.serialize(), dataType: 'json' })
			.done(function (json) {
				if (json.ok) {
                    if(!id){
                        $f.trigger('reset');
                    }

				} else {
					alert(json.error || 'Error');
				}
			});
	}

	function onClickEdit(e) {
		const $btn = $(e.currentTarget);
		$('#postForm [name=id]').val($btn.data('id'));
		$('#postForm [name=person_base_id]').val($btn.data('person'));
		$('#postForm [name=content]').val($btn.data('content'));
		// Convert to datetime-local if needed
		var dt = ($btn.data('date') || '').replace(' ', 'T').slice(0, 16);
		$('#postForm [name=post_date]').val(dt);
	}

    // Home filter handlers
    $(document).on('submit', '#homeFilter', function(e){ e.preventDefault(); loadCards(); });
    $(document).on('click', '#resetFilter', function(){ $('#homeFilter')[0].reset(); loadCards(); });
    if (document.getElementById('postsGrid')) { /* initial content already server-rendered */ }
	$(document).on('click', '#resetBtn', function(){ $('#postForm').trigger('reset'); $('#postForm [name=id]').val(''); });
	$(document).on('click', '.edit-btn', onClickEdit);
    $('#postForm').on('submit', function(e) {
        e.preventDefault();
        createOrUpdatePost();
      });

    // After create/update, refresh manage posts table via partial
    function refreshManageTable(){
        var $table = $('body').find('table').first();
        if ($table.length === 0) return;
        $.get(BASE + '/posts?partial=1', function(html){
            // Replace table html
            var $newTable = $(html).filter('table');
            if ($newTable.length) {
                $table.replaceWith($newTable);
            }
        });
    }

    // Hook into createOrUpdatePost completion to refresh UIs
    const _orig = createOrUpdatePost;
    createOrUpdatePost = function(){
        const $f = $('#postForm');
        const id = ($f.find('[name=id]').val() || '').trim();
        const url = id ? (BASE + '/posts/' + encodeURIComponent(id) + '/update') : (BASE + '/posts/store');
        $.ajax({ url: url, method: 'POST', data: $f.serialize(), dataType: 'json' })
            .done(function (json) {
                if (json && (json.ok || json.Success)) {
                    if(!id){ $f.trigger('reset'); }
                    refreshManageTable();
                    // Also refresh home grid if present
                    if (document.getElementById('homeFilter')) { loadCards(); }
                } else {
                    alert((json && (json.error||json.message)) || 'Error');
                }
            });
    };
})(jQuery);

});
