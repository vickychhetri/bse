<?php

namespace App\Http\Controllers;

use CodeDredd\Soap\Facades\Soap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BSELoginController extends Controller
{
//    public function login()
//    {
//        // Define the BSE StAR MF API endpoint for Login Entry
//        $url = "http://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc?singleWsdl";
//
//        // Create the SOAP request payload for Login Entry
//        $xmlPayload = '
//            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://bsestarmf.in/">
//               <soapenv:Header/>
//               <soapenv:Body>
//                 <web:getPassword>
//                         <web:UserId>4051301</web:UserId>
//                         <web:Password>Pa@1234</web:Password>
//                         <web:PassKey>abcdef1234</web:PassKey>
//                      </web:getPassword>
//               </soapenv:Body>
//            </soapenv:Envelope>
//        ';
//
//        // Send the SOAP request
//        $response = Http::withHeaders([
//            'Content-Type' => 'text/xml;charset=UTF-8',
//        ])->post($url, $xmlPayload);
//
//        // Parse the SOAP response
//        if ($response->status() === 200) {
//            $responseXml = simplexml_load_string($response->body());
//            // Extract and process the response data as needed
//            $sessionToken = $responseXml->children('web', true)->MFLoginResult;
//            return "Session Token: $sessionToken";
//        } else {
//            return "Request failed with status code " . $response->status();
//        }
//    }



    public function login2(){

        try {


        $response = Soap::baseWsdl('https://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc?wsdl')
            ->call('getPassword', [
                'UserId' => '4051301',
                'Password' => 'Pa@1234',
                'PassKey' => 'abcdef1234',
            ]);
        }catch(Exception $e){
            return $e->getMessage();
        }
        return $response;

    }
}
