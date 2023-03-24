<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;

class ZohoController
{
    public function index()
    {
        return response()->json($this->send('https://www.zohoapis.eu/crm/v4/users?type=AllUsers', null, 'GET'));

    }

    public function account()
    {
        $body = '{
	"data": [
		{
			"Owner": {
				"id": "520277000000342001"
			},
			"Ownership": "Private",
			"Description": "Design your own layouts that align your business processes precisely. Assign them to profiles appropriately.",
			"Account_Type": "Competitor",
			"Rating": "Active",
			"SIC_Code": 12792,
			"Shipping_State": "Shipping_State",
			"Website": "crm.zoho.com",
			"Employees": 12792,
			"Industry": "Data/Telecom OEM",
			"Account_Site": "Account_Site",
			"Phone": "988844559",
			"Billing_Country": "Billing_Country",
			"Account_Name": "Account_Name",
			"Account_Number": "1245681",
			"Ticker_Symbol": "Ticker_Symbol",
			"Billing_Street": "Billing_Street",
			"Billing_Code": "Billing_Code",
			"Shipping_City": "Shipping_City",
			"Shipping_Country": "Shipping_Country",
			"Shipping_Code": "Shipping_Code",
			"Billing_City": "Billing_City",
			"Billing_State": "Billing_State",
			"Fax": "Fax",
			"Annual_Revenue": 127.67,
			"Shipping_Street": "Shipping_Street"
		}
	]
}';
        return response()->json($this->send('https://www.zohoapis.eu/crm/v4/Accounts', $body));

    }

    public function vendor()
    {
        $body = '{
	"data": [
		{
			"Owner": {
				"id": "520277000000342001"
			},
			"Email": "newcrmapi@zoho.com",
			"Category": "Category",
			"Description": "Design your own layouts that align your business processes precisely. Assign them to profiles appropriately.",
			"Vendor_Name": "Vendor_Name",
			"Website": "crm.zoho.com",
			"City": "City",
			"Phone": "988844559",
			"State": "State",
			"GL_Account": "Rental-Income",
			"Street": "Street",
			"Country": "Country",
			"Zip_Code": "Zip_Code"
		}
	]
}';
        return response()->json($this->send('https://www.zohoapis.eu/crm/v4/Vendors', $body));
    }

    public function contact()
    {
        $body = '{
	"data": [
		{
			"Owner": {
				"id": "520277000000342001"
			},
			"Account_Name": {
				"id": "520277000000356001"
			},
			"Vendor_Name": {
				"id": "520277000000357002"
			},
			"Email": "newcrmapi@zoho.com",
			"Description": "Design your own layouts that align your business processes precisely. Assign them to profiles appropriately.",
			"Mailing_Zip": "Mailing_Zip",
			"Reports_To": "Reports_To",
			"Other_Phone": "988844559",
			"Mailing_State": "Mailing_State",
			"Twitter": "Twitter",
			"Other_Zip": "Other_Zip",
			"Mailing_Street": "Mailing_Street",
			"Other_State": "Other_State",
			"Salutation": "Mrs.",
			"Other_Country": "Other_Country",
			"First_Name": "First_Name",
			"Asst_Phone": "988844559",
			"Department": "Department",
			"Skype_ID": "Skype_ID",
			"Assistant": "Assistant",
			"Phone": "988844559",
			"Mailing_Country": "Mailing_Country",
			"Email_Opt_Out": true,
			"Date_of_Birth": "2018-01-25",
			"Mailing_City": "Mailing_City",
			"Other_City": "Other_City",
			"Title": "Title",
			"Other_Street": "Other_Street",
			"Mobile": "988844559",
			"Home_Phone": "988844559",
			"Last_Name": "Last_Name",
			"Lead_Source": "Cold Call",
			"Fax": "Fax",
			"Secondary_Email": "newcrmapi@zoho.com"
		}
	]
}';
        return response()->json($this->send('https://www.zohoapis.eu/crm/v4/Contacts', $body));
    }

    public function deal()
    {
        $body = '{
	"data": [
		{
			"Owner": {
				"id": "520277000000342001"
			},
			"Account_Name": {
				"id": "520277000000356001"
			},
			"Contact_Name": {
				"id": "520277000000358001"
			},
			"Pipeline" : "4876876000000006787",
			"Type": "New Business",
			"Description": "Design your own layouts that align your business processes precisely. Assign them to profiles appropriately.",
			"Deal_Name": "Deal_Name",
			"Amount": 1237.67,
			"Next_Step": "Next_Step",
			"Stage": "Needs Analysis",
			"Lead_Source": "Cold Call",
			"Closing_Date": "2018-01-25"
		}
	]
}';
        return response()->json($this->send('https://www.zohoapis.eu/crm/v4/Vendors', $body));
    }

    private function send($url, $body = null, $method = 'POST')
    {
        $client = new Client();
        $token = ZohoOauth::latest()->first()?->auth_token;
        $headers = [
            'Authorization' => $token
        ];
        $request = new Request($method, $url, $headers, $body);
        $res = $client->sendAsync($request)->wait();

        return json_decode($res->getBody());
    }
}
