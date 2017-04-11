<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/users/timeline">Facebook 2.0</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li
                        <?php 
                        if($owner){
                            echo 'class="active"';
                        }
                    ?>
                        ><?= $this->Html->link('Profile', 'users/wall/' . $loggedIn['id']) ?></li>
                    <li><?= $this->Html->link('Friends', 'users/friends') ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
              <li><a href="/users/logout">Logout</a></li>
            </ul>
                
                
            </div>
        </div>
    </nav>
<div class="starter-template">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <h1><strong><?= h($user->username) ?></strong></h1>
                <h2>
                    <?= h($user->first_name) ?>
                    <?= h($user->last_name) ?>    
                </h2>
                <br>
                <ul class="list-group">
                    <li class="list-group-item">
                        <p class="text-justify"><?= h($user->bio) ?></p>
                    </li>
                </ul>
            </div>
            <div class="col-xs-4">
                <?php
                if(isset($user->picture_path)) {
                    echo '<div align="center">';
                    echo $this->Html->image($user->picture_path, ['alt' => 'Profile picture', 'class' => 'img-thumbnail']);
                    echo '<br><br></div>';
                    
                }
                if($owner){
                    echo '<div align="center">';
                    echo '<a href="/users/editProfile/' . $loggedIn["id"] . '" class="btn btn-primary">Edit profile</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    <h1 align="center">
        <?php
        if($owner){
            echo 'Your wall';
        }
        else{
            echo $user->username . "'s wall";
        }
        ?>
    </h1>
    <br>
    <div class="posts form large-9 medium-8 columns content">
        <div class="users form large-9 medium-8 columns content">
            <?= $this->Form->create($newPost) ?>
            <fieldset>
                
        <?php
            echo $this->Form->input('content', ['label' => false, 'placeholder' => 'Post on ' . $user->username . "'s wall"]);
        ?>
            </fieldset>
            <div align="right">
    <?= $this->Form->button('Post') ?>
            </div>
    <?= $this->Form->end() ?>
        </div>
    </div>
    <br>
    <?php foreach ($posts as $post): ?>
    <?php if(isset($post->sender)): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6"><h3 class="panel-title panel-title-link"><?= $this->Html->image($post->sender->picture_path, ['alt' => 'Profile picture', 'class' => 'img-thumbnail profileIcon'])?><?= "&nbsp;&nbsp;&nbsp;" . $this->Html->link(h($post->sender->username), ['action' => 'wall', $post->sender->id]) ?> </h3></div>
                    <div class="col-md-6" align="right"><h3 class="panel-title"><small><?= h($post['created']) ?></small></h3></div>
                        
                </div>
            </div>
                
        </div>
        <div class="panel-body">
            <?= h($post['content']) ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    
    
</div>
