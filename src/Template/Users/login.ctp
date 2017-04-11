<div class="container body-login">
    <!--
    <form class="form-signin" method="post" action="/users/login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">Username</label>
        <input id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input id="inputPassword" class="form-control" placeholder="Password" required="" type="password">
        <div class="checkbox">
            <label>
                <input value="remember-me" type="checkbox"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    -->
    
    <div class="users form">
        <?= $this->Flash->render() ?>
        <form method="post" action="/users/login" class="form-signin">
        
            <h2 class="form-signin-heading">Please log in</h2>
            <input name="username" class="form-control" placeholder="username">
            <input name="password" class="form-control" placeholder="password" type="password">
            
        
        <button class="btn btn-lg btn-default btn-block" type="submit">Sign in</button>
        </form>
    </div>
   
</div>

