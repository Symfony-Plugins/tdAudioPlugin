<?php

/**
 * Audio helper.
 *
 * @package    tdAudioPlugin
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 */

/**
 * Returns the path to a audio asset.
 *
 * @param string $source   asset name
 * @param bool   $absolute return absolute path ?
 *
 * @return string file path to the audio file
 */
function audio_path($source, $absolute = false)
{
  return _compute_public_path($source, sfConfig::get('sf_web_audio_dir_name', 'tdAudioPlugin'), 'mp3', $absolute);
}

?>