<tr data-id="<?= $personCategory->id ?>" data-name="<?= $personCategory->name ?>" data-labelColor="<?= $personCategory->labelColor ?>">
<td><?= $this->App->badge($personCategory->labelColor, '&nbsp;'); ?>&nbsp;&nbsp;<span><?= $personCategory->name ?></span></td>
</tr>