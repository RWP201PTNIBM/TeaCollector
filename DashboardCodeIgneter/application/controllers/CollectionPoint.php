<?php
class CollectionPoint extends CI_Controller
{
    function CollectionPoint_registration()
    {
        $this->load->model('CollectionPoint_Model');

        // $this->form_validation->set_rules('cp_name', 'Collection Point Name', 'required');
        // $this->form_validation->set_rules('latitude', 'Latitude', 'required|min_length[5]');
        // $this->form_validation->set_rules('longitude', 'Longitude', 'required|min_length[5]');
        // $this->form_validation->set_rules('path_id', 'Path Id', 'callback_checkDefault');

        $paths = $this->CollectionPoint_Model->get_paths_names();

        // if ($this->form_validation->run() == false) {
        //     $this->load->view('CollectionPoint_registration', ['paths' => $paths]);
        // } else {
        //     $CollectionPoint['cp_name'] = $this->input->post('cp_name');
        //     $CollectionPoint['latitude'] = $this->input->post('latitude');
        //     $CollectionPoint['longitude'] = $this->input->post('longitude');
        //     $CollectionPoint['path_id'] = (int)($this->input->post('path_id'));
        //     $this->CollectionPoint_Model->addCollectionPoint($CollectionPoint);

        //     $this->session->set_flashdata('success', 'Record inserted successfully');
        $this->load->view('CollectionPoint_registration', ['paths' => $paths]);
        //     // redirect(base_url() . 'welcome');
        // }
    }

    public function CollectionPoint_registration_validation()
    {
        $this->load->model('CollectionPoint_Model');

        $this->form_validation->set_rules('path_id', 'Path Id', 'callback_checkDefault');
        $this->form_validation->set_rules('cp_name', 'Collection Point Name', 'required|callback_isNameExist');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required|min_length[5]');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required|min_length[5]');

        if ($this->form_validation->run()) {
            $CollectionPoint['cp_name'] = $this->input->post('cp_name');
            $CollectionPoint['latitude'] = $this->input->post('latitude');
            $CollectionPoint['longitude'] = $this->input->post('longitude');
            $CollectionPoint['path_id'] = (int)($this->input->post('path_id'));
            $this->CollectionPoint_Model->addCollectionPoint($CollectionPoint);

            $array = array(
                'success' => '<div class="alert alert-success">New Officer Added Successfully....Please Wait...</div>'
            );
        } else {

            $array = array(
                'error' => true,
                'path_id_error' => form_error('path_id'),
                'cp_name_error' => form_error('cp_name'),
                'latlng_error' => form_error('latitude'),
                'latlng_error' => form_error('longitude')
            );
        }
        echo json_encode($array);
    }

    public function isNameExist($cp_name)
    {
        $this->load->model('CollectionPoint_Model');
        $is_exist = $this->CollectionPoint_Model->isNameExist($cp_name);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isNameExist',
                'Collection Point Name already exists.'
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

    function editCollectionPoint($cpId)
    {
        $this->load->model('CollectionPoint_Model');
        $cp = $this->CollectionPoint_Model->getColletionPoint($cpId);
        $paths = $this->CollectionPoint_Model->get_paths_except_default($cpId);
        $defaultPath = $this->CollectionPoint_Model->get_default_path($cpId);
        $data = array();
        $data['cp'] = $cp;
        $data['paths'] = $paths;
        $data['dpaths'] = $defaultPath;

        // $paths = $this->CollectionPoint_Model->get_paths_names();

        // if ($this->form_validation->run() == false) {
        //     $this->load->view('edit_collectionPoint', $data);
        // } else {
        //     $CollectionPoint['cp_name'] = $this->input->post('cp_name');
        //     $CollectionPoint['latitude'] = $this->input->post('latitude');
        //     $CollectionPoint['longitude'] = $this->input->post('longitude');
        //     $CollectionPoint['path_id'] = (int)($this->input->post('path_id'));
        //     $this->CollectionPoint_Model->addCollectionPoint($CollectionPoint);

        //     $this->session->set_flashdata('success', 'Record edited successfully');
        $this->load->view('edit_collectionPoint', $data);
        //     // redirect(base_url() . 'welcome');
        // }
    }

    function CollectionPoint_edit_validation($cpId)
    {
        $this->load->model('CollectionPoint_Model');

        $this->form_validation->set_rules('cp_name', 'Collection Point Name', 'required|callback_isEditCPNameExist');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required|min_length[5]');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required|min_length[5]');
        $this->form_validation->set_rules('path_id', 'Path Id', 'required');

        if ($this->form_validation->run()) {
            $CollectionPoint['cp_name'] = $this->input->post('cp_name');
            $CollectionPoint['latitude'] = $this->input->post('latitude');
            $CollectionPoint['longitude'] = $this->input->post('longitude');
            $CollectionPoint['path_id'] = $this->input->post('path_id');
         $this->CollectionPoint_Model->updateCollectionPoint($cpId, $CollectionPoint);
            $array = array('success' => true);
        } else {

            $array = array(
                'error' => true,
                'path_id_error' => form_error('path_id'),
                'cp_name_error' => form_error('cp_name'),
                'latlng_error' => form_error('latitude')
            );
        }
        echo json_encode($array);
    }

    function viewCollectionPoint($cpId)
    {
        $this->load->model('CollectionPoint_Model');
        $cp = $this->CollectionPoint_Model->getColletionPoint($cpId);
        $defaultPath = $this->CollectionPoint_Model->get_default_path($cpId);
        $data = array();
        $data['cp'] = $cp;
        $data['dpaths'] = $defaultPath;

        $marker = array();
        $marker['position'] = strval($cp['latitude']) . ',' . strval($cp['longitude']);
        $this->googlemaps->add_marker($marker);

        $this->load->library('googlemaps');
        $config['center'] = $marker['position'];
        $config['zoom'] = '8';
        $this->googlemaps->initialize($config);

        $data['map'] = $this->googlemaps->create_map();

        $this->load->view('view_collectionPoint', $data);
    }

    function deleteCollectionPoint($cpId)
    {
        $this->load->model('CollectionPoint_Model');
        $this->CollectionPoint_Model->deleteCollectionPoint($cpId);
        redirect(base_url() . 'CollectionPoint/CollectionPoint_ViewAll');
    }

    function checkDefault()
    {
        $this->input->post('path_id');
        if ($this->input->post('path_id') == 0) {
            $this->form_validation->set_message(
                'checkDefault',
                'Please select the path'
            );
            return  false;
        } else {
            return true;
        }
    }

    public function isEditCPNameExist($cp_name)
    {
        $cpId = $this->input->post('cp_id');
        $this->load->model('CollectionPoint_Model');
        $is_exist = $this->CollectionPoint_Model->isEditCPNameExist($cpId, $cp_name);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isEditCPNameExist',
                'Collection Point already exists.'
            );
            return false;
        } else {
            return true;
        }
    }
}
