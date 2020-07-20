<?php
class Driver extends CI_controller
{

    function driver_registration()
    {
        $this->load->model('Driver_Model');
        $paths = $this->Driver_Model->get_paths_names();
        $this->load->view('driver_registration', ['paths' => $paths]);
    }
}
