<?php 
class Supplier {
    
    private $sup_id;
    private $sup_Name;
    private $sup_Add;

    public function __construct($id, $name, $addr)
    {
        $this->sup_id = $id;
        $this->sup_Name = $name;
        $this->sup_Add = $addr;
    }

    public function getSup_id() {
        return $this->sup_id;
    }

    public function setSup_id($id) {
        $this->sup_id = $id;
    }

    public function getSup_Name() {
        return $this->sup_Name;
    }

    public function setSup_Name($name) {
        $this->sup_Name = $name;
    }

    public function getSup_Add() {
        return $this->sup_Add;
    }

    public function setSup_Add($addr) {
        $this->sup_Add = $addr;
    }
}

class Path {
    private $path_id;
    private $path_name;

    public function __construct($id, $name)
    {
        $this->path_id = $id;
        $this->path_name = $name;
    }

    public function getPath_id() {
        return $this->path_id;
    }

    public function setPath_id($id) {
        $this->path_id = $id;
    }

    public function getName() {
        return $this->path_name;
    }

    public function setName($name) {
        $this->path_name = $name;
    }
}

class CollectionPoint {
    private $cp_id;
    private $cp_name;
    private $cp_lng;
    private $cp_lat;

    public function __construct($id, $name, $lng, $lat)
    {
        $this->cp_id = $id;
        $this->cp_name = $name;
        $this->cp_lng = $lng;
        $this->cp_lat = $lat;
    }

    public function getCp_id() {
        return $this->cp_id;
    }

    public function setCp_id($id) {
        $this->cp_id = $id;
    }

    public function getCp_name() {
        return $this->cp_name;
    }

    public function setCp_name($name) {
        $this->cp_name = $name;
    }

    public function getLng() {
        return $this->cp_lng;
    }

    public function setLng($lng) {
        $this->cp_lng = $lng;
    }

    public function getLat() {
        return $this->cp_lat;
    }

    public function setLat($lat) {
        $this->cp_lat = $lat;
    }
}

class Driver {
    private $driver_id;
    private $driver_name;
    private $path_id;

    
    public function __construct($id, $name, $p_id)
    {
        $this->driver_id = $id;
        $this->driver_name = $name;
        $this->path_id = $p_id;
    }


    public function getName() {
        return $this->driver_name;
    }

    public function setName($name) {
        $this->driver_name = $name;
    }

    public function getDriver_id() {
        return $this->driver_id;
    }

    public function setDriver_id($id) {
        $this->driver_id = $id;
    }

    public function getPath_id() {
        return $this->path_id;
    }

    public function setPath_id($pid) {
        $this->path_id = $pid;
    }

}

class TestingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function index()
    {
        
        $name = "Saman";
        $name2 = "Kumara";
        $sup_id = 5623;
        $sup_id2 = 776;
        $addr = "No.32, Temple Rd, Rajagiriya";
        $addr2 = "No.51, Araliya Rd, Anuradhapura";
        $sup1 = new Supplier($sup_id, $name, $addr);

        $this->unit->run($sup1->getSup_id(), $sup_id, "Testing Supplier getSup_id");
        $sup1->setSup_id($sup_id2);
        $this->unit->run($sup1->getSup_id(), $sup_id2, "Testing Supplier setSup_id");

        $this->unit->run($sup1->getSup_Name(), $name, "Testing Supplier getSup_Name");
        $sup1->setSup_Name($name2);
        $this->unit->run($sup1->getSup_Name(), $name2, "Testing Supplier setSup_Name");

        $this->unit->run($sup1->getSup_Add(), $addr, "Testing Supplier getSup_Add");
        $sup1->setSup_Add($addr2);
        $this->unit->run($sup1->getSup_Add(), $addr2, "Testing Supplier setSup_Add");

        
        $path_id = 34;
        $path_id2 = 78;
        $path_name = "Main road";
        $path_name2 = "Temple road";
        $path1 = new Path($path_id, $path_name);

        $this->unit->run($path1->getPath_id(), $path_id, "Testing Path getPath_id");
        $path1->setPath_id($path_id2);
        $this->unit->run($path1->getPath_id(), $path_id2, "Testing Path setPath_id");

        $this->unit->run($path1->getName(), $path_name, "Testing Path getName");
        $path1->setName($path_name2);
        $this->unit->run($path1->getName(), $path_name2, "Testing Path setName");

        
        $cp_id = 4567;
        $cp_id2 = 3454;
        $cp_name = "Walawwa Junction";
        $cp_name2 = "Temple Junction";
        $lng = 45.7856789;
        $lng2 = 56.5644;
        $lat = 32.4567899;
        $lat2 = 46.567433;
        $cp1 = new CollectionPoint($cp_id, $cp_name, $lng, $lat);

        $this->unit->run($cp1->getCp_id(), $cp_id, "Testing CollectionPoint getCp_id");
        $cp1->setCp_id($cp_id2);
        $this->unit->run($cp1->getCp_id(), $cp_id2, "Testing CollectionPoint setCp_id");

        $this->unit->run($cp1->getCp_name(), $cp_name, "Testing CollectionPoint getCp_name");
        $cp1->setCp_name($cp_name2);
        $this->unit->run($cp1->getCp_name(), $cp_name2, "Testing CollectionPoint setCp_name");
        
        $this->unit->run($cp1->getLng(), $lng, "Testing CollectionPoint getLng");
        $cp1->setLng($lng2);
        $this->unit->run($cp1->getLng(), $lng2, "Testing CollectionPoint setLng");

        $this->unit->run($cp1->getLat(), $lat, "Testing CollectionPoint getLat");
        $cp1->setLat($lat2);
        $this->unit->run($cp1->getLat(), $lat2, "Testing CollectionPoint setLat");


        $driver_id = 5623;
        $driver_id2 = 4573;
        $driver_name = "Saman";
        $driver_name2 = "Kamal";
        $d1 = new Driver($driver_id, $driver_name, $path_id);

        $this->unit->run($d1->getName(), $driver_name, "Testing Driver getName");
        $d1->setName($driver_name2);
        $this->unit->run($d1->getName(), $driver_name2, "Testing Driver setName");

        $this->unit->run($d1->getDriver_id(), $driver_id, "Testing Driver getDriver_id");
        $d1->setDriver_id($driver_id2);
        $this->unit->run($d1->getDriver_id(), $driver_id2, "Testing Driver setDriver_id");

        $this->unit->run($d1->getPath_id(), $path_id, "Testing Driver getPath_id");
        $d1->setPath_id($path_id2);
        $this->unit->run($d1->getPath_id(), $path_id2, "Testing Driver setPath_id");

        $this->load->view('tests');
    }
}
?>