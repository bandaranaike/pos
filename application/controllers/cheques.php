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
        $this->load->model("chequesm");
    }

    public function index() {
        $data["all_cheque_records"] = $this->chequesm->get_all_cheque_records();
        $this->load->view("cheques/cheque_list", $data);
    }

    public function add_new($chek_id) {
        $data['cheque'] = $this->chequesm->get_cheque_by_id($chek_id)->result_object()[0];
        $data['sale_ids'] = $this->chequesm->get_incomplete_cheque_sales_id();
        $this->load->view("cheques/add_new_cheque", $data);
    }

    public function save_cheque() {
        $banking_date = $this->input->post('banking_date');
        $bank_name = $this->input->post('bank_name');
        $cheque_amount = $this->input->post('cheque_amount');
        $cheque_number = $this->input->post('cheque_number');
        $cheque_id = $this->input->post('cheque_id');
        $sale_id = $this->input->post('sale_id');
        $this->chequesm->save_cheque($cheque_id, $banking_date, $bank_name, $cheque_amount, $cheque_number, $sale_id);

        $this->incomplete_cheques();
    }

    public function incomplete_cheques() {
        $data["incomplete_cheque_records"] = $this->chequesm->get_incomplete_cheque_records();
        $this->load->view("cheques/incomplete_cheques", $data);
    }

    public function delete_cheque_confirm($cheque_id) {
        $data['cheque_id'] = $cheque_id;
        $this->load->view("cheques/delete_cheque_confirm", $data);
    }
    public function delete_cheque($cheque_id) {
        $this->chequesm->delte_cheque_by_id($cheque_id);
        $this->incomplete_cheques();
    }

}
