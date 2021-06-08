<?php

/**
 * 
 */
class Briva
{
    private $url_token = "https://partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials";
    private $urlPost ="https://partner.api.bri.co.id/v1/briva";
    private $institutionCode = "C5BBD19944L";
    private $brivaNo = "10667";
    private $client_id = 'BVp8xvVjeX2sAAlApwN1r0gJYj3Z8DCW';
    private $secret_id = '8R0kgGBhZHJSKNhj';
    // private $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

    private $token;

    function __construct()
    {
        $data = "client_id=".$this->client_id."&client_secret=".$this->secret_id;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$this->url_token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($result, true);
        $this->token = $json['access_token'];
        // return $accesstoken;
    }

    /*Generate signature*/
    function generateSignature($path,$verb,$token,$timestamp,$payload,$secret){
        $payloads = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$payload";
        $signPayload = hash_hmac('sha256', $payloads, $secret, true);
        return base64_encode($signPayload);
    }

    function create($data){

        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
        
        $custCode = $data['custCode'];
        $nama = $data['nama'];
        $amount = $data['amount'];
        $keterangan = $data['keterangan'];
        $expiredDate = $data['expired'];
    
        $datas = array('institutionCode' => $this->institutionCode ,
            'brivaNo' => $this->brivaNo,
            'custCode' => $custCode,
            'nama' => $nama,
            'amount' => $amount,
            'keterangan' => $keterangan,
            'expiredDate' => $expiredDate);
   
        $payload = json_encode($datas, true);

        $path = "/v1/briva";
        $verb = "POST";
        $base64sign = $this->generateSignature($path,$verb,$this->token,$timestamp,$payload,$this->secret_id);
            
        $request_headers = array(
                "Content-Type:"."application/json",
                "Authorization:Bearer " . $this->token,
                "BRI-Timestamp:" . $timestamp,
                "BRI-Signature:" . $base64sign,
            );

        $chPost = curl_init();
        curl_setopt($chPost, CURLOPT_URL,$this->urlPost);
        curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($chPost, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($chPost, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
        curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);
        $resultPost = curl_exec($chPost);
        $httpCodePost = curl_getinfo($chPost, CURLINFO_HTTP_CODE);
        curl_close($chPost);

        $jsonPost = json_decode($resultPost);

        return $jsonPost;
    }

    function delete($custCode) {
        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

        $payload = "institutionCode=".$this->institutionCode."&brivaNo=".$this->brivaNo."&custCode=".$custCode;

        $path = "/v1/briva";
        $verb = "DELETE";
        $base64sign = $this->generateSignature($path,$verb,$this->token,$timestamp,$payload,$this->secret_id);

        $request_headers = array(
                            "Authorization:Bearer " . $this->token,
                            "BRI-Timestamp:" . $timestamp,
                            "BRI-Signature:" . $base64sign,
                        );

        $chPost = curl_init();
        curl_setopt($chPost, CURLOPT_URL,$this->urlPost);
        curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($chPost, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
        curl_setopt($chPost, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);
        $resultPost = curl_exec($chPost);
        $httpCodePost = curl_getinfo($chPost, CURLINFO_HTTP_CODE);
        curl_close($chPost);

        $jsonPost = json_decode($resultPost);

        return $jsonPost;

    }
    
    function getStatus($custCode){

        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
        $path = "/v1/briva/status/".$this->institutionCode."/".$this->brivaNo."/".$custCode;
        $verb = "GET";

        $payload = null;

        $base64sign = $this->generateSignature($path,$verb,$this->token,$timestamp,$payload,$this->secret_id);

        $request_headers = array(
                            "Authorization:Bearer " . $this->token,
                            "BRI-Timestamp:" . $timestamp,
                            "BRI-Signature:" . $base64sign,
                        );

        $urlPost = $this->urlPost."/status/".$this->institutionCode."/".$this->brivaNo."/".$custCode;
        $chPost = curl_init();
        curl_setopt($chPost, CURLOPT_URL,$urlPost);
        curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
        curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);
        $resultPost = curl_exec($chPost);
        $httpCodePost = curl_getinfo($chPost, CURLINFO_HTTP_CODE);
        curl_close($chPost);


        $jsonPost = json_decode($resultPost);


        return $jsonPost;
    }

}