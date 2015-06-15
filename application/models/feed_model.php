<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class feed_model extends CI_Model
{
    public function create($title,$description,$interest)
    {
        $data=array("title" => $title,"description" => $description);
        $query=$this->db->insert( "jonsnow_feed", $data );
        $id=$this->db->insert_id();
        foreach($interest AS $key=>$value)
        {
            $this->feed_model->createinterestbyfeed($value,$id);
        }
        if(!$query)
        return  0;
        else
        return  $id;
    }
     public function createinterestbyfeed($value,$feed)
	{
		$data  = array(
			'interest' => $value,
			'feed' => $feed
		);
		$query=$this->db->insert( 'feedinterest', $data );
		return  1;
	}
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("jonsnow_feed")->row();
        return $query;
    }
    function getsinglefeed($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("jonsnow_feed")->row();
        return $query;
    }
    public function edit($id,$title,$description,$interest)
    {
        $data=array("title" => $title,"description" => $description);
        $this->db->where( "id", $id );
        $query=$this->db->update( "jonsnow_feed", $data );
        
        $querydelete=$this->db->query("DELETE FROM `feedinterest` WHERE `feed`='$id'");
        foreach($interest AS $key=>$value)
        {
            $this->feed_model->createinterestbyfeed($value,$id);
        }
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `jonsnow_feed` WHERE `id`='$id'");
        return $query;
    }
    
    public function getselectedinterest($id)
	{
         $return=array();
		$query=$this->db->query("SELECT `id`,`feed`,`interest` FROM `feedinterest`  WHERE `feed`='$id'");
        if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->interest;
            }
        }
         return $return;	
	}
    public function getfeedbyuser($userid,$timestamp)
	{
        
        $query=$this->db->query("SELECT `jonsnow_feed`.`id`,`jonsnow_feed`.`title`,`jonsnow_feed`.`timestamp`,`jonsnow_feed`.`description` FROM `jonsnow_feed`,`feedinterest` WHERE `jonsnow_feed`.`timestamp`>'$timestamp' AND `feedinterest`.`interest` IN (SELECT `interest` FROM `userinterest` WHERE `user`='$userid') GROUP BY `jonsnow_feed`.`id` ORDER BY `timestamp` DESC")->result();
     
         return $query;	
	}
}
?>
