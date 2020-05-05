<tr data-id="<?= $event->id ?>" data-name="<?= $event->name ?>" data-labelColor="<?= $event->labelColor ?>">
<td><?= $this->App->badge($event->labelColor, '&nbsp;'); ?>&nbsp;&nbsp;<span><?= $event->name ?></span></td>
</tr>