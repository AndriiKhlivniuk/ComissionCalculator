<?php
namespace App;
#OUOIY79yCcrpZxI4fleTdO3LhOOElZTj
class CommissionCalculator{

    private function isEu($country_code) {
        $result = false;
        switch($country_code) {
            case 'AT':
            case 'BE':
            case 'BG':
            case 'CY':
            case 'CZ':
            case 'DE':
            case 'DK':
            case 'EE':
            case 'ES':
            case 'FI':
            case 'FR':
            case 'GR':
            case 'HR':
            case 'HU':
            case 'IE':
            case 'IT':
            case 'LT':
            case 'LU':
            case 'LV':
            case 'MT':
            case 'NL':
            case 'PO':
            case 'PT':
            case 'RO':
            case 'SE':
            case 'SI':
            case 'SK':
                $result = true;
                return $result;
        }
        return $result;
    }

    function calculator($line){

        $data = json_decode($line);
        $bin = $data->bin;
        $amount = $data->amount;
        $currency = $data->currency;

        $binResults = file_get_contents('https://lookup.binlist.net/' .$bin);

        if(!$binResults){
            echo "Woring bin\n";
        }
        else{

            $result = json_decode($binResults);
            $isEu = $this->isEu($result->country->alpha2);

            //$rate = @json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true)['rates'][$currency];



            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to=$currency&from=EUR&amount=$amount",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: OUOIY79yCcrpZxI4fleTdO3LhOOElZTj"
              ),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET"
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response, true);
            $rate = $response['info']['rate'];






            if ($currency == 'EUR' or $rate == 0) {
                $amntFixed = $amount;
            }
            if (($currency != 'EUR' or $rate > 0) and $rate!=0){
                $amntFixed = $amount / $rate;
            }
            $commission = round($amntFixed * ($isEu == true ? 0.01 : 0.02), 2);
            return $commission;
        }
        
    }
}

?>




























