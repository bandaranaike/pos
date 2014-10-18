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
class Chequesm extends CI_Model {

    public function get_all_cheque_records() {
        $this->db->where("cheque_status", 0);
        return $this->db->get("ospos_cheques");
    }

    public function get_all_complete_cheque_records() {
        $this->db->where("cheque_status", 1);
        return $this->db->get("ospos_cheques");
    }

    public function get_incomplete_cheque_records() {
        $this->db->where("sale_id", 0);
        return $this->db->get("ospos_cheques");
    }

    public function get_cheque_by_id($cheque_id) {
        $this->db->where("cheque_id", $cheque_id);
        return $this->db->get("ospos_cheques");
    }

    public function save_cheque($cheque_id, $banking_date, $bank, $cheque_amount, $check_number, $sale_id) {
        $this->db->where("cheque_id", $cheque_id);
        $data = array(
            'banking_date' => $banking_date,
            'bank' => $bank,
            'cheque_amount' => $cheque_amount,
            'check_number' => $check_number,
            'sale_id' => $sale_id);
        return $this->db->update("ospos_cheques", $data);
    }

    public function get_incomplete_cheque_sales_id() {
        //SELECT * FROM `ospos_cheques` LEFT JOIN `ospos_sales_payments` ON ospos_sales_payments.sale_id = ospos_cheques.sale_id WHERE ospos_sales_payments.sale_id IS NULL
        $this->db->where("payment_type", "Check");
        $cheque_sales = $this->db->get("sales_payments");
        $sales_ids = array(""=>"Please select");
        // if (isset($cheque_sales->result_object()) && is_array($cheque_sales->result_object())) {

        foreach ($cheque_sales->result_object() as $sales) {
            $sales_ids[$sales->sale_id] = $sales->sale_id . " (Amount : " . $sales->payment_amount . ")";
        }
        //}
//        $this->db->where("sale_id", "0");
//        $cheques = $this->db->get("cheques");
//        if (isset($cheques->result_object()) && is_array($cheques->result_object())) {
//          $sales_ids =  array();
//            foreach ($cheque_sales->result_object() as $sales) {
//                $sales_ids[] = $sales->sale_id;
//            }
//        }
        return $sales_ids;
    }

    public function delte_cheque_by_id($cheque_id) {
        $this->db->where("cheque_id", $cheque_id);
        $this->db->delete('cheques');
    }

    public function cheque_complete($cheque_id) {
        $data = array("cheque_status" => "1");
        $this->db->where("cheque_id", $cheque_id);
        $this->db->update('cheques', $data);
    }

}
