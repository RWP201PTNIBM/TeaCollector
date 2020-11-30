<?php
class CollectionLog extends MY_Controller
{
    public function viewCollectionLog()
    {
       
          $this->load->model('CollectionLog_Model');
          $logs=$this->CollectionLog_Model->getCollectionLog();
          $data=array();
          $data['logs']=$logs;
          $this->load->view('collection_log',$data);
      
        
      
    }

}