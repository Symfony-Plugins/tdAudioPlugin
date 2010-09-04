<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($td_track_album, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($td_track_album, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php include_partial('ajax_main_active', array('td_track_album' => $td_track_album)) ?>
  </ul>
</td>
