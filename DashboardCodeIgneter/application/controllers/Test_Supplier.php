<?php
class Test_Supplier extends Supplier
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function index()
    {
        $this->unit->run($this->isPhoneExist(''),false,"Testing Supplier isPhoneExist function");
        $this->unit->run($this->isEditPhoneExist(''),false, "Testing Supplier isEditPhoneExist function");
        $this->load->view('tests');
    }
}
?>