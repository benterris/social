
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">The social network</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Default </a></li>
                <li><a href="#">Static top</a></li>
                <li><a href="#">Fixed top</a></li>
            </ul>
            
            
        </div>
    </div>
</nav>

<div class="starter-template">
    <div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= 'Register' ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('phone_number');
            echo '<div class="form-group">';
            echo '<label for="birth-date[month]">Birth date</label>';
            echo '<div class="form-inline">';
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
