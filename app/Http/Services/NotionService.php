<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class NotionService
{
    protected $client;
    protected $databaseId;
    protected $apiUrl;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.notion.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('NOTION_API_SECRET'),
                'Notion-Version' => '2022-06-28',
                'Content-Type' => 'application/json',
            ],
        ]);
        $this->databaseId = env('NOTION_DATABASE_ID');
    }

    public function getDatabase()
    {
        $response = $this->client->post("databases/{$this->databaseId}/query");
        $returnData = $this->makeJsonData($response);
        return $returnData;
    }

    public function addPage($data)
    {
        $response = $this->client->post('pages', [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    private function makeJsonData($response)
    {
        $jsonData = json_decode($response->getBody(), true);
        $responseJson = response()->json($jsonData);
        $content = $responseJson->content();
        $returnData = json_decode( $content, true );
        return $returnData;
    }
}
