<?php use_helper('I18N') ?>

<h1>Album</h1>

<?php use_helper('Video', 'Date') ?>

<div id="flashPlayer">
  This text will be replaced by the flash music player.
</div>

<script type="text/javascript">
   var so = new SWFObject("/tdAudioPlugin/swf/playerMultipleList.swf", "mymovie", "295", "200", "7", "#FFFFFF");
   so.addVariable("autoPlay","no")
   so.addVariable("playlistPath","<?php echo url_for('@td_sample_track_album_show_xml?id=1') ?>")
   so.write("flashPlayer");
</script>
