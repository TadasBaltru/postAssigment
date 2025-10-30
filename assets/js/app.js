/* global APP_BASE_PATH */
$(function() {
(function ($) {
	const BASE = window.APP_BASE_PATH || '';

    function loadCards(){
        const params = $('#homeFilter').serialize();
        $.ajax({ url: BASE + '/?partial=1&' + params, dataType: 'html' })
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
                    loadCards();
                }
            })
            .fail(function(msg){ var response = JSON.parse(msg.responseText); $('#postError').text(response.error).removeAttr('hidden'); console.log(msg); });
    };

    // Modal interactions on home feed
    function openModal(){ $('#postModal').removeAttr('hidden'); }
    function closeModal(){ $('#postModal').attr('hidden', 'hidden'); $('#postForm')[0].reset(); $('#postForm [name=id]').val(''); }
    $(document).on('click', '#openCreate', function(){ $('#modalTitle').text('Create Post'); openModal(); });
    $(document).on('click', '[data-close]', closeModal);
    $(document).on('click', '.open-edit', function(){
        var $b = $(this);
        console.log($b.data());
        $('#modalTitle').text('Edit Post');
        $('#postForm [name=id]').val($b.data('id'));
        $('#postForm [name=post_date]').val($b.data('date'));
        $('#postForm [name=person_base_id]').val($b.data('person'));
        $('#postForm [name=content]').val($b.data('content'));
        var dt = String($b.data('date')||'').split(' ');
        if (dt.length >= 2){
            $('#postForm [name=post_date_date]').val(dt[0]);
            $('#postForm [name=post_date_time]').val(dt[1].slice(0,5));
        }
        openModal();
    });

    // Submit modal via existing createOrUpdatePost and refresh grids/tables
    $('#postForm').off('submit').on('submit', function(e){ e.preventDefault();
        // compose hidden post_date
        var d = $('#postForm [name=post_date_date]').val();
        var t = $('#postForm [name=post_date_time]').val();
        if (d && t){ $('#postForm [name=post_date]').val(d + ' ' + t + ':00'); }
        createOrUpdatePost();

    });

    // Delete from card
    $(document).on('click', '.delete-post', function(){
        var id = $(this).data('id');
        if (!confirm('Delete this post?')) return;
        $.ajax({ url: BASE + '/posts/' + id + '/delete', method: 'POST', dataType: 'json' })
            .done(function(json){ if(json && (json.Success === true)){ loadCards();  } });
    });
})(jQuery);

$(document).ready(function() {
    $(".date-input").datepicker({
      dateFormat: "yy-mm-dd" 
    });
  });
});
