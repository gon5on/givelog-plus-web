<tr data-id="<?= $person->id ?>">
<td>
<span><?= $person->name ?></span>&nbsp;&nbsp;
<?php if ($person->personCategory): ?>
<?= $this->App->badge($person->personCategory->labelColor, $person->personCategory->name); ?>
<?php endif; ?>
</td>
</tr>