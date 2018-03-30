<div class="problems form">
    <?php echo $this->Form->create('Problem'); ?>
    <fieldset>
        <legend><?php echo __('Add Problem'); ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('Description');
        ?>
        <hr/>
        <div id="testCases">
            <div class="singleTestcase" counter_id="0">
                <h1 style="font-size: 20px;font-weight: bold;">TestCase# 0</h1>
                <?php
                    //    echo $this->Form->create('Testcase');
                    echo $this->Form->input('Testcase.0.input_file',array('required' => true));
                    echo $this->Form->input('Testcase.0.input_text',array('required' => true));
                    echo $this->Form->input('Testcase.0.output_file',array('required' => true));
                    echo $this->Form->input('Testcase.0.output_text',array('required' => true));
                    //    echo $this->Form->end();

                ?>
            </div>
        </div>
    </fieldset>

    <button onclick="addMore();return false;">Add More TestCase</button>

    <?php echo $this->Form->end(__('Submit')); ?>

    <div class="singleTestcase" id="Tempid" counter_id="{id}" style="display:none;">
        <div class="singleTestcase" counter_id="{id}">
            <h1 style="font-size: 20px;font-weight: bold;"><?= __('TestCase#'); ?> {id}</h1>
            <?php
            //    echo $this->Form->create('Testcase');
            echo $this->Form->input('Testcase.{id}.input_file',array('required' => true));
            echo $this->Form->input('Testcase.{id}.input_text',array('required' => true));
            echo $this->Form->input('Testcase.{id}.output_file',array('required' => true));
            echo $this->Form->input('Testcase.{id}.output_text',array('required' => true));
            //    echo $this->Form->end();

            ?>
        </div>
    </div>
</div>

<script>
    function addMore( )
    {
        counter = parseInt( $('#testCases :last-child').attr("counter_id") ) +1;

        var content = $('#Tempid').html();
        content = content.replace( /{id}/g, counter );

        $('#testCases').append(content);

    }
</script>