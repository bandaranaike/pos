<?php $this->load->view("partial/header"); ?>
<div id="title_bar">
    <div id="title" class="float_left">Incomplete Checks</div>
    <div id="new_button">
        <?php
        ?>
    </div>
</div>
<table class="tablesorter report" id="sortable_table">
    <thead>
        <tr>
            <th>ID</th><th>Date</th><th>Due Date</th><th>Number</th><th>Amount</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_object($incomplete_cheque_records)) {
            foreach ($incomplete_cheque_records->result_object() as $cheque) {
                ?>
                <tr>
                    <td><?php echo $cheque->cheque_id; ?></td><td><?php echo $cheque->inserted_date; ?></td>
                    <td><?php echo $cheque->banking_date; ?></td><td><?php echo $cheque->check_number; ?></td>
                    <td><?php echo $cheque->cheque_amount; ?></td>
                    <td><?php echo anchor("cheques/add_new/{$cheque->cheque_id}", "Edit", array('class' => 'thickbox none', 'title' => "Edit")); ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<?php
$this->load->view("partial/footer");

