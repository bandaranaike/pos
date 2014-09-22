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
                'value' => $cheque->banking_date)
            );
            echo form_hidden('cheque_id', $cheque->cheque_id);
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
                'value' => $cheque->bank)
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
                'value' => $cheque->cheque_amount)
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
                'value' => $cheque->check_number)
            );
            ?>
        </div>
    </div>
    <div class="field_row clearfix">	
        <?php echo form_label('Sale Number:', 'sale_number_lable', array('class' => 'required')); ?>
        <div class='form_field'>
            <?php
            echo form_dropdown('sale_id', $sale_ids, array($cheque->sale_id), 'id = "sale_number"');
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
                        sale_id: "required",
                        cheque_number: "required",
                        cheque_amount: "required",
                        banking_date:"required"
                    },
            messages:
                    {
                        sale_id: "Please select a sale",
                        cheque_number: "Check number is required",
                        cheque_amount: "Check amount is required",
                        banking_date:"Banking date is required"
                    }
        });
    });
</script>