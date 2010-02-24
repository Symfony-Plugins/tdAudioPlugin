<?php use_helper('Audio') ?>

  <div id="flashPlayer" style="float: left;">
    <script type="text/javascript">
      var so = new SWFObject(
        "<?php echo audio_path('swf/playerMultipleList.swf') ?>",
        "mymovie",
        "<?php echo sfConfig::get('app_audio_player_width') ?>",
        "<?php echo sfConfig::get('app_audio_player_height') ?>",
        "3",
        "#FFFFFF");
      so.addVariable("autoPlay", "no")
      so.addVariable("playlistPath", "<?php echo url_for('@td_sample_track_album_show_xml?id='.$form->getObject()->getId()) ?>")
      so.write("flashPlayer");
    </script>
  </div>

  <div style="clear: both;"></div>