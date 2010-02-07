<?php

/**
 * PlugintdTrack form.
 * *
 * @package    tdAudioPlugin
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class PlugintdTrackForm extends BasetdTrackForm
{

  public function setup()
  {
    parent::setup();
    $this->removeFields();
    $this->manageHidden();
    $this->manageDelete();
    $this->manageFiles();
    $this->manageLabels();
  }

  protected function removeFields()
  {
    unset($this['created_at'], $this['updated_at']);
  }

  protected function manageHidden()
  {
    $this->widgetSchema['td_track_album_id'] = new sfWidgetFormInputHidden();
  }

  protected function manageDelete()
  {
    if ($this->object->exists())
    {
      $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
      $this->validatorSchema['delete'] = new sfValidatorPass();
    }
  }

  protected function manageFiles()
  {
    $this->setWidget('file', new sfWidgetFormInputFileEditable(array(
      'with_delete' => false,
      'delete_label' => 'usuń plik',
      'file_src'  => '/uploads/td/audio/'.$this->getObject()->getFile(),
      'is_image'  => false,
      'edit_mode' => !$this->isNew(),
      'template'  => '%file%<br />%input%<br />%delete% %delete_label%',
    )));

    $this->setValidator('file', new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('td_audio_upload_dir'),
    ), array(
      'required' => 'Musisz wybrać plik',
    )));
  }

  protected function manageLabels()
  {
    $this->widgetSchema->setLabels(array(
      'file'        => 'Plik',
      'title'       => 'Tytuł',
      'description' => 'Opis',
      'position'    => 'Pozycja',
      'delete'      => 'Usuń',
    ));
  }
}
