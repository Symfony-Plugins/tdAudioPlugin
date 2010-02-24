<?php

require_once dirname(__FILE__).'/../lib/td_track_albumGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/td_track_albumGeneratorHelper.class.php';

/**
 * td_track_album actions.
 *
 * @package    tdAudioPlugin
 * @subpackage backend
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class td_track_albumActions extends autoTd_track_albumActions
{

  public function executeEdit(sfWebRequest $request)
  {
    parent::executeEdit($request);

    // adding js flash embedding script
    $this->getResponse()->addJavascript('/tdAudioPlugin/js/swfobject.js');
    // ading default td_video layout
    $this->getResponse()->addStylesheet('/tdAudioPlugin/css/td_audio.css');
  }

  /**
   * Activates selected track albums.
   *
   * @param sfWebRequest $request
   */
  public function executeBatchActivate(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $query = Doctrine::getTable('tdTrackAlbum')->getSelectedAlbumsQuery($ids);

    foreach ($query->execute() as $audio)
    {
      $audio->activate(true);
    }

    $this->getUser()->setFlash('notice', 'The selected track albums have been activated successfully.');
    $this->redirect('@td_track_album');
  }

  /**
   * Deactivates selected track albums.
   *
   * @param sfWebRequest $request
   */
  public function executeBatchDeactivate(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $query = Doctrine::getTable('tdTrackAlbum')->getSelectedAlbumsQuery($ids);

    foreach ($query->execute() as $audio)
    {
      $audio->deactivate(true);
    }

    $this->getUser()->setFlash('notice', 'The selected track albums have been deactivated successfully.');
    $this->redirect('@td_track_album');
  }

  /**
   * Activates selected track album.
   *
   * @param sfWebRequest $request
   */
  public function executeListActivate(sfWebRequest $request)
  {
    $audio = $this->getRoute()->getObject();
    $audio->activate();

    $this->getUser()->setFlash('notice', 'The selected track album has been activated successfully.');
    $this->redirect('@td_track_album');
  }

  /**
   * Deactivates selected track album.
   *
   * @param sfWebRequest $request
   */
  public function executeListDeactivate(sfWebRequest $request)
  {
    $audio = $this->getRoute()->getObject();
    $audio->deactivate();

    $this->getUser()->setFlash('notice', 'The selected track album has been deactivated successfully.');

    $this->redirect('@td_track_album');
  }
}
