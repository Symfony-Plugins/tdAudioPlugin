<?php use_helper('Audio', 'I18N', 'Date') ?>

<h1><?php echo $audio['author'] ?> - <?php echo $audio['name'] ?></h1>

<ul id="audio">
  <li class="single">
      <div class="cover">
        <?php echo image_tag('/uploads/td/cover/'.$audio['file_cover']) ?>
      </div>
      <div class="rest">
        <div class="released_at">
          <span class="title"><?php echo __('Released at', array(), 'td') ?>: </span>
          <span class="value"><?php echo (false !== strtotime($audio['released_at']) ? format_date($audio['released_at'], "f") : '&nbsp;') ?></span>
        </div>
        <div class="place">
          <span class="title"><?php echo __('Place', array(), 'td') ?>: </span>
          <span class="value"><?php echo $audio['place'] ?></span>
        </div>
        <div class="description">
          <span class="title"><?php echo __('Description', array(), 'td') ?>: </span>
          <span class="value"><?php echo $audio['description'] ?></span>
        </div>
      </div>
      <div id="flashPlayer">
        <script type="text/javascript">
          var so = new SWFObject(
            "<?php echo audio_path('swf/playerMultipleList.swf') ?>",
            "mymovie",
            "<?php echo sfConfig::get('app_audio_player_width') ?>",
            "<?php echo sfConfig::get('app_audio_player_height') ?>",
            "3",
            "#FFFFFF");
          so.addVariable("autoPlay", "no")
          so.addVariable("playlistPath", "<?php echo url_for('@td_sample_track_album_show_xml?id='.$audio['id']) ?>")
          so.write("flashPlayer");
        </script>
      </div>

      <div style="clear: both;"></div>
  </li>
</ul>
