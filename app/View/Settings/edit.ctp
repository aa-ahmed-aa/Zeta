<div class="problems form">
    <h1 style="font-size:20px;">Settings</h1>
    <br/>
    <br/>
    <br/>

   <?= $this->Form->create('Setting');  ?>
        <?php foreach($settings as $setting): ?>
                <h1><?= $setting['Setting']['key']; ?></h1>
                <input value="<?= $setting['Setting']['value']; ?>" name="<?= $setting['Setting']['key']; ?>" style="background-color: #ffffff" type="text"/>

        <?php endforeach; ?>
    <?= $this->Form->end(__('Save')); ?>
</div>