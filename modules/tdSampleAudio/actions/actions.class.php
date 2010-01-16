<?php

/**
 * tdSampleAudio actions.
 *
 * @package    gospel
 * @subpackage tdSampleAudio
 * @author     Tomasz Ducin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdSampleAudioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->audios = Doctrine::getTable('tdTrackAlbum')->getActiveAlbumsQuery()->fetchArray();
  }

  public function executeShow(sfWebRequest $request)
  {
    $results = Doctrine::getTable('tdTrackAlbum')->getActiveAlbumByIdQuery($request->getParameter('file'))->fetchArray();
    $this->audio = $results[0];

    // adding js flash embedding script
    $this->getResponse()->addJavascript('/tdAudioPlugin/?');

    // adding default flowplayer stylesheet
    $this->getResponse()->addStylesheet('/tdAudioPlugin/?');
  }
}
