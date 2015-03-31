<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $this->favicon(); ?>">

    <title><?php echo $this->e($title) ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset('css/bootstrap-toggle.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset('css/fuelux-dev.css'); ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo $this->asset('css/style.css'); ?>" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#affix-nav">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->route('index'); ?>">
                <img src="<?php echo $this->asset('image/logo.png'); ?>"/>
                CIWatch</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php echo $this->insert('menu/profile.php') ?>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>


<?= $this->section('content') ?>

<hr>

<footer>
    <p>&copy; CIWatch 2015</p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo $this->asset('js/jquery.min.js'); ?>"></script>
<script src="<?php echo $this->asset('js/underscore-min.js'); ?>"></script>
<script src="<?php echo $this->asset('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo $this->asset('js/bootstrap-toggle.min.js'); ?>"></script>
<script src="<?php echo $this->asset('js/fuelux.min.js'); ?>"></script>

<?= $this->section('javascript') ?>
<script src="<?php echo $this->asset('js/main.js'); ?>"></script>
</body>
</html>


