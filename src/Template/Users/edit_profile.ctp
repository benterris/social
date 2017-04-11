<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/users/timeline">The social network</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><?= $this->Html->link('Profile', 'users/wall/' . $loggedIn['id']) ?></li>
                    <li><?= $this->Html->link('Friends', 'users/friends') ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
              <li><a href="/users/logout">Logout</a></li>
            </ul>
                
                
            </div>
        </div>
    </nav>
<div class="starter-template">
    <h1>Edit your profile</h1>
    
    
    <div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
                    <fieldset>
                        
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('phone_number');
            echo '<div class="form-group">';
            echo '<label for="birth-date[month]">Birth date</label>';
            echo '<div class="form-inline" align="center">';
            echo '<row>';
            echo $this->Form->input('birth_date', [
                    'label' => false,
                    'empty' => true, 
                    'hour' => false, 
                    'minute' => false, 
                    'minYear' => date('Y') - 90, 
                    'maxYear' => date('Y') - 12, 
                    'interval' => 5,
                    'year' => [
                        'class' => 'form-control col-md-4'
                    ],
                    'month' => [
                        'class' => 'form-control col-md-4'
                    ],
                    'day' => [
                        'class' => 'form-control col-md-4'
                    ]
                ]);
            echo '</div></row></div>';
            echo $this->Form->file('submittedFile', ['label' => 'Profile picture']);
            echo $this->Form->control('bio', ['label' => 'Who are you ?']);
        ?>
                 
                    </fieldset>
                    <button class="btn btn-lg btn-default btn-block" type="submit">Edit</button>
    <?= $this->Form->end() ?>
                </div>
    
    
</div>



<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>

-->
