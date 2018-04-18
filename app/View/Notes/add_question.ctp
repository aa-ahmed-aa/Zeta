<div class="notes index">
    <?php echo $this->Form->create('Note'); ?>
        <?php
            echo $this->Form->input('question',array( 'required' => true));
            echo $this->Form->input('answer',array( 'required' => true));
            echo $this->Form->input('always',array());
            echo $this->Form->input('show',array());
        ?>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
