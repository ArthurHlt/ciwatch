<?php
$this->layout('layout.php', array('title' => 'CIWatch - Add repo'));
$user = $this->userSession();
if (!($user instanceof \Sphring\MicroWebFramework\Model\User)) {
    exit();
}
function isWatched($repo, \Sphring\MicroWebFramework\Model\User $user)
{
    $userRepos = $user->getRepos();
    foreach ($userRepos as $userRepo) {
        if ($userRepo->getFullName() === $repo['full_name']) {
            return $userRepo->getWatch();
        }
    }
    return false;
}

?>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="affix-nav">
            <ul class="nav nav-sidebar" data-spy="affix">
                <?php foreach ($repoName as $name): ?>
                    <li><a href="#<?php echo $name; ?>"><?php echo $name; ?></a></li>
                <?php endforeach; ?>
            </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1>
                <div class="control">
                    <a href="<?php echo $this->route('syncRepoGithub'); ?>" class="btn btn-default"><span
                            class="glyphicon glyphicon-signal"
                            aria-hidden="true"></span> Sync with github</a>
                </div>
                Add repositories
            </h1>
            <?php foreach ($repos as $repoName => $repos): ?>
                <div class="panel panel-default addRepoPanel" id="<?php echo $repoName; ?>">
                    <div class="panel-heading"><?php echo $repoName; ?></div>
                    <div class="panel-body">
                        <?php foreach ($repos as $repo): ?>
                            <form method="post" action="<?php echo $this->route('addRepoPost'); ?>">
                                <div class="form-group">

                                    <label
                                        for="<?php echo $repo['full_name']; ?>"
                                        class="labelName">
                                        <a href="<?php echo $repo['html_url']; ?>"><?php echo $repo['full_name']; ?></a>
                                    </label>
                                    <input type="checkbox"
                                           class="addRepoButton" <?php echo(isWatched($repo, $user) ? 'checked' : null); ?>
                                           data-offstyle="info" data-toggle="toggle"
                                           id="<?php echo $repo['full_name']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $repo['id']; ?>">
                                    <input type="hidden" name="full_name" value="<?php echo $repo['full_name']; ?>">
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php $this->start('javascript') ?>
<script src="<?php echo $this->asset('js/ajaxify.js'); ?>"></script>
<script src="<?php echo $this->asset('js/addrepo.js'); ?>"></script>
<?php $this->stop() ?>
