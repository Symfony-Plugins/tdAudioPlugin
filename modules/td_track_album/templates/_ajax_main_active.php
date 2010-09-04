<span id="audio_is_active_action_<?php echo $td_track_album->getId() ?>">
  <?php if ($td_track_album->getActive()): ?>
    <?php include_partial('td_track_album/ajax_deactivate', array('td_track_album' => $td_track_album)) ?>
  <?php else: ?>
    <?php include_partial('td_track_album/ajax_activate', array('td_track_album' => $td_track_album)) ?>
  <?php endif; ?>
</span>