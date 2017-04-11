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
    
    <div class="posts form large-9 medium-8 columns content">
        <div class="users form large-9 medium-8 columns content">
            <?= $this->Form->create($newStatus, ['url' => '/users/timeline']) ?>
            <fieldset>
                
        <?php
            echo $this->Form->input('content', ['label' => false, 'placeholder' => "What's on your mind ?"]);
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
                    <div class="col-md-6"><h3 class="panel-title panel-title-link">
                        <?php 
                        echo $this->Html->image($post->sender->picture_path, ['alt' => 'Profile picture', 'class' => 'img-thumbnail profileIcon']) . "&nbsp;&nbsp;&nbsp;" . $this->Html->link(h($post->sender->username), ['action' => 'wall', $post->sender->id]);
                        if (isset($post->receiver)){
                            echo' &#10230; '; //arrow char
                            echo $this->Html->link(h($post->receiver->username), ['action' => 'wall', $post->receiver->id]) . "&nbsp;&nbsp;&nbsp;" . $this->Html->image($post->receiver->picture_path, ['alt' => 'Profile picture', 'class' => 'img-thumbnail profileIcon']); 
                        }
                        ?> 
                    </h3></div>
                    <div class="col-md-6" align="right"><h3 class="panel-title"><small><?= h($post->created) ?></small></h3></div>
                        
                </div>
            </div>
                
        </div>
        <div class="panel-body">
            <?= h($post->content) ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    
    
</div>
