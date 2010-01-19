<?php use_helper('I18N', 'Date') ?>

<h1><?php echo __('Audio album list', array(), 'td') ?></h1>

<?php if ($audios): ?>
<ul id="audio">
  <?php foreach ($audios as $audio): ?>
    <li>
      <div class="cover">
        <?php echo image_tag($audio['file_cover']) ?>
      </div>
      <div class="name">
        <span class="title"><?php echo __('Name', array(), 'td') ?>: </span>
        <span class="value"><?php echo $audio['name'] ?></span>
      </div>
      <div class="author">
        <span class="title"><?php echo __('Author', array(), 'td') ?>: </span>
        <span class="value"><?php echo $audio['author'] ?></span>
      </div>
      <div class="released_at">
        <span class="title"><?php echo __('Released at', array(), 'td') ?>: </span>
        <span class="value"><?php echo (false !== strtotime($video['released_at']) ? format_date($video['released_at'], "f") : '&nbsp;') ?></span>
      </div>
      <div class="link">
        <span><?php echo link_to(__('play it', array(), 'td'), '@td_sample_track_album_show?file='.$audio['id']) ?></span>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
