 <html><head>

    <?php

        $view_id = $_COOKIE['user_id'];
        $user_id = $_COOKIE['user_id'];

        $cmd = "mongo --eval \"var view_id='$view_id'\" db_show_profile.js";

        exec($cmd, $output, $status);

        $json = mongoOutputToJSON1($output, $status);

        $cmd = "mongo --eval \"var user_id='$user_id';\" db_get_user.js";

        $output = "";

        exec($cmd, $output, $status);

        $xdata = mongoOutputToJSON2($output, $status);

        function mongoOutputToJSON1($output, $status)
        {
            $json = "";

            if ($status) echo "Exec command failed";
            else
            {
                $i = 0; 
                foreach($output as $line)
                { 
                    if ($line[0] == "{")
                      $i = 1;

                    if ($line[0] == "[")
                      $i = 1;

                    if ($i == 1)
                    {
                      $json .= "$line\n"; 
                    }
                }
            }

            $json = json_decode($json);

            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                break;
                case JSON_ERROR_DEPTH:
                    echo ' - Maximum stack depth exceeded';
                break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Underflow or the modes mismatch';
                break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Unexpected control character found';
                break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Syntax error, malformed JSON';
                break;
                case JSON_ERROR_UTF8:
                    echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
                default:
                    echo ' - Unknown error';
                break;
            }

            return $json;
        }


        function mongoOutputToJSON2($output, $status)
        {
            $json = "";

            if ($status) echo "Exec command failed";
            else
            {
                $i = 0; 
                foreach($output as $line)
                { 
                    if ($line[0] == "{")
                      $i = 1;

                    if ($i == 1)
                      $json .= $line;
                }
            }

            $json = json_decode($json);

            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                break;
                case JSON_ERROR_DEPTH:
                    echo ' - Maximum stack depth exceeded';
                break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Underflow or the modes mismatch';
                break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Unexpected control character found';
                break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Syntax error, malformed JSON';
                break;
                case JSON_ERROR_UTF8:
                    echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
                default:
                    echo ' - Unknown error';
                break;
            }

            return $json;
        }

    ?>


 <title> Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="/home/varun/Desktop/Bootstrap Distribution/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Sigmar+One" rel="stylesheet">


    <link href="css/viewProfile.css" rel="stylesheet" type="text/css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
  </head>

  <style type="text/css">
       
     .viewPost
     {
          
          background-color: white;
          border: solid 1.5px black;
          background: white;
     }
 
     .viewEachFollower
     {
          text-align: center;
     }

     #emptySpaceBetweenPosts
     {
          height: 50px;
     }

     .viewMainPictures
          {
               padding: 5px 5px 5px 5px;
               height: 9%;
          }

     .viewPostTitle
     {
          color: black;
          font-family: 'Sigmar One', cursive;
          font-size: 20px;
          position: absolute;
          transition: top 1s;
          -webkit-transition: top 1s;
          -moz-transition: top 1s;
          -o-transition: top 1s;
          text-indent: 8vw;
          top: 20px;
     }

     #navBarMainStyle
     {
          background-color: rgba(250, 80, 70, 1);
          font-family: 'Oswald', sans-serif;
          }

     #navBarBrand
     {
          font-weight: bolder;
               color: white;
     }

     #navBarDropdown
     {
          padding-right: 10px;
     }

     .navBarTextColo
     {
          color: white;
     }


          .viewFollowers
          {

          background-color: white;
          background: white; /* For browsers that do not support gradients */
          height: 100%;
          /*min-height: 326px;*/
          background: -webkit-linear-gradient(white, #E5E5E5); /* For Safari 5.1 to 6.0 */
          background: -o-linear-gradient(white, #E5E5E5); /* For Opera 11.1 to 12.0 */
              background: -moz-linear-gradient(white, #E5E5E5); /* For Firefox 3.6 to 15 */
              background: linear-gradient(white, #E5E5E5); /* Standard syntax */
          }
     #image
     {
          padding: 5px;
          width: 100%;
          height: 70%;
     }

     #myimage
     {
          padding: 5px;
          height: 70%;
     }

     #smallImage
     {
          height: 9%;
          width: 12%;
          border: grey 1px dotted;
          position: relative;
          top: 5px;
          padding: 5px 5px 5px 5px;
     }

     .viewPostButton
     {
        border-radius: 0px;
     }

     .post
     {
        position: relative;
     }
     
      #name
         {
          font-family: 'Oswald';
          font-weight: bold;
          font-size: 30px; 
         }



  </style>

  <script type="text/javascript">
       function previewFile(){
       var preview = document.querySelector('img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else {
           preview.src = "";
       }
  }
    </script>  

  <body style="background-color:rgb(255, 182, 193)">

  <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="newsfeed.php"><span>PhotoSharing.com</span></a>
        </div>
         <ul class="nav navbar-nav navber-center" style="width: 50%;">
              <form action="search.php" method="GET">  
                <input type="text" name="search" placeholder="Search for people." style="margin-top: 10px; height: 30px; width: 100%;">
              </form>
          </ul>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active" onclick="onLoginDivClick()">
              <a href="my_profile.php">My Profile</a>
            </li>
            <li>
              <a href="back_log_out.php">Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container-fluid" style="background: white; padding: 50px;">
          <div class="row">
          <div class="col-lg-1 col-md-1">
    </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="myimage">
              <img src=<?php echo "'".$xdata->profile_picture."'" ?> style="height: 80%; width: 100%; margin-top: 25px; margin-bottom: 25px; padding-left:20px; border: 1px dotted grey;">
                <div style="padding-left:20px">
              <span id="name"><?php echo $xdata->first_name." ".$xdata->last_name; ?></span>
              <br>
              <span id="name"><?php echo $xdata->city.", ".$xdata->state; ?></span>
              <br/>
              <span id="name"><?php echo $xdata->country; ?></span>
              <br/>
              <br/>
            </div>          
            </div>
            <br>
            <div class="col-lg-1 col-md-1">
    </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">

            <form action="back_change_profile_picture.php" method="POST" enctype="multipart/form-data">
              <h2 id="name"> Change Profile Picture: </h2>
              <input name="fileToUpload" id="fileToUpload" type="file" class="btn btn-primary" value="Upload New Image" onchange="previewFile()"><br>
                <img src="emptyProfilePicture.png" height="200" alt="Image preview..."><br><br>
                <input type="submit" value="Okay">
                <input type="reset" value="Cancel">    
            </form>
            <form action="back_insert_post.php" method="POST" enctype="multipart/form-data">
              <h2 id="name"> Upload New Image </h2>
              <input name="fileToUpload" id="fileToUpload" type="file" class="btn btn-primary" value="Upload New Image" onchange="previewFile()"><br>
              <input type="text" name="description" value="" hidden>
              <img src="emptyProfilePicture.png" height="200" alt="Image preview..."><br><br>
              <input type="submit" value="Okay">
              <input type="reset" value="Cancel">
            </div>
            </form>
      </div>
      
    </div>

                <div id="emptySpaceBetweenPosts"></div>
            <div id="emptySpaceBetweenPosts"></div>


    <div class="col-lg-1 col-md-1">
    </div>


 <div class="col-lg-6 col-lg-offset-0 col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0" > 
            
        <!--    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 createNew">+</div>  -->
                <br />
                
                <div id="postsDiv">
                    
                </div>

               
     </div>

<div class="col-lg-4 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12">
          <div class="viewFollowers">
            <h3>Friends</h3>
           
            <div id="friendsDiv">
            </div>

            <div id="emptySpaceBetweenPosts"></div>
            <div id="emptySpaceBetweenPosts"></div>
            <div id="emptySpaceBetweenPosts"></div>

            <div class="viewFollowers">
            <h3> Pending Requests</h3>

            <div id="requestsDiv"></div>

            <div id="emptySpaceBetweenPosts"></div>

          </div>
        </div>
      </div>
    </div>

          </div>
        </div>
      </div>

    <script type="text/javascript">
        
        var json = <?php echo json_encode($json); ?>;
        var postsDiv = document.getElementById('postsDiv')
        var current_user_id =  <?php echo "'".$_COOKIE['user_id']."'"; ?>; 

        for (i = 0; i < json.length; i++)
        {
            if (json[i]['liked'].indexOf(current_user_id) == -1)
            {
                typeOfButton = 'success';
                action = 'Like';
                back = 'back_liking_post.php?post_id='+json[i]['post_id']+"&user_id="+current_user_id;
            }
            else
            {
                typeOfButton = 'danger';
                action = 'Unlike';
                back = 'back_unliking_post.php?post_id='+json[i]['post_id']+"&user_id="+current_user_id; 
            }

            var string = '<div class="post"><button onclick="window.location.assign(\''+back+'\')" class="btn btn-'+typeOfButton+' btn-lg viewPostButton" style="z-index: 1; position: absolute; right: 30px; width: 7.5vw;">'+json[i]['number_of_likes']+'<br>'+action+'</button><p class="viewPostTitle">'+json[i]['user_name']+'</p><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 viewPostClassHeight"><img id="smallImage" src="'+json[i]['profile_picture']+'"></div><div class="viewPost" id="image"><img style="width: 100%; height: 80%; position: relative; top: 10px;" src="'+json[i]['post_picture']+'"></div></div><div id="emptySpaceBetweenPosts"></div>'
        
            postsDiv.innerHTML += string;
        }

        var xdata = <?php echo json_encode($xdata); ?>;
        var friends = xdata['friends']
          
        var friendsDiv = document.getElementById('friendsDiv')

        for (j = 0; j < friends.length; j++)
        {
            var string = '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 viewEachFollower"><img src="'+friends[j]['profile_picture']+'" class="viewMainPictures" style="width: 100%;" /><a href="view_profile.php?view_id='+friends[j]['user_id']+'">'+friends[j]['name']+'</a></div>'

            friendsDiv.innerHTML += string;
        }

        var pending_requests = xdata['pending_requests']
          
        var requestsDiv = document.getElementById('requestsDiv')

        for (j = 0; j < pending_requests.length; j++)
        {
            var string = '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 viewEachFollower"><img src="'+pending_requests[j]['profile_picture']+'" class="viewMainPictures" style="width: 100%;" />'+pending_requests[j]['name']+'<a href="#" id="click"><i class="fa fa-fw fa-lg fa-plus-circle"></i></a></div>'

            requestsDiv.innerHTML += string;
        }



    </script>

</body>
</html>