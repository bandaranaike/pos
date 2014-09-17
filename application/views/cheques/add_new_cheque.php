<?php
echo form_open('cheques/save_cheque', array('id' => 'cheque_new_form'));
?>
<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
<ul id="error_message_box"></ul>
<fieldset id="supplier_basic_info">
    <legend>Banking Details</legend>

    <div class="field_row clearfix">
        <?php echo form_label('Banking Date:', 'banking_date_lable', array('class' => 'required')); ?>
        <div class='form_field'>
            <?php
            echo form_input(array(
                'name' => 'banking_date',
                'id' => 'banking_date',
                'value'=>$cheque->banking_date)
            );
            ?>
        </div>
    </div>
    <div class="field_row clearfix">	
        <?php echo form_label('Bank Name:', 'bank_name_lable'); ?>
        <div class='form_field'>
            <?php
            echo form_input(array(
                'name' => 'bank_name',
                'id' => 'bank_name',
                'value'=>$cheque->bank)
            );
            ?>
        </div>
    </div>
    <div class="field_row clearfix">	
        <?php echo form_label('Cheque amount:', 'cheque_amount_lable', array('class' => 'required')); ?>
        <div class='form_field'>
            <?php
            echo form_input(array(
                'name' => 'cheque_amount',
                'id' => 'cheque_amount',
                'value'=>$cheque->cheque_amount)
            );
            ?>
        </div>
    </div>
    <div class="field_row clearfix">	
        <?php echo form_label('Cheque number:', 'cheque_number_lable', array('class' => 'required')); ?>
        <div class='form_field'>
            <?php
            echo form_input(array(
                'name' => 'cheque_number',
                'id' => 'cheque_number',
                'value'=>$cheque->check_number)
            );
            ?>
        </div>
    </div>
    <?php
    echo form_submit(array(
        'name' => 'submit',
        'id' => 'submit',
        'value' => $this->lang->line('common_submit'),
        'class' => 'submit_button float_right')
    );
    ?>
</fieldset>
<?php
echo form_close();
?>
<script type='text/javascript'>

//validation and submit handling
    $(document).ready(function()
    {
        $('#supplier_form').validate({
            submitHandler: function(form)
            {
                $(form).ajaxSubmit({
                    success: function(response)
                    {
                        tb_remove();
                        post_person_form_submit(response);
                    },
                    dataType: 'json'
                });

            },
            errorLabelContainer: "#error_message_box",
            wrapper: "li",
            rules:
                    {
                        company_name: "required",
                        first_name: "required",
                        last_name: "required",
                        email: "email"
                    },
            messages:
                    {
                        company_name: "<?php echo $this->lang->line('suppliers_company_name_required'); ?>",
                        last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
                        email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
                    }
        });
    });
</script>