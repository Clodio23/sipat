<?php

/**
 * 
 */
class Sirang
{
	private $urlSipnbp = "https://sipnbp.unpatti.ac.id/Service/";
	private $token = "YjYyMGVkYzE2NzZkMTdkMTFlMmM4OWZhODFkMmE5ZjQ1ZDI2YTA5OTZlY2Ew00a";

	function __construct()
	{
		// code here
	}

    function getpayment($va) {

		$data = "nomorva=".$va;
		$urlGetPayment = $this->urlSipnbp."getpayment";
	    $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$urlGetPayment);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result2 = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
	    $result2 = json_decode($result2,true);
    	
    	return $result2;

	}

	function getnomorva($data) {

		$data = "id=".$data['id']."&vatemp=".$data['vatemp']."&layanan=".$data['layanan'];
		$urlGetNoVa = $this->urlSipnbp."getnomorva";
	    $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$urlGetNoVa);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result2 = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
	    $result2 = json_decode($result2,true);
    	
    	return $result2;

	}

    function resetnomorva($data) {

        $data = "id=".$data['id']."&vatemp=".$data['vatemp'];
        $urlGetNoVa = $this->urlSipnbp."resetnomorva";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$urlGetNoVa);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result2 = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result2 = json_decode($result2,true);
        
        return $result2;

    }

    function insertBiller($data) {
        $data = "id=".$data['id']."&id_biller=".$data['id_biller']."&id_periodekeu=".$data['id_periodekeu']."&nomorva=".$data['nomorva']."&nim=".$data['nim']."&nama=".$data['nama']."&id_fak=".$data['id_fak']."&id_prodi=".$data['id_prodi']."&total_tagihan=".$data['total_tagihan']."&waktu_berakhir=".$data['waktu_berakhir']."&logtime=".$data['logtime'];
        $urlInsertBiller = $this->urlSipnbp."insertbiller";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$urlInsertBiller);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result2 = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result2 = json_decode($result2,true);
        
        return $result2;

    }

}