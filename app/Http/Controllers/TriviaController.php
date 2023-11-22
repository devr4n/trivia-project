<?php

namespace App\Http\Controllers;

use App\Models\SearchHistory;
use Exception;
use http\Env\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\TriviaRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TriviaController extends Controller
{
    public function store(TriviaRequest $request): string
    {
        try {
            $srcHistory = new SearchHistory();
            $validatedData = $request->validated();

            // GET request 2 API
            $client = new Client();
            $response = $client->request('GET', config('services.opentdb.api_url'), [
                'query' => [
                    'amount' => $validatedData['number_of_questions'],
                    'difficulty' => $validatedData['difficulty'],
                    'type' => $validatedData['type'],
                ],
            ]);

            $apiLink = config('services.opentdb.api_url') . http_build_query([
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
            DB::beginTransaction();
            $srcHistory->save();
            DB::commit();

            return view('list', ['filteredTrivia' => $filteredTrivia])
                ->with('success', 'Data is successfully added');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while storing data: ' . $e->getMessage());
            return view('index')->with('message', 'Error while storing data');
        }
    }

}
