<?php
/**
 */
class PlugintdTrackAlbumTable extends Doctrine_Table
{
  /**
   * Returns DQL query retrieving all active track albms.
   *
   * @return Doctrine_Query
   */
  static public function getActiveAlbumsQuery()
  {
    return Doctrine_Query::create()
             ->from('tdTrackAlbum a')
             ->where('a.active = "1"');
  }

  /**
   * Returns DQL query retrieving active track album given by file.
   *
   * @param Integer $id - track album id
   * @return Doctrine_Query
   */
  static public function getActiveAlbumByIdQuery($id)
  {
    return Doctrine_Query::create()
             ->from('tdTrackAlbum a')
             ->where('a.id = ?', $file)
             ->andWhere('a.active = "1"');
  }
}