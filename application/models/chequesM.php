<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cheques
 *
 * @author Eranda
 */
class ChequesM extends CI_Model {

    public function get_all_cheque_records() {
        return $this->db->get("ospos_cheques");
    }

    public function get_incomplete_cheque_records() {
        $this->db->where("sale_id", 0);
        return $this->db->get("ospos_cheques");
    }

    public function get_cheque_by_id($cheque_id) {
        $this->db->where("sale_id", $cheque_id);
        return $this->db->get("ospos_cheques")->result_object()[0];
    }

    public function save_cheque($cheque_id, $inserted_date, $banking_date, $bank, $cheque_amount, $check_number, $sale_id) {
        $this->db->where("cheque_id", $cheque_id);
        $data = array(
            'inserted_date' => $inserted_date,
            'banking_date' => $banking_date,
            'bank' => $bank,
            'cheque_amount' => $cheque_amount,
            'check_number' => $check_number,
            'sale_id' => $sale_id);
        return $this->db->update("ospos_cheques", $data);
    }

}
