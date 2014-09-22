<?php $headers = array("Commission ID","Sale ID", "Customer ID", "Amount"); ?>
<?php $this->load->view("partial/header"); ?>
<div id="page_title" style="margin-bottom:8px;">Commissions</div>
<div id="table_holder">
    <table class="tablesorter report" id="sortable_table">
        <thead>
            <tr>
                <?php foreach ($headers as $header) { ?>
                    <th><?php echo $header; ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commissons as $row) { ?>
                <tr>
                    <?php foreach ($row as $cell) { ?>
                        <td><?php echo $cell; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->load->view("partial/footer"); ?>