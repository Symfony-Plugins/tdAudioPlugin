<?php use_helper('I18N') ?>
<li class="sf_admin_action_deactivate" id="ajax_deactivate_<?php echo $td_track_album->getId() ?>">
<?php use_helper('jQuery'); ?>
  <?php echo jq_link_to_remote(__('Deactivate', array(), 'sf_admin'), array(
    'update'   => 'audio_is_active_action_'.$td_track_album->getId(),
    'url'      => '@ajax_audio_deactivate?id='.$td_track_album->getId(),
    'script' => true,
    'complete' => jq_remote_function( array(
      'update' => 'audio_is_active_column_'.$td_track_album->getId(),
      'url'    => 'graphics/empty',
      'script' => true
    )),
  )) ?>
</li>
