<?php
$this->layout('layout.php', array('title' => 'CIWatch - Profile'));
$user = $this->userSession();
if (!($user instanceof \Sphring\MicroWebFramework\Model\User)) {
    exit();
}
?>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-12">
            <h1>Profile</h1>

            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#profile" aria-controls="home" role="tab"
                                                              data-toggle="tab">My
                            Profile</a></li>
                    <li role="presentation"><a href="#scrutinizer" aria-controls="profile" role="tab"
                                               data-toggle="tab">Scrutinizer</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="profile">
                        <form>
                            <div class="form-group">
                                <label for="nameUser">Name</label>
                                <input type="text" class="form-control" id="nameUser" disabled="disabled"
                                       value="<?php echo $user->getName(); ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="nicknameUser">Nickname</label>
                                <input type="text" class="form-control" id="nicknameUser" disabled="disabled"
                                       value="<?php echo $user->getNickname(); ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="emailUser">Email</label>
                                <input type="text" class="form-control" id="emailUser" disabled="disabled"
                                       value="<?php echo $user->getEmail(); ?>"/>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="scrutinizer">
                        tutu
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>