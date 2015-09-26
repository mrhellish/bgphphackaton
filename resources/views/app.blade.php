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
            <nav class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <div class="page-header">
                            <h1>Container tracker</h1>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <section id="container_create" class="container formContainer">
            <h2>Create container</h2>
            <div class="messages"></div>
            <form action="/api/containers/" method="post" id="container_create_form">
                <label for="container_create_id">Container Tracking Number</label>
                <input type="text" name="name" id="container_create_id">
                <button class="btn btn-lg btn-primary">Create</button>  
            </form>
        </section>

        <section id="container_track" class="container formContainer">
            <h2>Track container</h2>
            <div class="messages"></div>
            <form action="/api/coordinates/" method="get" id="container_track_form">
                <label for="container_track_id">Container Tracking Number</label>
                <input type="text" name="name" id="container_track_id">
                <button class="btn btn-lg btn-primary">Track</button>  
            </form>

            <div id="track_map" style="width: 100%; height: 500px">
            </div>
        </section>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        
        <script>
            window.initTrackMap = function() {
                var map = new google.maps.Map(jQuery('#track_map').get(0), {
                    center: {lat: 0, lng: 0},
                    scrollwheel: false,
                    zoom: 8
                });
                jQuery('#track_map').css({opacity: 0}).data('map', map);
            };
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initTrackMap"></script>
        <script>
            jQuery(function($){
                var sendRequest = function($form, doneCallback) {
                    var $formMessages = $form.parents('.formContainer').find('.messages');
                    $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        dataType: 'json',
                        data: $form.serialize()
                    }).done(doneCallback).fail(function(response) {
                        $formMessages.html('');
                        $formMessages.append($('<div/>').addClass('error').html('Something went wrong.'));
                    });
                };

                var containerMarkers = {};
                var initContainerOnMap = function(containerData) {
                    jQuery('#track_map').css({opacity: 1});
                    var marker, map = $('#track_map').data('map');

                    if (typeof containerMarkers[containerData.id] != 'undefined') {
                        marker = containerMarkers[containerData.id];
                    } else {
                        var marker = new google.maps.Marker({
                            position: {lat: containerData.latitude, lng: containerData.longitude},
                            map: map,
                            title: containerData.name
                        });
                        containerMarkers[containerData.id] = marker;
                    }

                    map.setCenter(marker.getPosition());
                };

                $('#container_create_form').on('submit', function(){
                    var $form = $(this);
                    var $formMessages = $form.parents('.formContainer').find('.messages');
                    sendRequest($form, function(response) {
                        $formMessages.html('');
                        if (response) {
                            if ((typeof response.success != 'undefined') && response.success) {
                                $formMessages.append($('<div/>').addClass('success').html('Container is successfully created.'));
                            } else if((typeof response.error != 'undefined') && response.error) {
                                $formMessages.append($('<div/>').addClass('error').html(response.error));
                            }
                        } else {
                            $formMessages.append($('<div/>').addClass('error').html('Container is not successfully created.'));                            
                        }
                    });
                    return false;
                });

                $('#container_track_form').on('submit', function(){
                    var $form = $(this);
                    var $formMessages = $form.parents('.formContainer').find('.messages');

                    var action = $form.attr('action');
                    var name   = $form.find('[name="name"]').val();
                    $form.attr('action', action + name);
                    sendRequest($form, function(response) {
                        $formMessages.html('');
                        if (response) {
                            if ((typeof response.success != 'undefined') && response.success) {
                                var containerData = response.data;
                                containerData.name = name;
                                containerData.longitude = 150.644;
                                containerData.latitude = -34.397;
                                initContainerOnMap(containerData);
                            } else if((typeof response.error != 'undefined') && response.error) {
                                $formMessages.append($('<div/>').addClass('error').html(response.error));
                            }
                        } else {
                            $formMessages.append($('<div/>').addClass('error').html('Container is not found.'));                            
                        }
                    });
                    $form.attr('action', action);
                    return false;
                });
            });
        </script>
    </body>
</html>