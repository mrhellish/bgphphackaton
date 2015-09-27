<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Container tracker</title>

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

        <header style="margin-bottom:60px;">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="#">
                      Container Tracker
                      </a>
                    </div>
                </div>
            </nav>
        </header>
    <div class="container">
    <div class="row">
        <section id="container_create" class="container formContainer col-lg-6">
            <h2>Create container</h2>
            <div class="messages"></div>
            <form action="/api/containers" method="post" id="container_create_form">
                <div class="form-group">
                    <label for="container_create_id">Container Tracking Number</label>
                    <input type="text" name="name" id="container_create_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="longitude">Container longitude</label>
                    <input type="text" name="longitude" id="longitude" class="form-control">
                </div>
                <div class="form-group">
                    <label for="latitude">Container latitude</label>
                    <input type="text" name="latitude" id="latitude" class="form-control">
                </div>
                <button class="btn btn-lg btn-primary">Create</button>  
            </form>
        </section>

        <section id="container_track" class="container formContainer col-lg-6">
            <h2>Track container</h2>
            <div class="messages"></div>
            <form action="/api/coordinates/" method="get" id="container_track_form">
                <div class="form-group">
                    <label for="container_track_id">Container Tracking Number</label>
                    <input type="text" name="name" id="container_track_id" class="form-control">
                </div>
                <button class="btn btn-lg btn-primary">Track</button>  
            </form>

            <div id="track_map" style="width: 100%; height: 500px">
            </div>
        </section>
</div>
</div>
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
                    console.log($form.serialize());
                    $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        dataType: 'json',
                        data: $form.serialize()
                    }).done(doneCallback).fail(function(response) {
                        $formMessages.html('');
                        $formMessages.append($('<div/>').addClass('text-danger').html('Something went wrong.'));
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
                            position: {lat: parseFloat(containerData.latitude), lng: parseFloat(containerData.longitude)},
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
                                $formMessages.append($('<div/>').addClass('text-success').html('Container is successfully created.'));
                            } else if((typeof response.error != 'undefined') && response.error) {
                                $formMessages.append($('<div/>').addClass('text-danger').html(response.error));
                            }
                        } else {
                            $formMessages.append($('<div/>').addClass('text-danger').html('Container is not successfully created.'));                            
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
                                initContainerOnMap(containerData);
                            } else if((typeof response.error != 'undefined') && response.error) {
                                $formMessages.append($('<div/>').addClass('text-danger').html(response.error));
                            }
                        } else {
                            $formMessages.append($('<div/>').addClass('text-danger').html('Container is not found.'));                            
                        }
                    });
                    $form.attr('action', action);
                    return false;
                });
            });
        </script>
    </body>
</html>