<?php use_helper('Audio', 'I18N', 'Date') ?>

<h1><?php echo __('Audio album list', array(), 'td') ?></h1>

<?php if ($audios): ?>
<ul id="audio">
  <?php foreach ($audios as $audio): ?>
    <li class="list">
      <div class="cover">
        <?php echo image_tag('/uploads/td/cover/'.$audio['file_cover']) ?>
      </div>
      <div class="rest">
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
          <span class="value"><?php echo (false !== strtotime($audio['released_at']) ? format_date($audio['released_at'], "f") : '&nbsp;') ?></span>
        </div>
        <div class="link">
          <span><?php echo link_to(__('play it', array(), 'td'), '@td_sample_track_album_show?id='.$audio['id']) ?></span>
        </div>
      </div>
      <div style="clear: both;"></div>
    </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
