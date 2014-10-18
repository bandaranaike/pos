<?php $this->load->view("partial/header"); ?>
<?php
if (isset($error_message)) {
    echo '<h1 style="text-align: center;">' . $error_message . '</h1>';
    exit;
}
?>
<div id="receipt_wrapper">
    <div id="receipt_header">
        <div id="company_name"><?php echo $this->config->item('company'); ?></div>
        <div id="company_address"><?php echo nl2br($this->config->item('address')); ?></div>
        <div id="company_phone"><?php echo $this->config->item('phone'); ?></div>
        <div id="company_phone"><?php echo $this->config->item('email'); ?></div>
        <div id="sale_receipt">INVOICE</div>
        <table id="sale_detals" border="1">
            <tbody>
                <tr>
                    <td>Date</td>
                    <td>INV NO</td>
                    <td>Salesman</td>
                </tr>
                <tr>
                    <td><?php echo substr($transaction_time, 0, 10); ?></td>
                    <td><?php echo $sale_id; ?></td>
                    <td><?php echo explode(" ", $employee)[0]; ?></td>
                </tr>
            </tbody>
        </table>

        <?php if (isset($customer)) { ?>
            <table id="receipt_general_info" border="1">
                <tr>
                    <td>BILL TO </td>
                </tr>
                <tr>
                    <td id="customer"><?php echo $customer; ?></td>
                </tr>
            </table>
        <?php } ?>    
    </div> 
    <div id="receipt_items_wrapper">
        <table id="receipt_items" border="1">
            <tr>
                <th style="width:15%;">QTY</th>
                <th style="width:15%;">ITEM CODE</th>
                <th style="width:37%;">DESCRIPTION</th>
                <th style="width:16%;text-align:center;">UNIT PRICE</th>
                <th style="width:16%;text-align:center;">AMOUNT</th>
            </tr>
            <?php
            $discountTotal = 0;
            foreach (array_reverse($cart, true) as $line => $item) {
                $discountTotal +=$item['discount'];
                ?>
                <tr>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><span class='long_name'><?php echo $item['name']; ?></span><span class='short_name'><?php echo character_limiter($item['name'], 10); ?></span></td>
                    <td><?php echo $item['description']; ?></td>
                    <td style='text-align:center;'><?php echo to_currency($item['price']); ?></td>
                    <td style='text-align:right;'><?php echo to_currency($item['price'] * $item['quantity'] - $item['price'] * $item['quantity'] * $item['discount'] / 100); ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="3" style='text-align:right;border-top:2px solid #000000;'>Discount</td>
                <td colspan="2" style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($discountTotal); ?></td>
            </tr>
            <tr>
                <td colspan="3" style='text-align:right;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
                <td colspan="2" style='text-align:right;'><?php echo to_currency($subtotal); ?></td>
            </tr>  
            <!-- <?php //foreach ($taxes as $name => $value) {   ?>
                <tr>
                    <td colspan="3" style='text-align:right;'><?php //echo $name;   ?>:</td>
                    <td colspan="2" style='text-align:right;'><?php //echo to_currency($value);   ?></td>
                </tr>
            <?php //} ?> -->
            <tr>
                <td colspan="3" style='text-align:right;'><?php echo $this->lang->line('sales_total'); ?></td>
                <td colspan="2" style='text-align:right'><?php echo to_currency($total); ?></td>
            </tr>
            <?php foreach ($payments as $payment_id => $payment) { ?>
                <tr>
                    <td colspan="3" style="text-align:right;"><?php echo $this->lang->line('sales_payment'); ?></td>
                    <td colspan="2" style="text-align:right;">
                        <?php
                        $splitpayment = explode(':', $payment['payment_type']);
                        echo $splitpayment[0];
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:right;">Payment amount</td>
                    <td colspan="2" style="text-align:right"><?php echo to_currency($payment['payment_amount'] * -1); ?>  </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" style='text-align:right;'><?php echo $this->lang->line('sales_change_due'); ?></td>
                <td colspan="2" style='text-align:right'><?php echo $amount_change; ?></td>
            </tr>
        </table>
    </div>
    <div id="sale_return_policy">
        <?php echo nl2br($this->config->item('return_policy')); ?>
    </div>
    <div class="signature_container">
        <div class="received_by_block">
            <div class="signature_lable">Sold By</div>
            <div class="signature_dot_line">...................................</div>
        </div>
        <div class="sold_by_block">
            <div class="signature_lable">Received By</div>
            <div class="signature_dot_line">...................................</div>
        </div>
    </div>
    <div id='barcode'>
        <?php echo "<img src='index.php/barcode?barcode=$sale_id&text=$sale_id&width=250&height=50' />"; ?>
    </div>
</div>
<?php $this->load->view("partial/footer"); ?>
<?php
if ($this->Appconfig->get('print_after_sale')) {
    ?>
    <script type="text/javascript">
        $(window).load(function ()
        {
            window.print();
        });
    </script>
    <?php
}