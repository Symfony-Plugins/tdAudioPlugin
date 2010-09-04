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
   * Activates an album from admin generator list using AJAX.
   *
   * @param sfWebRequest $request
   * @return Partial - generated partial enabling album deactivating (switch).
   */
  public function executeActivate(sfWebRequest $request)
  {
    $album = Doctrine::getTable('tdTrackAlbum')->findOneById($request->getParameter('id'));
    $album->activate();
    return $this->renderPartial('td_track_album/ajax_deactivate', array('td_track_album' => $album));
  }

  /**
   * Deactivates an album from admin generator list using AJAX.
   *
   * @param sfWebRequest $request
   * @return Partial - generated partial enabling album activating (switch).
   */
  public function executeDeactivate(sfWebRequest $request)
  {
    $album = Doctrine::getTable('tdTrackAlbum')->findOneById($request->getParameter('id'));
    $album->deactivate();
    return $this->renderPartial('td_track_album/ajax_activate', array('td_track_album' => $album));
  }
}
