<?php
$this->layout('layout.php', array('title' => 'CIWatch - Show'));
$user = $this->userSession();
if (!($user instanceof \Sphring\MicroWebFramework\Model\User)) {
    exit();
}

?>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-12 watcher">
            <h1>
                <div class="control">
                    <a href="<?php echo $this->route('addRepo'); ?>" class="btn btn-default"><span
                            class="glyphicon glyphicon-plus"
                            aria-hidden="true"></span> Add repository</a>
                </div>
                Repositories watch
            </h1>
            <hr>
            <?php if (!$showTable): ?>
                <div class="alert alert-info" role="alert">
                    You have no repositories to watch, add one in
                    <a href="<?php echo $this->route('addRepo'); ?>" class="alert-link">Add repository</a>
                </div>
            <?php else: ?>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Info</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($user->getRepos() as $repo): ?>
                        <?php if (!$repo->getWatch()): continue; endif; ?>
                        <tr>
                            <td><?php echo $repo->getFullName(); ?></td>
                            <td>
                                <?php foreach ($providers as $provider): ?>
                                    <?php echo $provider->getImage($repo); ?>
                                <?php endforeach; ?>
                            </td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>

    </div>
</div>
