<style>
    .close-button{
        float: right;
        text-decoration: none;
        background-color: #012345;
        width: 30px;
        height: 30px;
        padding: 8px;
        color: #ffffff;
        border-radius: 5px;
    }

    .close-button:hover{
        text-decoration: none;
        background-color: #ff0000;

        color: #010101;
    }
</style>
<div class="problems form">
<?php echo $this->Form->create('Problem'); ?>
	<fieldset>
		<legend><?php echo __('Edit Problem'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Description');
        echo $this->Form->input('rank');
        echo $this->Form->input('input_file');
        echo $this->Form->input('output_file');
    ?>
        <hr/>
        <div id="testCases">
            <?php foreach( $this->data['Testcase'] as $index => $testcase ):?>

                    <div class="singleTestcase" counter_id="<?= $index; ?>">
                        <h1 style="font-size: 20px;font-weight: bold;">TestCase# <?= $index; ?></h1>
                        <a click="deleteRow()" class="close-button" >X</a>
                        Read input<input type="file" class="fileInput" id="fileInput<?= $index; ?>">

                        <?php
                        echo $this->Form->input('Testcase.'.$index.'.input_text',array( 'class'=>'inputText' ,'required' => true));
                        ?>

                        Read output<input type="file" class="fileOutput" id="fileOutput<?= $index; ?>">
                        <?php
                        echo $this->Form->input('Testcase.'.$index.'.output_text',array('class'=>'outputText','required' => true));
                        ?>
                        <hr/>
                        <hr/>
                    </div>
                <?php $max_integer[] = $index; ?>
            <?php endforeach; ?>
        </div>
    </fieldset>

    <button onclick="addMore();return false;">Add More TestCases</button>

<?php echo $this->Form->end(__('Submit')); ?>
</div>


<div class="singleTestcase" id="Tempid" counter_id="{id}" style="display:none;">
    <div class="singleTestcase" counter_id="{id}">

        <h1 style="font-size: 20px;font-weight: bold;"><?= __('TestCase#'); ?> {id}</h1>
        <a class="close-button" >X</a>
        Read input<input type="file" class="fileInput" id="fileInput{id}">
        <?php
        echo $this->Form->input('Testcase.{id}.input_text',array( 'class'=>'inputText' , 'required' => true));
        ?>

        Read output<input type="file" class="fileOutput" id="fileOutput{id}">
        <?php
        echo $this->Form->input('Testcase.{id}.output_text',array('class'=>'outputText', 'required' => true));
        ?>
        <hr/>
        <hr/>
    </div>
</div>


<script>
    var counter = <?= ( isset( $max_integer ) ? max($max_integer) : 0 ) ; ?>;

    function addMore(  )
    {
        counter = counter + 1;

        var content = $('#Tempid').html();
        content = content.replace( /{id}/g, counter );

        $('#testCases').append(content);

    }

    //read from input and insert into input areas
    $('body').on('change', '.fileInput', function() {

        //get the id of the current div Text input area
        var targetInputID = $(this).parent().find('.fileInput').attr('id');

        //get the id of the current div Text input area
        var targetContentID = $(this).parent().find('.inputText').attr('id');

        readInput(targetInputID, targetContentID );
    });

    //read from output areas and insert into output areas
    $('body').on('change', '.fileOutput', function() {

        //get the id of the current div Text input area
        var targetInputID = $(this).parent().find('.fileOutput').attr('id');

        //get the id of the current div Text input area
        var targetContentID = $(this).parent().find('.outputText').attr('id');

        readInput(targetInputID, targetContentID );
    });

    function readInput( targetInputID, targetContentID )
    {
        var input = document.getElementById( targetInputID );
        var output = document.getElementById(targetContentID);

        var myFile = input.files[0];

        var reader = new FileReader();

        reader.addEventListener('load', function (e) {
            output.textContent = e.target.result;
        });

        reader.readAsBinaryString(myFile);


    }
    $('body').on('click', '.close-button', function() {
        $(this).parent().remove();
    });
</script>