<?php
$user = $this->userSession();
if (!isset($user)): ?>
    <li><a href="<?php echo $this->route('login'); ?>">Login with Github</a></li>
<?php else: ?>
    <li class="dropdown">

        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-expanded="false">
            <img alt="@<?php echo $user->getNickname(); ?>" class="avatar" height="20"
                 src="https://avatars0.githubusercontent.com/u/<?php echo $user->getId(); ?>?v=3&s=40"
                 width="20">
            <?php echo $user->getNickname(); ?><span
                class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo $this->route('profile'); ?>">Profile</a></li>
            <li><a href="<?php echo $this->route('logout'); ?>">Logout</a></li>
        </ul>
    </li>
<?php endif; ?>