<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;

class ZohoController
{

    public function contact()
    {
        $client = new Client();
        $token = ZohoOauth::latest()->first()?->auth_token;
        $headers = [
            'Authorization' => $token,
            'content-type' => 'application/json'
        ];

        $body = '{
    "display_name": "Bowman Furniture",
    "salutation": "Mr.",
    "first_name": "Benjamin",
    "last_name": "George",
    "email": "benjamin.george@bowmanfurniture.com"}';

        $request = new Request('POST', 'https://www.zohoapis.eu/subscriptions/v1/customers', $headers, $body);
        $res = $client->sendAsync($request)->wait();

        return $res->getBody();
    }

    public function index(){
        $contacts = Contact::all();
        return ApiResponse::response(200,'OK', $contacts);
    }
}
