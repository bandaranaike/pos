<?php

/**
 * Description of cheques
 *
 * @author Eranda
 */
require_once 'secure_area.php';

class cheques extends Secure_area {

    public function __construct($module_id = null) {
        parent::__construct($module_id);
        $this->load->model("chequesM");
    }

    public function index() {
       $data["all_cheque_records"] = $this->chequesM->get_all_cheque_records();
        $this->load->view("cheques/cheque_list", $data);
    }
    public function add_new($chek_id){
        $data['cheque'] = $this->chequesM->get_cheque_by_id($chek_id);
        $this->load->view("cheques/add_new_cheque", $data);
    }
    public function save_cheque(){
        $this->load->view("cheques/add_new_cheque");
    }
    public function incomplete_cheques(){
        $data["incomplete_cheque_records"] = $this->chequesM->get_incomplete_cheque_records();
        $this->load->view("cheques/incomplete_cheques", $data);
    }
}
