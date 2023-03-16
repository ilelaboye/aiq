<?php
  require __DIR__ . "/Config/bootstrap.php";
  require __DIR__ . "/Controllers/Api/ApiController.php";

  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);;


  $api = new ApiController();

  $uri = explode( '/', $uri );
  array_splice($uri, 0,3);
  $uri = implode('/', $uri);

  if($_SERVER['REQUEST_METHOD'] == "GET"){
    switch ($uri){
      case "geolocations":
        $api->getGeolocations();
        break;
      case (preg_match('/geolocation\/show\/[1-9][0-9]*$/i', $uri) ? true : false):
        $api->getGeolocation();
        break;
      
      default:
        header("HTTP/1.1 404 Not Founds");
        exit();

    }
  }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
    switch ($uri){
      case "geolocation/create":
        $api->saveGeolocation();
        break;

      case (preg_match('/geolocation\/update\/[1-9][0-9]*$/i', $uri) ? true : false);
        $api->updateGeolocation();
        break;
      
      default:
        header("HTTP/1.1 404 Not Found");
        exit();

    }
  }elseif($_SERVER['REQUEST_METHOD'] == "DELETE"){
    switch ($uri){
      case (preg_match('/geolocation\/delete\/[1-9][0-9]*$/i', $uri) ? true : false):
        $api->deleteGeolocation();
        break;

      
      default:
        header("HTTP/1.1 404 Not Found");
        exit();

    }
  }else{
    header("HTTP/1.1 405 Invalid Request Method");
    exit();
  }


  