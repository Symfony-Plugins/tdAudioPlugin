<?php

/**
 * PlugintdTrackAlbum form.
 *
 * @package    tdAudioPlugin
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class PlugintdTrackAlbumForm extends BasetdTrackAlbumForm
{
  public function setup()
  {
    parent::setup();
    $this->removeFields();
    $this->manageWidgets();
    $this->manageValidators();
    $this->embedRelation('Tracks');

    $new_track_form = new tdTrackForm();
    $new_track_form->setDefault('td_track_album_id', $this->object->id);
    $this->embedForm('new', $new_track_form);
  }

  protected function removeFields()
  {
    unset($this['created_at'], $this['updated_at']);
  }

  protected function manageWidgets()
  {
    $this->setWidget('file_cover', new sfWidgetFormInputFileEditable(array(
      'with_delete' => false,
      'delete_label' => 'usuń okładkę albumu',
      'file_src'  => '/uploads/td/cover/'.$this->getObject()->getFileCover(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '%file%<br />%input%<br />%delete% %delete_label%',
    )));
  }

  protected function manageValidators()
  {
    $this->setValidator('name',
      new sfValidatorString(array(), array('required' => 'Musisz podać nazwę albumu.')));

    $this->setValidator('author',
      new sfValidatorString(array(), array('required' => 'Musisz podać autora.')));

    $this->setValidator('file_cover', new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('td_audio_cover_upload_dir'),
      'mime_types' => 'web_images',
    ), array(
      'required' => 'Musisz wybrać plik',
    )));

//    $this->setValidator('text',
//      new sfValidatorString(array(), array('required' => 'Musisz podać treść wpisu.')));
//
//    $this->setValidator('email',
//      new sfValidatorEmail(array('required' => false), array('invalid' => 'Musisz podać poprawny adres E-mail')));
  }

  protected function doBind(array $values)
  {
    if ($this->isValid()
            && '' === trim($values['new']['file']['name'])
            && '' === trim($values['new']['title'])
            && '' === trim($values['new']['description'])
            && '' === trim($values['new']['position']))
    {
      unset($values['new'], $this['new']);
    }

    if (isset($values['Tracks']))
    {
      foreach ($values['Tracks'] as $i => $trackValues)
      {
        if (isset($trackValues['delete']) && $trackValues['id'])
        {
          $this->scheduledForDeletion[$i] = $trackValues['id'];
        }
      }
    }

    parent::doBind($values);
  }

  /**
   * Updates object with provided values, dealing with evantual relation deletion
   *
   * @see sfFormDoctrine::doUpdateObject()
   */
  protected function doUpdateObject($values)
  {
    if (isset($this->scheduledForDeletion))
    {
      foreach ($this->scheduledForDeletion as $index => $id)
      {
        unset($values['Tracks'][$index]);
        unset($this->object['Tracks'][$index]);
        $track = Doctrine::getTable('tdTrack')->findOneById($id);
        unlink(sfConfig::get('td_audio_upload_dir').'/'.$track->getFile());
        $track->delete();
      }
    }

    $this->getObject()->fromArray($values);
  }


  /**
   * Saves embedded form objects.
   *
   * @param mixed $con   An optional connection object
   * @param array $forms An array of forms
   */
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $con)
    {
      $con = $this->getConnection();
    }

    if (null === $forms)
    {
      $forms = $this->embeddedForms;
    }

    foreach ($forms as $form)
    {
      if ($form instanceof sfFormObject)
      {
        if (!isset($this->scheduledForDeletion) || !in_array($form->getObject()->getId(), $this->scheduledForDeletion))
        {
          $form->saveEmbeddedForms($con);
          $form->getObject()->save($con);
        }
      }
      else
      {
        $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
      }
    }
  }
}
