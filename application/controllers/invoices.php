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
class invoices extends CI_Controller{
    
    public function index(){
        
        
        
        
        
        $this->load->view("invoices/invoices_list");
    }
}