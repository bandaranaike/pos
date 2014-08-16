<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invoices
 *
 * @author Eranda
 */
class invoices extends CI_Model{
    	function get_all($limit=10000, $offset=0)
	{
		$this->db->from('items');
		$this->db->where('deleted',0);
		$this->db->order_by("name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
}
