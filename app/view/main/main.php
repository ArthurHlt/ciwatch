<?php $this->layout('layout.php', array('title' => 'CIWatch')) ?>
<div class="jumbotron">
    <div class="container">
        <h1>Welcome on CIWatch !</h1>

        <p>
            This is a useful tool to see all status from your ci tools in a wink (tools like travis, scrutinizer,
            SensioLabsInsight or CodeClimate).
            <br/>
            It provides also tools to directly create CI environment in one time and permit you to restart inspection on
            a repo.
            <br/>
            <br/>
            <a href="<?php echo $this->route('login'); ?>">Login with your github account</a> and let's the magic come
            to you.
        </p>
    </div>
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-12">
            <div style="max-width: 505px;margin-left: auto;margin-right: auto;">
                <img src="<?php echo $this->asset('image/logo.png'); ?>"/>
            </div>

        </div>

    </div>
</div>
