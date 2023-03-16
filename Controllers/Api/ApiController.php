<?php
require __DIR__ . "/../../Models/Geolocation.php";
class ApiController extends BaseController
{
    // public function listAction()
    // {
    //     $strErrorDesc = '';
    //     $requestMethod = $_SERVER["REQUEST_METHOD"];
    //     $arrQueryStringParams = $this->getQueryStringParams();
    //     if (strtoupper($requestMethod) == 'GET') {
    //         try {
    //             $userModel = new UserModel();
    //             $intLimit = 10;
    //             if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
    //                 $intLimit = $arrQueryStringParams['limit'];
    //             }
    //             $arrUsers = $userModel->getUsers($intLimit);
    //             $responseData = json_encode($arrUsers);
    //         } catch (Error $e) {
    //             $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
    //             $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
    //         }
    //     } else {
    //         $strErrorDesc = 'Method not supported';
    //         $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    //     }
    //     // send output 
    //     if (!$strErrorDesc) {
    //         $this->sendOutput(
    //             $responseData,
    //             array('Content-Type: application/json', 'HTTP/1.1 200 OK')
    //         );
    //     } else {
    //         $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
    //             array('Content-Type: application/json', $strErrorHeader)
    //         );
    //     }
    // }

    public function getGeolocations(){
        $strErrorDesc='';
        try {
            $geolocation = new Geolocation();
            $data = $geolocation->getGeolocations();
            $responseData = json_encode($data);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function getGeolocation(){
        $strErrorDesc='';
        try {
            $geolocation = new Geolocation();
            $id = $_GET['id'];
            $data = $geolocation->getGeolocation($id);
            $responseData = json_encode($data);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    

    public function saveGeolocation(){
        $strErrorDesc='';
        if(!$_POST['city']){
            $this->sendOutput(json_encode(array('error' => "City field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
            return false;
        }
        if(!$_POST['longitude']){
            $this->sendOutput(json_encode(array('error' => "Longitude field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
        }
        if(!$_POST['latitude']){
            $this->sendOutput(json_encode(array('error' => "Latitude field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
        }
        if(!$_POST['radius']){
            $this->sendOutput(json_encode(array('error' => "Radius field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
        }
        try {
            $geolocation = new Geolocation();

            $input = [
                'city'=>$_POST['city'],
                'longitude'=>$_POST['longitude'], 
                'latitude'=>$_POST['latitude'], 
                'radius'=>$_POST['radius'], 
            ];
            $data = $geolocation->saveGeolocation($input);
            $responseData = json_encode($data);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function deleteGeolocation(){
       
        $strErrorDesc='';
        try {
            $geolocation = new Geolocation();
            $data = $geolocation->deleteGeolocation($_GET['id']);
            $responseData = json_encode($data);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function updateGeolocation(){

        $strErrorDesc='';
        if(!$_GET['id']){
            $this->sendOutput(json_encode(array('error' => "Invalid request")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
            return false;
        }
        if(!$_POST['city']){
            $this->sendOutput(json_encode(array('error' => "City field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
            return false;
        }
        if(!$_POST['longitude']){
            $this->sendOutput(json_encode(array('error' => "Longitude field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
        }
        if(!$_POST['latitude']){
            $this->sendOutput(json_encode(array('error' => "Latitude field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
        }
        if(!$_POST['radius']){
            $this->sendOutput(json_encode(array('error' => "Radius field is required")), 
                array('Content-Type: application/json', 'HTTP/1.1 422 Unprocessable Entity')
            );
        }
        try {
            $geolocation = new Geolocation();

            $input = [
                'id'=>$_GET['id'],
                'city'=>$_POST['city'],
                'longitude'=>$_POST['longitude'], 
                'latitude'=>$_POST['latitude'], 
                'radius'=>$_POST['radius'], 
            ];
            $data = $geolocation->updateGeolocation($input);
            $responseData = json_encode($data);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

}