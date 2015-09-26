<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <header>
            <h1>Container tracker</h1>
        </header>

        <section id="container_track">
            <h1>Track container</h1>
            <div class="messages"></div>
            <form action="" method="post" id="container_track_form">
                <label for="container_track_id">Container Tracking Number</label>
                <input type="text" name="container_id" id="container_track_id">
                <button>Track</button>  
            </form>
        </section>

        <section id="container_create">
            <h1>Create container</h1>
            <div class="messages"></div>
            <form action="" method="post" id="container_create_form">
                <label for="container_create_id">Container Tracking Number</label>
                <input type="text" name="container_id" id="container_track_id">
                <button>Create</button>  
            </form>
        </section>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>