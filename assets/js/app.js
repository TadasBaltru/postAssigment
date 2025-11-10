/* global APP_BASE_PATH */
$(function() {
(function ($) {
	const BASE = window.APP_BASE_PATH || '';

    function loadCards(opts){
        opts = opts || {};
        // New Persons page: refresh desktop and mobile grids with pagination
        if ($('.posts-table tbody').length || $('.mobile-posts-list').length) {
            // Apply requested page/perPage into UI state before refresh
            if (typeof opts.perPage !== 'undefined') {
                var perStr = String(opts.perPage);
                $('.desktop-pagination-select, .mobile-pagination-select').val(perStr);
            }
            if (typeof opts.page !== 'undefined') {
                $('.desktop-pagination-nav, .mobile-pagination-nav')
                    .attr('data-current', opts.page)
                    .data('current', opts.page);
            }
            refreshPersons();
            return;
        }
        // Legacy home grid flow
        if (!$('#homeFilter').length) return;
        const params = $('#homeFilter').serialize();

    }

    // Loaders for Persons new design
    function buildPersonsQuery(){
        const groupId = $('#mobileGroupFilter').val() || '';
        const date = $('#dateFilter').val() || '';
        // read current page and per_page from UI (prefer attributes to avoid jQuery .data cache)
        var page = parseInt($('.desktop-pagination-nav').attr('data-current') || $('.mobile-pagination-nav').attr('data-current') || '1', 10);
        var per = parseInt($('.desktop-pagination-select').val() || $('.mobile-pagination-select').val() || '5', 10);
        const params = $.param({ group_id: groupId, date: date, page: page, per_page: per, partial: 1 });
        return params;
    }

    function refreshPersonsDesktop(){
        if (!$('.posts-table tbody').length) return;
        var baseUrl = window.location.pathname || '';
        $.ajax({ url: baseUrl + '?'+ buildPersonsQuery(), dataType: 'html' })
            .done(function(html, _status, xhr){
                $('.posts-table tbody').html(html);
                updatePaginationFromHeaders(xhr, 'desktop');
            });
    }

    function refreshPersonsMobile(){
        if (!$('.mobile-posts-list').length) return;
        var baseUrl = window.location.pathname || '';
        $.ajax({ url: baseUrl + '?'+ buildPersonsQuery() + '&view=mobile', dataType: 'html' })
            .done(function(html, _status, xhr){
                $('.mobile-posts-list').html(html);
                updatePaginationFromHeaders(xhr, 'mobile');
            });
    }

    function refreshPersons(){
        refreshPersonsDesktop();
        refreshPersonsMobile();
    }



    function updatePaginationFromHeaders(xhr, which){
        var total = parseInt(xhr.getResponseHeader('X-Total-Count') || '0', 10);
        var page = parseInt(xhr.getResponseHeader('X-Page') || '1', 10);
        var per = parseInt(xhr.getResponseHeader('X-Per-Page') || '5', 10);
        if (which === 'desktop'){
            renderPager('.desktop-pagination-nav', '.desktop-pagination-subtitle', '.desktop-pagination-select', page, per, total);
        } else {
            renderPager('.mobile-pagination-nav', '.mobile-pagination-subtitle', '.mobile-pagination-select', page, per, total);
        }
    }

    function renderPager(navSelector, labelSelector, selectSelector, page, per, total){
        var totalPages = Math.max(1, Math.ceil(total / Math.max(1, per)));
        var pages = [];
        if (totalPages <= 6){
            for (var i=1;i<=totalPages;i++){ pages.push(i); }
        } else {
            pages = [1,2,3,'dots', totalPages-1, totalPages];
        }
        var $nav = $(navSelector);
        $nav.attr('data-current', page);
        $nav.attr('data-total', totalPages);
        // keep jQuery cache in sync too
        $nav.data('current', page);
        $nav.data('total', totalPages);
        var html = '';
        var disabledPrev = page <= 1 ? ' disabled' : '';
        html += '<button class="'+(navSelector.indexOf('desktop')>=0?'desktop':'mobile')+'-page-btn '+(navSelector.indexOf('desktop')>=0?'desktop-page-btn-prev':'prev')+disabledPrev+'" data-page="prev">Buvęs</button>';
        pages.forEach(function(p){
            if (p === 'dots'){
                html += '<button class="'+(navSelector.indexOf('desktop')>=0?'desktop':'mobile')+'-page-btn dots" disabled>...</button>';
            } else {
                var active = (p === page) ? ' active' : '';
                html += '<button class="'+(navSelector.indexOf('desktop')>=0?'desktop':'mobile')+'-page-btn'+active+'" data-page="'+p+'">'+p+'</button>';
            }
        });
        var disabledNext = page >= totalPages ? ' disabled' : '';
        html += '<button class="'+(navSelector.indexOf('desktop')>=0?'desktop':'mobile')+'-page-btn '+(navSelector.indexOf('desktop')>=0?'desktop-page-btn-next':'next')+disabledNext+'" data-page="next">Kitas</button>';
        $nav.html(html);
        $(labelSelector).text('Dabar rodoma ' + per + ' iš ' + total);
        $(selectSelector).val(String(per));
    }


    $(document).on('submit', '#homeFilter', function(e){ e.preventDefault(); loadCards(); });
    $(document).on('click', '#resetFilter', function(){ $('#homeFilter')[0].reset(); loadCards(); });
    if (document.getElementById('postsGrid')) { /* initial content already server-rendered */ }
	$(document).on('click', '#resetBtn', function(){ $('#postForm').trigger('reset'); $('#postForm [name=id]').val(''); });
    createOrUpdatePost = function(){
        const $f = $('#postForm');
        const id = ($f.find('[name=id]').val() || '').trim();
        const url = id ? (BASE + '/posts/' + encodeURIComponent(id) + '/update') : (BASE + '/posts/store');
        $.ajax({ url: url, method: 'POST', data: $f.serialize(), dataType: 'json' })
            .done(function (json) {
                var success = json && (json.Success === true);
                if (success) {
                    if(!id){ $f.trigger('reset'); }
                    closeModal();
                    // Update whichever view is present
                    if (document.getElementById('postsGrid')) { loadCards(); }
                    refreshPersons();
                }
            })
            .fail(function(msg){ var response = JSON.parse(msg.responseText); $('#postError').text(response.error).removeAttr('hidden'); console.log(msg); });
    };

    // Modal interactions on home feed
    function openModal(){
        var $m = $('#postModal');
        if ($m.hasClass('modal') && window.bootstrap) {
            new bootstrap.Modal($m[0]).show();
        } else {
            $m.removeAttr('hidden');
        }
    }
    function closeModal(){
        var $m = $('#postModal');
        if ($m.hasClass('modal') && window.bootstrap) {
            var inst = bootstrap.Modal.getInstance($m[0]);
            if (inst) inst.hide();
        } else {
            $m.attr('hidden', 'hidden');
        }
        if ($('#postForm')[0]) { $('#postForm')[0].reset(); $('#postForm [name=id]').val(''); }
        // Hard cleanup in case backdrop sticks around
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css({ overflow: '', 'padding-right': '' });
    }
    $(document).on('click', '#openCreate, #openCreateDesktop', function(){
        $('#postModalLabel, #modalTitle').text('Post create');
        openModal();
    });
    $(document).on('click', '[data-close]', closeModal);
    // Ensure full cleanup after Bootstrap modal hides (Cancel/X/escape)
    $(document).on('hidden.bs.modal', '#postModal', function(){
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css({ overflow: '', 'padding-right': '' });
    });
    // Also wire generic Bootstrap dismiss buttons inside the form
    $(document).on('click', '#postModal [data-bs-dismiss="modal"]', function(){
        closeModal();
    });

    // Edit buttons from both desktop and mobile persons grids
    $(document).on('click', '.open-edit', function(){
        var $b = $(this);
        $('#postModalLabel, #modalTitle').text('Post edit');
        $('#postForm [name=id]').val($b.data('id'));
        var dt = ($b.data('date') || '').trim();
        $('#postForm [name=post_date]').val(dt);
        if (dt.length >= 10){
            $('#postForm [name=post_date_date]').val(dt.substring(0,10));
        }
        var timeMatch = dt.match(/\b(\d{2}:\d{2})/);
        if (timeMatch){ $('#postForm [name=post_date_time]').val(timeMatch[1]); }
        $('#postForm [name=person_base_id]').val($b.data('person'));
        $('#postForm [name=content]').val($b.data('content'));
        openModal();
    });

    // Submit modal via existing createOrUpdatePost and refresh grids/tables
    $('#postForm').off('submit').on('submit', function(e){ e.preventDefault();
        // compose hidden post_date
        var d = $('#postForm [name=post_date_date]').val();
        var t = $('#postForm [name=post_date_time]').val();
        if (d && t){ $('#postForm [name=post_date]').val(d + ' ' + t + ':00'); }
        createOrUpdatePost();
        refreshPersons();

    });

    // Delete from card
    $(document).on('click', '.delete-post', function(){
        var id = $(this).data('id');
        if (!confirm('Delete this post?')) return;
        $.ajax({ url: BASE + '/posts/' + id + '/delete', method: 'POST', dataType: 'json' })
            .done(function(json){
                if(json && (json.Success === true)){
                    loadCards();
                    refreshPersons();
                }
            });
    });

    // Hook filters on persons page
    $(document).on('change', '#mobileGroupFilter, #dateFilter', function(){ 
        // reset to page 1
        loadCards({ page: 1 });
    });

    // Pagination click handlers
    $(document).on('click', '.desktop-page-btn, .mobile-page-btn', function(){
        if ($(this).hasClass('dots') || $(this).hasClass('disabled')) return;
        var isDesktop = $(this).closest('.desktop-pagination-nav').length > 0;
        var $nav = isDesktop ? $('.desktop-pagination-nav') : $('.mobile-pagination-nav');
        var current = parseInt($nav.attr('data-current') || '1', 10);
        var total = parseInt($nav.attr('data-total') || '1', 10);
        var action = $(this).data('page');
        var target = current;
        if (action === 'prev') target = Math.max(1, current - 1);
        else if (action === 'next') target = Math.min(total, current + 1);
        else target = parseInt(action, 10) || 1;
        loadCards({ page: target });
    });

    // Per-page change
    $(document).on('change', '.desktop-pagination-select, .mobile-pagination-select', function(){
        var val = $(this).val();
        loadCards({ page: 1, perPage: val });
    });
})(jQuery);

$(document).ready(function() {
    $(".date-input").datepicker({
      dateFormat: "yy-mm-dd" 
    });
  });
});
