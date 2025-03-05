<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhonepeApi
{

    protected $CI;

    protected $merchantId;
    protected $apikey;
    protected $salt_Key;
    protected $apiEndpoint;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->database();

        $this->merchantId = 'PGTESTPAYUAT86'; 
        $this->apikey = '96434309-7796-489d-8924-ab56988a6076';
        $this->salt_Key = '1';
        $this->apiEndpoint = 'https://api-preprod.phonepe.com/apis/pg-sandbox';

    }

    function payment_gateway($booking_id,$amount)
    {
        $paymentData = array(
        'merchantId' => $this->merchantId,
        'merchantTransactionId' => "$booking_id",
        "merchantUserId"=>"MUID123",
        'amount' => $amount*100, 
        'redirectUrl'=>base_url('flight/flight_creat_order/'.$booking_id),
        'redirectMode'=>"POST",
        'callbackUrl'=>base_url('flight/flight_creat_order'),
        "merchantOrderId"=> $booking_id,
        "mobileNumber"=>"9999999999",
        "paymentInstrument"=> array(
        "type"=> "PAY_PAGE",
        )
        );

        // debug($paymentData);die;

        $payload_data = json_encode($paymentData);
        $payloadMain = base64_encode($payload_data);

        $payload = $payloadMain."/pg/v1/pay".$this->apikey;
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $this->salt_Key;
        $request = json_encode(array('request'=>$payloadMain));



        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "$this->apiEndpoint/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: " . $final_x_header,
        "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err)
        {
            echo "cURL Error #:" . $err;
        }
        else
        {
            $this->CI->db->set('booking_id', $booking_id);
            $this->CI->db->set('merchantid', $paymentData['merchantId']);
            $this->CI->db->set('merchantTransactionId', $paymentData['merchantTransactionId']);
            $this->CI->db->set('amount', $paymentData['amount']);
            $this->CI->db->set('payment_status', 'Processing');
            $this->CI->db->insert('payment_status_check');
            
            return json_decode($response);
            
            // debug($response);die;
 
        }


    }

    function transaction_status($transaction_data)
    {
        $merchantTransactionId = $transaction_data['merchantTransactionId'];
        
        $path = "/pg/v1/status/{$this->merchantId}/{$merchantTransactionId}";
        $xVerify = hash('sha256', $path . $this->apikey) . '###' . $this->salt_Key;

        $requestUrl = "$this->apiEndpoint/pg/v1/status/$this->merchantId/$merchantTransactionId";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-VERIFY: ' . $xVerify,
            'X-MERCHANT-ID:' . $this->merchantId,
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        // debug($response);die;

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        return $responseData;
    }


    
}

?>