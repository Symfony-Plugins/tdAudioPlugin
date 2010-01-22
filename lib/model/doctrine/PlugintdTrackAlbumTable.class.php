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
             ->where('a.id = ?', $id)
             ->andWhere('a.active = "1"');
  }

  /**
   * Returns DQL query retrieving albums selected by ids.
   *
   * @param Array $ids - Identifiers of selected albums.
   * @return Doctrine_Query
   */
  static public function getSelectedAlbumsQuery($ids)
  {
    return Doctrine_Query::create()
      ->from('tdTrackAlbum a')
      ->whereIn('a.id', $ids);
  }

  /**
   * Returns ids of all active albums.
   *
   * @param Array $ids - Identifiers of active albums.
   * @return Array
   */
  static protected function getActiveAlbumsIds()
  {
    $query = self::getActiveAlbumsQuery()
      ->select('a.id');
    $data = $query->fetchArray();

    $ids = array();
    foreach($data as $d)
    {
      $ids[] = $d['id'];
    }
    return $ids;
  }

  /**
   * Returns DQL query retrieving random albums.
   *
   * @param Integer $count - Number of albums to be returned by the query.
   * @return Doctrine_Query
   */
  static public function getRandomActiveAlbumsQuery($count)
  {
    $ids = self::getActiveAlbumsIds();

    $selected = array();
    for ($i = 0; $i < $count; $i++)
    {
      $id = rand(0, count($ids));
      while (!isset($ids[$id]))
        $id = rand(0, count($ids));
      $selected[] = $ids[$id];
      unset($ids[$id]);
    }

    return self::getSelectedAlbumsQuery($selected);
  }
}