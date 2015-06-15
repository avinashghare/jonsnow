<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class interest_model extends CI_Model
{
    public function create($name)
    {
        $data=array("name" => $name);
        $query=$this->db->insert( "jonsnow_interest", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("jonsnow_interest")->row();
        return $query;
    }
    function getsingleinterest($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("jonsnow_interest")->row();
        return $query;
    }
    public function edit($id,$name)
    {
        $data=array("name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "jonsnow_interest", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `jonsnow_interest` WHERE `id`='$id'");
        return $query;
    }
    
    public function getinterestdropdown() {
        $query = $this->db->query("SELECT * FROM `jonsnow_interest`  ORDER BY `id` ASC")->result();
        $return = array();
        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }
        return $return;
    }
    public function getselectedinterest($id)
	{
         $return=array();
		$query=$this->db->query("SELECT `id`,`user`,`interest` FROM `userinterest`  WHERE `user`='$id'");
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
}
?>
