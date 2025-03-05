<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AmadeusApi{
    private $header;
    public $searched_data;

    function __construct(){
        
    }

    private function get_json_response($url,$method='GET',$headers=array(),$data=array(),$encode_post_data = true){
        $method = strtoupper($method);
        $ch = curl_init();
        
        if ($method == 'GET') {   
            @$params = http_build_query($data);         
            $url = $url.'?'.$params;
        }
        elseif ($method == 'POST') {
            if($encode_post_data){
                $params = json_encode($data);
            } else {
                $params = $data;
            }
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        } elseif ($method == 'DELETE') {
            $params = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        // debug($response);
        $headers = curl_getinfo($ch);
        // debug($headers);
        curl_close($ch);

        $response = json_decode($response, true);
        return $response;
        
    }

    private function get_access_token(){

        $access_token = array(
            'status' => false,
            'data' => ''
        );

        $url = 'https://test.api.amadeus.com/v1/security/oauth2/token';
        $auth_data = array(
        'client_id' => 'VjXxiu4kCJ6Xr7A4QzGpbGBWqOuYI0Yu',
        'client_secret' => 'xAfWBJJJNmUWVTBZ',
        'grant_type'    => 'client_credentials'
        );
        $params = http_build_query($auth_data);         
        $headers = array('Content-Type' => 'application/x-www-form-urlencoded');
        
        $requests_response = $this->get_json_response($url,$method='post',$headers,$params,false);

        if(!empty($requests_response)) {
            if(is_array($requests_response)){
                if(isset($requests_response['access_token'])){
                    $access_token['data'] = $requests_response['access_token'];
                    $access_token['status'] = true;
                }
            }
        }

        return $access_token;
    }

    public function get_search_result($search_data = array())
    {
        $search_result = array(
            'status' => false,
            'data' => array()
        );

        // debug($search_data);die;
        $access_token = $this->get_access_token();

        if($access_token['status'] == true){
            $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';

            // $children = $search_data['child'] !== "" ? $search_data['child'] : 0;
            // $infant = $search_data['nfant'] !== "" ? $search_data['nfant'] : 0;

            $returndate = isset($search_data['return']) ? $search_data['return'] : null;

            $travel_data = array(
                'originLocationCode'      => strtoupper($search_data['from']),
                'destinationLocationCode' => strtoupper($search_data['to']),
                'departureDate'           => $search_data['departure'],
                'adults'                  => $search_data['adults'],
                'children'                => $search_data['child'] !== "" ? $search_data['child'] : 0,
                'infants'                 => $search_data['nfant'] !== "" ? $search_data['nfant'] : 0,
                'currencyCode'            => 'INR',
                'max'                     => '20'
            );

            if ($returndate !== null) {
                $travel_data['returnDate'] = $returndate;
            }

            $headers = array('Authorization: Bearer '.$access_token['data']);

            $requests_response = $this->get_json_response($url,$method='GET',$headers,$travel_data);
            
            if(!empty($requests_response)) {
                if(is_array($requests_response)){
                    if(isset($requests_response['data'])){
                        $search_result['data'] = $requests_response['data'];
                        $search_result['status'] = true;
                    }
                }
            }
        }
        $searched_data = $search_result;
        return $search_result;
    }

    public function get_flight_offer_price($data) 
    {
        $access_token = $this->get_access_token();
        
        if ($access_token['status'] == true) 
        {
            $url = 'https://test.api.amadeus.com/v1/shopping/flight-offers/pricing';
            
            $headers = array(
                'Authorization: Bearer ' . $access_token['data'],
                'Content-Type: application/json'
            );
                
                $data = array(
                    'data' => array(
                        "type" =>  "flight-offers-pricing",
                        "flightOffers" => array(
                            $data
                        )
                    )
                );
                $offer_details = $this->get_json_response($url, $method = 'post',$headers,$data);

            if (!empty($offer_details) && is_array($offer_details)) {
                return $offer_details;
            }
        }
        else {
            return false;
        }
    }

    public function get_filght_creat_order($booking_data)
    {
        $access_token = $this->get_access_token();
        
        if ($access_token['status'] == true) 
        {
            $url = 'https://test.api.amadeus.com/v1/booking/flight-orders';
            
            $headers = array(
                'Authorization: Bearer ' . $access_token['data'],
                'Content-Type: application/json'
            );
                
            $data = array(
                'data' => array(
                    "type" =>  "flight-order",
                    "flightOffers" => array(
                        $booking_data['flightOffers'][0]
                    ),
                    "travelers" => $booking_data['travelers'],
                    "remarks" => array(
                        "general" => array(
                            array(
                                "subType" => "GENERAL_MISCELLANEOUS",
                                "text" => "ONLINE BOOKING FROM INCREIBLE VIAJES"
                            )
                        )
                            ),
                    "ticketingAgreement" => array(    
                        "option" => "DELAY_TO_CANCEL",
                        "delay" => "6D"
                    ),
                    "contacts" => array(
                        array(
                            "addresseeName" => array(
                                "firstName" => "PABLO",
                                "lastName" => "RODRIGUEZ"
                            ),
                              "companyName" => "INCREIBLE VIAJES",
                              "purpose" => "STANDARD",
                              "phones" => array(
                                  array(
                                    "deviceType" => "MOBILE",
                                    "countryCallingCode" => $booking_data['traveler_country_code'],
                                    "number" => $booking_data['traveler_phone']
                                  )
                              ),
                              "emailAddress" => $booking_data['traveler_email'],
                              "address" => array(
                                "lines" => array(
                                    "Calle Prado, 16"
                                  ),
                                  "postalCode" => "28014",
                                  "cityName" => "Madrid",
                                  "countryCode" => "ES"
                              )
                        )
                    )
                      
                )
            );
            // debug($data);die;
            $booking_details = $this->get_json_response($url, $method = 'post',$headers,$data);
            if (!empty($booking_details) && is_array($booking_details)) {
                return $booking_details;
            }
        }
        else {
            return false;
        }
    }

    public function flight_order_management($flight_order_Id)
    {
        $access_token = $this->get_access_token();
        
        if ($access_token['status'] == true) 
        {
            $url = "https://test.api.amadeus.com/v1/booking/flight-orders/$flight_order_Id";
            
            $headers = array(
                'Authorization: Bearer ' . $access_token['data'],
                'Content-Type: application/json'
            );

            $data = array();
            
            $order_status_response = $this->get_json_response($url, $method = 'get',$headers,$data);
            // debug($order_status_response);die;

            if (!empty($order_status_response) && is_array($order_status_response)) {
                return $order_status_response;
            }
        }
        else {
            return false;
        }
    }

}
