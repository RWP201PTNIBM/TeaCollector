<?php
class CollectionPoint extends CI_Controller
{
    function CollectionPoint_registration()
    {
        $this->load->model('CollectionPoint_Model');

        $this->form_validation->set_rules('cp_name', 'Collection Point Name', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required|min_length[5]');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required|min_length[5]');
        $this->form_validation->set_rules('path_id', 'Path Id', 'required');
        
        $paths = $this->CollectionPoint_Model->get_paths_names();

        if ($this->form_validation->run() == false) {
            $this->load->view('CollectionPoint_registration', ['paths' => $paths]);
        } else {
            $CollectionPoint['cp_name'] = $this->input->post('cp_name');
            $CollectionPoint['latitude'] = $this->input->post('latitude');
            $CollectionPoint['longitude'] = $this->input->post('longitude');

            $CollectionPoint['path_id'] = (int)($this->input->post('path_id'));
            $res = $this->CollectionPoint_Model->addCollectionPoint($CollectionPoint);

            $this->session->set_flashdata('success', 'Record inserted successfully');
            $this->load->view('CollectionPoint_registration', ['paths' => $paths]);
            // redirect(base_url() . 'welcome');
        }
    }


    public function isNameExist($cp_name)
    {
        $this->load->model('CollectionPoint_Model');
        $is_exist = $this->CollectionPoint_Model->isNameExist($cp_name);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isNameExist',
                'Collection Point Name is already exist.'
            );
            return false;
        } else {
            return true;
        }
    }

    function CollectionPoint_ViewAll()
    {
        $this->load->model('CollectionPoint_Model');
        $cps = $this->CollectionPoint_Model->all();
        $data['cps'] = $cps;
        $this->load->view('CollectionPoint_Search', $data);
    }

    function editCollectionPoint()
    {

    }

    function deleteCollectionPoint()
    {
        
    }
}
