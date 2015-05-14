<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <h2><?php echo __('Register now'); ?></h2>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('pwd_repeat', ['type' => 'password', 'label' => 'Repeat Password']);
        //echo $this->Form->input('pwd_repeat');
        echo $this->Form->input('email');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Register')); ?>
</div>