<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Path extends CI_Controller
{
    function Path_ViewAll()
    {
        $this->load->model('Path_Model');
        $paths = $this->Path_Model->all();
        $data['paths'] = $paths;
        $this->load->view('manage_paths', $data);
    }

    public function Path_registration_validation()
    {
        $this->load->model('Path_Model');

        $this->form_validation->set_rules('path_name', 'Path Name', 'required|callback_isNameExist');

        if ($this->form_validation->run()) {
            $Path['path_name'] = $this->input->post('path_name');
            $this->Path_Model->addPath($Path);

            $array = array(
                'success' => '<div class="alert alert-success">New Path Added Successfully....Please Wait...</div>'
            );
        } else {

            $array = array(
                'error' => true,
                'path_name_error' => form_error('path_name'),
            );
        }
        echo json_encode($array);
    }

    function deletePath($pathId)
    {
        $this->load->model('Path_Model');
        $this->Path_Model->deletePath($pathId);
        redirect(base_url() . 'Path/Path_ViewAll');
    }

    public function isNameExist($path_name)
    {
        $this->load->model('Path_Model');
        $is_exist = $this->Path_Model->isNameExist($path_name);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isNameExist',
                'Path name already exists.'
            );
            return false;
        } else {
            return true;
        }
    }

    function editPath($pathId)
    {
        $this->load->model('Path_Model');
        $path = $this->Path_Model->getPath($pathId);
        $data = array();
        $data['path'] = $path;

        $this->load->view('edit_path', $data);
    }

    function Path_edit_validation($pathId)
    {
        $this->load->model('Path_Model');

        $this->form_validation->set_rules('path_name', 'Path Name', 'required|callback_isEditNameExist');

        if ($this->form_validation->run()) {
            $Path['path_name'] = $this->input->post('path_name');
            $this->Path_Model->updatePath($pathId, $Path);
            $array = array('success' => true);
        } else {

            $array = array(
                'error' => true,
                'path_name_error' => form_error('path_name')
            );
        }
        echo json_encode($array);
    }

    function viewPath($pathId)
    {
        $this->load->model('CollectionPoint_Model');
        $cps = $this->CollectionPoint_Model->get_cps_for_path($pathId);
        $this->load->model('Path_Model');
        $path = $this->Path_Model->getPath($pathId);
        $drivers = $this->Path_Model->get_drivers_for_path($pathId);
        $data = array();
        $data['path'] = $path;
        $data['cps'] = $cps;
        $data['drivers'] = $drivers;

        foreach ($cps as $cp) {
            $marker = array();
            $marker['position'] = strval($cp['latitude']) . ',' . strval($cp['longitude']);
            $marker['onclick'] = '
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                position:  event.latLng
            });
            infoWindow.setContent("'.$cp['cp_name'].'");
            infoWindow.open(map);
            ';
            $this->googlemaps->add_marker($marker);
        }

        $this->load->library('googlemaps');
        $config['center'] = $marker['position'];
        $config['zoom'] = '8';
        $this->googlemaps->initialize($config);

        $data['map'] = $this->googlemaps->create_map();

        $this->load->view('view_path', $data);
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

    public function isEditNameExist($path_name)
    {
        $pathId = $this->input->post('path_id');
        $this->load->model('Path_Model');
        $is_exist = $this->Path_Model->isEditNameExist($pathId, $path_name);

        if ($is_exist) {
            $this->form_validation->set_message(
                'isEditNameExist',
                'Path name already exists.'
            );
            return false;
        } else {
            return true;
        }
    }
}
