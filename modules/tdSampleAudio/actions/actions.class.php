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
    $results = Doctrine::getTable('tdTrackAlbum')->getActiveAlbumByIdQuery($request->getParameter('id'))->fetchArray();
    $this->audio = $results[0];

    // adding js flash embedding script
    $this->getResponse()->addJavascript('/tdAudioPlugin/js/swfobject.js');

    // adding default flowplayer stylesheet
    $this->getResponse()->addStylesheet('/tdAudioPlugin/?');
  }

  /**
   * Generates XML file for a track album to be passed to the premiumbeat player.
   * 
   */
  public function executeAlbumXMLInfo(sfWebRequest $request)
  {
    $tracks = Doctrine::getTable('tdTrack')->getAllAlbumTracksByIdSortedQuery($request->getParameter('id'))->fetchArray();

    $this->getResponse()->setContentType('text/xml');
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
    $xml .= "<xml>\n";
    foreach ($tracks as $track)
    {
        $xml .= "    <track>\n";
        $xml .= "       <path>/tdAudioPlugin/mp3/{$track['file']}</path>\n";
        $xml .= "       <title>Track {$track['position']} - {$track['title']}</title>\n";
        $xml .= "   </track>\n";
    }
    $xml .= "</xml>\n";
    return $this->renderText($xml);
  }
}
