<div class="modal" id="postModal" hidden>
	<div class="modal__backdrop" data-close></div>
	<div class="modal__dialog">
		<header class="modal__header">
			<h3 id="modalTitle">Create Post</h3>
			<button class="modal__close" type="button" data-close>&times;</button>
		</header>
		<div class="modal__body">
			<form class="form" id="postForm">
				<input type="hidden" name="id" />

				<div class="form__row form__row--two">
					<div class="field">
						<label class="field__label">Person</label>
						<select name="person_base_id" class="field__input" required>
							<option value="">Select person...</option>
							<?php foreach (($persons ?? []) as $person): $val = $person['base_id']; ?>
							<option value="<?= $val ?>"><?= htmlspecialchars($person['name'] . ' ' . $person['surname'], ENT_QUOTES, 'UTF-8') ?> (<?= $val ?>)</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field">
						<label class="field__label">Date</label>
						<input class="field__input" type="date" name="post_date" value="<?= $post['post_date'] ?? '' ?>" required />
					</div>

				</div>
				<div class="field">
					<label class="field__label">Content</label>
					<textarea class="field__input" name="content" rows="6" required></textarea>
				</div>
				<div class="actions">
					<button class="btn btn--primary" type="submit" id="createBtn">Save</button>
					<button class="btn btn--ghost" type="button" data-close>Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>


