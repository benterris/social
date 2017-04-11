
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/users/timeline">Facebook 2.0</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><?= $this->Html->link('Profile', 'users/wall/' . $loggedIn['id']) ?></li>
                    <li class="active"><?= $this->Html->link('Friends', 'users/friends') ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
              <li><a href="/users/logout">Logout</a></li>
            </ul>
                
                
            </div>
        </div>
    </nav>

<div class="starter-template">
    <h1>Your friends</h1>
    <table class="table table-striped">
            <thead>
              <tr>
                  
                <th>Username</th>
                <th>pw</th>
                <th>First Name</th>
                <th>Last Name</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $this->Html->link(h($user->username), ['action' => 'wall', $user->id]) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
              </tr>
              <?php endforeach; ?>
              
            </tbody>
    </table>
</div>
