<?php $this->load->view("partial/header"); ?>
<div id="title_bar">
    <div id="title" class="float_left">Checks</div>
    <div id="new_button">
        <?php
        echo anchor("cheques/incomplete_cheques", "<div class='big_button'><span>Add a new check</span></div>", array('title' => "Incomplete checks"));
        ?>
    </div>
</div>
<table class="tablesorter report" id="sortable_table">
    <thead>
        <tr>
            <th>ID</th><th>Date</th><th>Due Date</th><th>Number</th><th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php
//var_dump($all_cheque_records->result_object());
        if (is_object($all_cheque_records)) {
            foreach ($all_cheque_records->result_object() as $cheque) {
                ?>
                <tr>
                    <td><?php echo $cheque->cheque_id; ?></td><td><?php echo $cheque->inserted_date; ?></td>
                    <td><?php echo $cheque->banking_date; ?></td><td><?php echo $cheque->check_number; ?></td>
                    <td><?php echo $cheque->cheque_amount; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<?php
$this->load->view("partial/footer");
