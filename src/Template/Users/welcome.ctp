<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">The social network</a>
        </div>
    </div>
</nav>

<?= $this->Flash->render() ?>
<div class="starter-template">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 vcenter">
                <div class="users form">
                    
                    <form method="post" action="/users/login" class="form-signin">
                        
                        
                        <input name="username" class="form-control" placeholder="username">
                        <input name="password" class="form-control" placeholder="password" type="password">
                        
                        
                        <button class="btn btn-lg btn-default btn-block" type="submit">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-6">
                
                <div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user, ['url' => '/users/add']) ?>
                    <fieldset>
                        <legend><?= "You don't have an account yet ? Register now !"  ?></legend>
        <?php
            echo $this->Form->control('username', ['label' => false, 'placeholder' => 'Username']);
            echo $this->Form->control('password', ['label' => false, 'placeholder' => 'Password']);
            echo $this->Form->control('first_name', ['label' => false, 'placeholder' => 'First name']);
            echo $this->Form->control('last_name', ['label' => false, 'placeholder' => 'Last name']);
            echo $this->Form->control('phone_number', ['label' => false, 'placeholder' => 'Phone number']);
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
        ?>
                    </fieldset>
                    <button class="btn btn-lg btn-default btn-block" type="submit">Register</button>
    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

