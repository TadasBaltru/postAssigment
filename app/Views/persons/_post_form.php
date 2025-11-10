<form class="form" id="postForm">
    <input type="hidden" name="id" />
    <input type="hidden" name="post_date" />

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Person</label>
            <select name="person_base_id" class="form-control" required>
                <option value="">Select a person</option>
                <?php foreach (($persons ?? []) as $person) :
                    $val = $person['base_id']; ?>
                <option value="<?= $val ?>"><?= htmlspecialchars($person['name'] . ' ' . $person['surname'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Date</label>
            <input type="text" class="form-control datePicker" placeholder="Select date" id="createDateInput" name="post_date" />
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Content</label>
        <textarea class="form-control form-textarea" name="content" rows="6" maxlength="255" placeholder="Create content..." required></textarea>
        <div class="char-count">255 symbols left</div>
    </div>

    <div class="modal-footer d-flex flex-column-reverse flex-md-row gap-2">
        <button type="button" class="btn btn-secondary flex-fill form-btn-width" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        <button type="submit" class="btn btn-primary flex-fill form-btn-width">Save</button>
    </div>
</form>

