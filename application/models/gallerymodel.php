<?php
class gallerymodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GalleryListData($UserId, $Type='')
    {
        $this->db->select('Gallery.*,Village.Name as LocationName');
        $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
        $this->db->where('Gallery.Type','Village');
        $this->db->order_by('Gallery.DateCreated',DESC);
        $query = $this->db->get();
        
		$GallerData=array();
		foreach($query->result_array() as $tmpData)
		{
			$GallerData[]=	$tmpData;
		}
		
		$this->db->select('Gallery.*,School.Name as LocationName');
        $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
        $this->db->where('Gallery.Type','School');
        $this->db->order_by('Gallery.DateCreated',DESC);
        $query = $this->db->get();
        foreach($query->result_array() as $tmpData)
		{
			$GallerData[]=	$tmpData;
		}

		if($Type == 'Village'){
            $this->db->select('Gallery.*,Village.Name as LocationName');
            $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
            $this->db->where('Gallery.Type','Village');
            $this->db->order_by('Gallery.DateCreated',DESC);
            $query = $this->db->get();


            foreach($query->result_array() as $tmpData)
            {
                $GallerDataVillage[]=	$tmpData;
            }
            return $GallerDataVillage;
            die();
        }

        if($Type == 'School'){
            $this->db->select('Gallery.*,School.Name as LocationName');
            $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
            $this->db->where('Gallery.Type','School');
            $this->db->order_by('Gallery.DateCreated',DESC);
            $query = $this->db->get();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataSchool[]=	$tmpData;
            }
            return $GallerDataSchool;
            die();
        }

        if($Type == 'All'){
            $this->db->select('Gallery.*,Village.Name as LocationName');
            $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
            $this->db->where('Gallery.Type','Village');
            $this->db->order_by('Gallery.DateCreated',DESC);
            $query = $this->db->get();

            $GallerDataAll=array();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataAll[]=	$tmpData;
            }

            $this->db->select('Gallery.*,School.Name as LocationName');
            $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
            $this->db->where('Gallery.Type','School');
            $this->db->order_by('Gallery.DateCreated',DESC);
            $query = $this->db->get();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataAll[]=	$tmpData;
            }
            return $GallerDataAll;
            die();
        }

		
		
        return $GallerData;
    }

    public function GalleryListDashboardData($UserId, $Type='')
    {

            $this->db->select('Gallery.*,Village.Name as LocationName');
            $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
            $this->db->where('Gallery.Type','Village');
            $this->db->order_by('Gallery.Id', 'random');
            $this->db->limit(40);
            $query = $this->db->get();

            $GallerDataAll=array();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataAll[]=	$tmpData;
            }

            $this->db->select('Gallery.*,School.Name as LocationName');
            $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
            $this->db->where('Gallery.Type','School');
            $this->db->order_by('Gallery.Id', 'random');
            $this->db->limit(40);
            $query = $this->db->get();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataAll[]=	$tmpData;
            }
            return $GallerDataAll;
            die();

    }

    public function GalleryUpdateData($Id)
    {

        $this->db->select('Gallery.*,Village.Name as LocationName');
        $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
        $this->db->where('Gallery.Type','Village');
        $this->db->where('Gallery.Id',$Id);
        $query = $this->db->get();

        $GallerDataAll=array();
        foreach($query->result_array() as $tmpData)
        {
            $GallerDataAll[] =	$tmpData;
        }

        $this->db->select('Gallery.*,School.Name as LocationName');
        $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
        $this->db->where('Gallery.Type','School');
        $this->db->where('Gallery.Id',$Id);
        $query = $this->db->get();
        foreach($query->result_array() as $tmpData)
        {
            $GallerDataAll[] =	$tmpData;
        }
        return $GallerDataAll;
        die();

    }

    public function GalleryListTrainerData($UserId)
    {

        $this->db->select('Gallery.*,Village.Name as LocationName');
        $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
        $this->db->where('Gallery.Type','Village');
        $this->db->where('Gallery.UserId',$UserId);
        $query = $this->db->get();

        $GallerDataAll=array();
        foreach($query->result_array() as $tmpData)
        {
            $GallerDataAll[]=	$tmpData;
        }

        $this->db->select('Gallery.*,School.Name as LocationName');
        $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
        $this->db->where('Gallery.Type','School');
        $this->db->where('Gallery.UserId',$UserId);
        $query = $this->db->get();
        foreach($query->result_array() as $tmpData)
        {
            $GallerDataAll[]=	$tmpData;
        }
        return $GallerDataAll;
        die();

    }
	
	public function GalleryManagerListDashboardData($Parameters)
    {

            $this->db->select('Gallery.*,Village.Name as LocationName');
            $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
            $this->db->order_by('Gallery.Id', 'random');
            $this->db->limit(40);
            $this->db->where('Gallery.Type','Village');
            $query = $this->db->get();

            $GallerDataAll=array();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataAll[]=	$tmpData;
            }

            $this->db->select('Gallery.*,School.Name as LocationName');
            $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
            $this->db->where('Gallery.Type','School');
            $query = $this->db->get();
            foreach($query->result_array() as $tmpData)
            {
                $GallerDataAll[]=	$tmpData;
            }
            return $GallerDataAll;
            die();

    }

    public function GallerySingleData($Parameters)
    {

//        $this->db->select('Gallery.*,Village.Name as LocationName');
//        $this->db->from('Gallery')->join('Village', 'Gallery.ParentId = Village.Id');
//        $this->db->order_by('Gallery.Id', 'random');
//        $this->db->limit(1);
//        $this->db->where('Gallery.Type','Village');
//        $query = $this->db->get();
//
//        $GallerDataAll=array();
//        foreach($query->result_array() as $tmpData)
//        {
//            $GallerDataAll[]=	$tmpData;
//        }

        $this->db->select('Gallery.*,School.Name as LocationName');
        $this->db->from('Gallery')->join('School', 'Gallery.ParentId = School.Id');
        $this->db->where('Gallery.Type','School');
        $this->db->order_by('Gallery.Id', 'random');
        $this->db->limit(1);
        $query = $this->db->get();
        foreach($query->result_array() as $tmpData)
        {
            $GallerDataAll[]=	$tmpData;
        }
        return $GallerDataAll;
        die();

    }



    public function InsertImage($Data)
    {
        $this->db->Insert('Gallery',$Data);
        return $this->db->insert_id();
    }

    public function CreateNewGallery($SaveData)
    {
        $this->db->insert('Gallery',$SaveData);
        return $this->db->insert_id();
    }

    public function ImageDelete($Id)
    {
        $this->db->where('Id', $Id);
        $this->db->delete('Gallery');
    }

    public function UpdateGallery($Id,$Gallery)
    {
        $this->db->where('Id',$Id);
        $this->db->update('Gallery',$Gallery);
    }

}
?>