
<?php
require_once 'core/init.php';


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Voto Survey</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" charset="utf-8">
    <link rel="stylesheet" href="bootstrap/css/advanced/advanced.css" charset="utf-8">
    <link rel="stylesheet" href="bootstrap/css/style.css" charset="utf-8">
    <link rel="stylesheet" href="bootstrap/css/advanced/knust-filla.min.css">
</head>
<body>
<div class="container">

    <header class="nav">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-lg-offset-4 col-sm-offset-3 col-xs-offset-2">
                <a href="index.php" class="btn-lg btn-success"></a>
            </div>
        </div>
    </header>
    <div class="clearfix">
    </div><br>
    <!--End of navbar-->

    <div class="well">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <p class="text-muted col-sm-6 col-sm-offset-3">
                        <h3><strong>Audio</strong></h3>
                    </ p>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="https://go.votomobile.org/api/v1/surveys" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="control-label col-md-3">Audio Description :</label>
                            <div class="col-md-6">
                                <input type="text" name="description" value="<?php echo Input::get('description')?>" autofocus="autofocus" id="title"  placeholder="Survey Title" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="format" class="control-label col-md-3">Format :</label>
                            <div class="col-md-6">
                                <input type="text" name="format" value="<?php echo Input::get('format')?>"  id="format"  placeholder="Survey Title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="audio" class="control-label col-md-3">Audio File :</label>
                            <div class="col-md-6">
                                <input type="file" name="audio" id="audio"/>
                            </div>
                        </div>
                        <input type="hidden" name="api_key" value="a1ec34beebc5ebd20468012c1"/>
                        <input type="submit" class="btn btn-lg btn-block btn-success" value="Create">
                    </ form>
                </div>
                <div class="panel-footer">
                    <?php
                    if(Input::exists()){
                        Redirect::to('audio.php');
                    }

                    ?>
                </div>
            </div>

        </div>

    </div>

</ div>

</ div>

</ body>
</ html>
