<?php

/**
 * PlugintdTrackAlbum form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PlugintdTrackAlbumForm extends BasetdTrackAlbumForm
{
  public function setup()
  {
    parent::setup();

    $this->removeFields();

    $this->manageWidgets();

    $this->manageValidators();

//    $this->setValidator('author',
//      new sfValidatorString(array(), array('required' => 'Musisz podać autora wpisu.')));
//
//    $this->setValidator('text',
//      new sfValidatorString(array(), array('required' => 'Musisz podać treść wpisu.')));
//
//    $this->setValidator('email',
//      new sfValidatorEmail(array('required' => false), array('invalid' => 'Musisz podać poprawny adres E-mail')));
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
      'label'     => 'album cover',
      'file_src'  => '/uploads/images/'.$this->getObject()->getFileCover(),
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
      'required'   => true,
      'path'       => sfConfig::get('td_visual_factory_image_dir'),
      'mime_types' => 'web_images',
    ), array(
      'required' => 'Musisz wybrać plik',
    )));
  }
}
