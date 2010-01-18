<?php use_helper('I18N') ?>

<h1><?php echo __('Audio album list', array(), 'td') ?></h1>

<?php if ($audios): ?>
<ul>
  <?php foreach ($audios as $audio): ?>
    <li>
      <div>
        <span class="audio_name"><?php echo $audio['name'] ?></span>
        <span class="audio_author"><?php echo $audio['author'] ?></span>
        <span class="audio_released_at"><?php echo $audio['released_at'] ?></span>
        <span class="audio_cover"><?php echo image_tag($audio['file_cover']) ?></span>
        <span class="audio_link"><?php echo link_to(__('play it', array(), 'td'), '@td_sample_track_album_show?id='.$audio['id']) ?></span>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
