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
            $this->CollectionPoint_Model->addCollectionPoint($CollectionPoint);

            $this->session->set_flashdata('success', 'Record inserted successfully');
            $this->load->view('CollectionPoint_registration', ['paths' => $paths]);
            // redirect(base_url() . 'welcome');
        }
    }

    public function CollectionPoint_registration_validation()
    {
        $this->load->model('CollectionPoint_Model');

        $this->form_validation->set_rules('cp_name', 'Collection Point Name', 'required|callback_isNameExist');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required|min_length[5]');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required|min_length[5]');
        $this->form_validation->set_rules('path_id', 'Path Id', 'required');

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
                'cp_name_error' => form_error('cp_name')
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
        $this->load->view('edit_collectionPoint', $data);
    }

    function viewCollectionPoint($cpId)
    {
        $this->load->model('CollectionPoint_Model');
        $cp = $this->CollectionPoint_Model->getColletionPoint($cpId);
        $paths = $this->CollectionPoint_Model->get_paths_except_default($cpId);
        $defaultPath = $this->CollectionPoint_Model->get_default_path($cpId);
        $data = array();
        $data['cp'] = $cp;
        $data['paths'] = $paths;
        $data['dpaths'] = $defaultPath;

        $marker = array();
        $marker['position'] = strval($cp['latitude']) . ',' . strval($cp['longitude']);
        $this->googlemaps->add_marker($marker);

        $this->load->library('googlemaps');
        $config['center'] = '37.4419, -122.1419';
        $config['zoom'] = 'auto';
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
}
