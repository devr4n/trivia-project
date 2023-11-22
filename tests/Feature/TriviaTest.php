<?php

namespace Tests\Feature;

use App\Http\Controllers\TriviaController;
use App\Http\Requests\TriviaRequest;
use App\Models\SearchHistory;
use App\Http\Service\OpenTriviaApi;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class TriviaTest extends TestCase
{
    use RefreshDatabase;
    public function test_example(): void
    {
        $client = new Client();

        $api = Mockery::mock(OpenTriviaApi::class);
        $api->shouldReceive('get')
            ->with(2, 'easy', 'multiple')
            ->andReturn('{"response_code":0,"results":[{"type":"multiple","difficulty":"easy","category":"Entertainment: Video Games","question":"Who created the digital distribution platform Steam?","correct_answer":"Valve","incorrect_answers":["Pixeltail Games","Ubisoft","Electronic Arts"]},{"type":"multiple","difficulty":"easy","category":"Entertainment: Television","question":"The HBO series &quot;Game of Thrones&quot; is based on which series of books?","correct_answer":"A Song of Ice and Fire","incorrect_answers":["The Wheel of Time","Harry Potter","The Notebook"]}]}');


        $trivia = new TriviaController();
        $trivia->amount(2)
            ->difficulty('easy')
            ->type('multiple')
            ->load();

        $this->assertCount(2, $trivia->questions());



//        $response = $client->request('GET', config('services.opentdb.api_url'), [
//            'query' => [
//                'amount' => 2,
//                'difficulty' => 'easy',
//                'type' => 'multiple',
//            ],
//        ]);
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertDatabaseCount('search_histories', 1);
    }
}
