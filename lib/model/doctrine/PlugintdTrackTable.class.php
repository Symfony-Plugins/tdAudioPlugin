<?php
/**
 */
class PlugintdTrackTable extends Doctrine_Table
{
  static public function getAllAlbumTracksByIdSortedQuery($id)
  {
        return Doctrine_Query::create()
             ->from('tdTrack t')
             ->where('t.td_track_album_id = ?', $id)
             ->orderBy('t.position');
  }
}