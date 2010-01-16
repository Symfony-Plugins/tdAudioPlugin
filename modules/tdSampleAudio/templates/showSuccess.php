<?php use_helper('I18N') ?>

<h1>Album</h1>

<?php use_helper('Video', 'Date') ?>

    <h1><?php echo $video['name'] ?></h1>
    <p><?php echo __('Author', array(), 'td').': '.$video['author'] ?></p>
    <p><?php echo __('Recorded at', array(), 'td').': '.(false !== strtotime($video['recorded_at']) ? format_date($video['recorded_at'], "f") : '&nbsp;') ?></p>
    <p><?php echo __('Description', array(), 'td').': '.$video['description'] ?></p>

