<style>

</style>


<div class="notes index">
    <a href="<?= Router::url(['action'=>'add_question']); ?>">Add Question</a>

    <table class="table table-hover">
        <thead>
        <tr>
            <th><?php echo 'Question'; ?></th>
            <th><?php echo 'Answer'; ?></th>

            <?php if(AuthComponent::user('role') == 1): ?>
                <th><?php echo 'always'; ?></th>
                <th><?php echo 'show'; ?></th>
                <th><?php echo 'Actions' ?></th>
            <?php endif; ?>


        </tr>
        </thead>
        <tbody>
        <?php foreach($notes as $note): ?>
            <tr>
                <td><?= $note['Note']['question']; ?></td>
                <td><?= $note['Note']['answer']; ?></td>

                <?php if(AuthComponent::user('role') == 1): ?>
                    <td><?= $note['Note']['always']; ?></td>
                    <td><?= $note['Note']['show']; ?></td>

                    <td>
                        <a class="edit" href="<?= Router::url(['action'=>'edit_question',$note['Note']['id']]); ?>">Edit</a>
                    </td>
                    <td>
                        <?= $this->Form->postLink(__('Delete'), array('action' => 'delete_question', $note['Note']['id']), array(), __('Are you sure you want to delete # %s?', $note['Note']['id'])); ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
</div>
