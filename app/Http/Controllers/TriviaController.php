<?php

namespace App\Http\Controllers;

use App\Models\SearchHistory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TriviaController extends Controller
{
    public function store(Request $request): string
    {
        try {
            $srcHistory = new SearchHistory();

            // Validation
            $validatedData = $request->validate([
                'full_name' => 'required',
                'email' => 'required|email',
                'number_of_questions' => 'required|integer|max:50',
                'difficulty' => 'required|in:easy,medium,hard',
                'type' => 'required|in:multiple,boolean',
            ]);

            // GET request 2 API
            $client = new Client();
            $response = $client->request('GET', 'https://opentdb.com/api.php', [
                'query' => [
                    'amount' => $validatedData['number_of_questions'],
                    'difficulty' => $validatedData['difficulty'],
                    'type' => $validatedData['type'],
                ],
            ]);

            $apiLink = 'https://opentdb.com/api.php?' . http_build_query([
                    'amount' => $validatedData['number_of_questions'],
                    'difficulty' => $validatedData['difficulty'],
                    'type' => $validatedData['type'],
                ]);

            $validatedData['question_link'] = $apiLink;

            $triviaData = json_decode($response->getBody(), true);

            // Remove "Entertainment: Video Games" from categories
            $filteredTrivia = array_filter($triviaData['results'], function ($question) {
                return $question['category'] !== 'Entertainment: Video Games';
            });

            // Sort questions by category
            usort($filteredTrivia, function ($a, $b) {
                return strcmp($a['category'], $b['category']);
            });

            // Store in the database
            $srcHistory->fill($validatedData);
            $srcHistory->save();

            return view('list', ['filteredTrivia' => $filteredTrivia])->with('success', 'Data is successfully added');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
