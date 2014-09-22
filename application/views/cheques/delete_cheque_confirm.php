<?php
echo form_open('cheques/save_cheque', array('id' => 'cheque_new_form'));
?>
<div class='confim_content'>
    <p class="confirm_message">Are you sure you want to delete this ?</p>
    <?php echo anchor("cheques/delete_cheque/{$cheque_id}", " <div class='big_button'>Yes</div>"); ?>
    <?php echo anchor("cheques/incomplete_cheques/", " <div class='big_button'>No</div>"); ?>
</div>
<?php
$this->load->view("partial/footer");