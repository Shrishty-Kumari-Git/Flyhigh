<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flight extends CI_Controller
{
    public function index()
    {
        $this->template->load_view('common/flight_search');
    }
    public function search_result()
    {
        $post_data = $this->input->post();
        // debug($post_data);

        $search_result = $this->amadeusapi->get_search_result($post_data);
        // debug($search_result);

        //print_r(json_encode($search_result));

        if (is_array($search_result)) {
            if ($search_result['status'] == true) {
                if (isset($search_result['data'])) {
                    $search_result_data = $search_result['data'];
                    if (is_array($search_result_data)) {
                        $formatted_search_result_data = $this->format_search_result_data($search_result_data);

						$page_data = array(
							'formatted_search_result_data' => $formatted_search_result_data
						);

                        $this->template->load_view('flight/search_result', $page_data);
                    }
                }
            }
        }
    }

    function format_search_result_data($search_result_data)
    {
        $search_results = [];
        foreach ($search_result_data as $key => $search_result) {
            // debug($search_result_data);die;
            if (is_array($search_result)) {
                $temp = [
                    'numberOfBookableSeats' => $search_result['numberOfBookableSeats'],
                    'itinerariesAreCombined' => true,
                ];
                $searchResultPrice = [
                    'currency' => $search_result['price']['currency'],
                    'basefare' => floatval($search_result['price']['base']),
                    'totalfare' => floatval($search_result['price']['grandTotal']),
                ];
                $tempItineraries = [];
                foreach ($search_result['itineraries'] as $itinerary_key => $itinerary) {
                    $tempItinerary = [];
                    $tempSegments = [];
                    foreach ($itinerary['segments'] as $segment_key => $segment) {
                        $tempsegment = [
                            'operatorCode' => $segment['carrierCode'],
                            'operatorName' => '',
                            'flightNumber' => $segment['number'],
                            'originCode' => $segment['departure']['iataCode'],
                            'originName' => '',
                            'originTerminal' => @$segment['departure']['terminal'],
                            'originTime' => $segment['departure']['at'],
                            'destinationCode' => $segment['arrival']['iataCode'],
                            'destinationName' => '',
                            'destinationTerminal' => @$segment['arrival']['terminal'],
                            'destinationTime' => $segment['arrival']['at'],
                            'duration' => iso8601ToDuration($segment['duration']),
                            'seatsAvalilable' => '',
                            'allowedBaggage' => @$search_result['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weight'] . ' ' . @$search_result['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weightUnit'],
                            'allowedCabinBaggege' => '',
                            'segmentId' => $segment['id'],
                        ];
                        $tempsegments[] = $tempsegment;
                    }

                    $tempItinerary['summary'] = [
                        'operatorCode' => $itinerary['segments'][0]['carrierCode'],
                        'operatorName' => '',
                        'flightNumber' => $itinerary['segments'][0]['number'],
                        'originCode' => $itinerary['segments'][0]['departure']['iataCode'],
                        'originName' => '',
                        'originTerminal' => $itinerary['segments'][0]['departure']['terminal'],
                        'originTime' => $itinerary['segments'][0]['departure']['at'],
                        'destinationCode' => end($itinerary['segments'])['arrival']['iataCode'],
                        'destinationName' => '',
                        'destinationTerminal' => end($itinerary['segments'])['arrival']['terminal'],
                        'destinationTime' => end($itinerary['segments'])['arrival']['at'],
                        'duration' => iso8601ToDuration($itinerary['duration']),
                        'seatsAvalilable' => '',
                        'allowedBaggage' => @$search_result['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weight'] . ' ' . @$search_result['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weightUnit'],
                        'allowedCabinBaggege' => '',
                    ];
                    $tempItinerary['segments'] = $tempsegments;
                    unset($tempsegments);
                    $tempItinerary['price'] = $searchResultPrice;
                    $tempItinerary['duration'] = iso8601ToDuration($itinerary['duration']);
                    $tempItinerary['uniqueKey'] = $search_result['id'];
                    $tempItinerary['response_token'] = json_encode($search_result);
                    $tempItineraries[] = $tempItinerary;
                }
                $temp['itineraries'] = $tempItineraries;
                $searchResults[] = $temp;
            }
        }
        // debug($searchResults);
        return $searchResults;
    }

    public function offer_flight_price()
    {
        $post_data = $this->input->post();
        // debug($post_data);
        $response_token = isset($post_data['responsetoken']) ? $post_data['responsetoken'] : '';

        if (!empty($response_token)) {
            $response_data = json_decode($response_token, true);

            if ($response_data !== null) {
                $offer_details = $this->amadeusapi->get_flight_offer_price($response_data);

                // debug($offer_details);
                if ($offer_details) {
                    $this->template->load_view('flight/flight_book', $offer_details);
                } else {
                    echo 'Failed to fetch offer details.';
                }
            }
        } else {
            echo 'Failed to decode response token.';
        }
    }

    public function flight_creat_order($booking_id = '')
    {
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get('payment_status_check');

        if ($query->num_rows() > 0) {
            $transaction_data = $query->row_array();

            $payment_status_response = $this->phonepeapi->transaction_status($transaction_data);
            // debug($payment_status_response);

            $this->db->set('payment_status', 'SUCCESS');
            $this->db->where('booking_id', $payment_status_response['data']['merchantTransactionId']);
            $this->db->update('payment_status_check');

            if ($payment_status_response && isset($payment_status_response['success'])) {
                if ($payment_status_response['success'] === true) {
                    if ($payment_status_response['code'] === 'PAYMENT_SUCCESS' && $booking_id === $payment_status_response['data']['merchantTransactionId']) {
                        $this->db->limit(1);
                        $this->db->where('booking_id', $payment_status_response['data']['merchantTransactionId']);
                        $query2 = $this->db->get('temp_booking_data');
                        // debug($query2);die;

                        if ($query2->num_rows() > 0) {
                            $row = $query2->row();
                            $bookingId = $row->booking_id;
                            $token = $row->token;

                            $bookingData = json_decode($token, true);

                            $booking_response = $this->amadeusapi->get_filght_creat_order($bookingData);

                            if ($booking_response !== null) {
                                $this->db->set('booking_response', json_encode($booking_response));
                                $this->db->where('booking_id', $bookingId);
                                $this->db->update('temp_booking_data');

                                $booking_status_response = $this->amadeusapi->flight_order_management($booking_response['data']['id']);
                                if ($booking_status_response !== null) {
                                    $this->template->load_view('flight/booked', $booking_response);
                                } else {
                                    echo 'Booking data not found';
                                }
                            } else {
                                echo 'Failed to creat order.';
                            }
                        }
                    } else {
                        echo 'Transactio details not found';
                    }
                }
            }
        }
    }

    public function store_data_in_the_database()
    {
        $post_data = $this->input->post();
        $booking_details = isset($post_data['responsetoken']) ? $post_data['responsetoken'] : '';

        if (!empty($booking_details)) {
            $booking_response_data = json_decode($booking_details, true);
            // debug($booking_response_data);die;
            for ($i = 0; $i < count($post_data['traveler_id']); $i++) {
                $booking_response_data['travelers'][$i] = [
                    'id' => $post_data['traveler_id'][$i],
                    'dateOfBirth' => $post_data['dob'][$i],
                    'name' => [
                        'firstName' => $post_data['first_name'][$i],
                        'lastName' => $post_data['last_name'][$i],
                    ],
                    'gender' => strtoupper($post_data['gender'][$i]),
                    'contact' => [
                        'emailAddress' => $post_data['email'],
                        'phones' => [
                            [
                                'deviceType' => 'MOBILE',
                                'countryCallingCode' => $post_data['countryCallingCode'],
                                'number' => $post_data['phone'],
                            ],
                        ],
                    ],
                ];
            }

            $booking_response_data['traveler_phone'] = $post_data['phone'];
            $booking_response_data['traveler_country_code'] = $post_data['countryCallingCode'];
            $booking_response_data['traveler_email'] = $post_data['email'];

            if ($booking_response_data !== null) {
                $booking_data_string = json_encode($booking_response_data);

                $booking_id = 'FB-' . time() . uniqid();

                $this->db->insert('temp_booking_data', [
                    'booking_id' => $booking_id,
                    'token' => $booking_data_string,
                ]);

                $price = $booking_response_data['flightOffers'][0]['price']['grandTotal'];
                // debug($price);die;

                $payment_gateway_response = $this->phonepeapi->payment_gateway($booking_id, $price);

                // debug($payment_gateway_response);die;

                if (isset($payment_gateway_response->success) && $payment_gateway_response->success == '1') {
                    $paymentCode = $payment_gateway_response->code;
                    $paymentMsg = $payment_gateway_response->message;
                    $payUrl = $payment_gateway_response->data->instrumentResponse->redirectInfo->url;
                    header('Location:' . $payUrl);
                }
            }
        }
    }
}
