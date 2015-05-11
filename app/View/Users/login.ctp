

<div class="users form">
<?php echo $this->Session->flash('flash', array('element' => 'positive_flash')); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>

        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>