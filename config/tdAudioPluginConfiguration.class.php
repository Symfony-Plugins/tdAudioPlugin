<?php
/**
 * tdAudioPluginConfiguration.class
 */

/**
 * tdAudioPluginConfiguration
 *
 * @package   tdAudioPlugin
 * @author    Tomasz Ducin <tomasz.ducin@gmail.com>
 */

class tdAudioPluginConfiguration extends sfPluginConfiguration
{
  /**
   * Initialize
   */
  public function initialize()
  {
    // audio files upload dir
    sfConfig::set('td_audio_upload_dir', sfConfig::get('sf_web_dir').'/uploads/td/audio');

    // track album short description sign count
    sfConfig::set('td_audio_short_text_sign_count', 200);
  }
}