
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
    <script type="text/javascript" src="js/jquery-2.2.2.js"></script>
  </head>
  <body>
    <div class="container">

      <header class="nav">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 col-lg-offset-4 col-sm-offset-3 col-xs-offset-2">
            <a href="index.php" class="btn-lg btn-success">WELCOME</a>
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
                    <h3><strong>Create Survey</strong></h3>
                    </ p>
                </div>
                <div class="panel-body">
                  <p id="response"></p>
                  <form action="https://go.votomobile.org/api/v1/surveys" method="post">
                    <div class="form-group">
                      <label for="title" class="control-label col-md-3">Survey Title :</label>
                      <div class="col-md-6">
                        <input type="text" name="survey_title" value="<?php echo Input::get('title')?>" autofocus="autofocus" id="title"  placeholder="Survey Title" class="form-control">
                      </div>
                    </div>
                     <input type="hidden" id="key" name="api_key" value="a1ec34beebc5ebd20468012c1"/><br>
                    <input type="submit"  class="btn btn-lg btn-block btn-success" value="Create">
                  </form>
                </div>
                <div class="panel-footer">

                      <script type="text/javascript">

                        function createSurvey(){
                          var title=document.getElementById('title').value;
                          var key=document.getElementById('key').value;


                           $.ajax({
                           url: 'https://go.votomobile.org/api/v1/surveys',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                           survey_title: title,
                           api_key: key
                           },
                           success: function(resp){
                             $("#response").html(resp['data']);
                           }
                           });
                          /*$.post(
                              "https://go.votomobile.org/api/v1/surveys",
                              {
                                survey_title: title,
                                api_key: key
                              },
                              function(response,status){
                                window.location("audio.php");
                              }
                          );*/

                        }

                      </script>


                </div>
            </div>

          </div>

        </div>

      </div>

    </div>

  </body>
</</html>
