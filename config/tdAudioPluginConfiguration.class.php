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
    // track album short description sign count
    sfConfig::set('td_audio_short_text_sign_count', 200);
  }
}