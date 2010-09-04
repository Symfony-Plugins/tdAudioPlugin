<td class="sf_admin_boolean sf_admin_list_td_active" id="audio_is_active_column_<?php echo $td_track_album->getId() ?>">
  <?php echo get_partial('td_track_album/list_field_boolean', array('value' => $td_track_album->getActive())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $td_track_album->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_author">
  <?php echo $td_track_album->getAuthor() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_released_at">
  <?php echo false !== strtotime($td_track_album->getReleasedAt()) ? format_date($td_track_album->getReleasedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description_short">
  <?php echo $td_track_album->getDescriptionShort() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($td_track_album->getUpdatedAt()) ? format_date($td_track_album->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
