<?php


use App\Service\OpenTriviaApi;
use App\Service\Trivia;
use Tests\TestCase;

class TriviaTest extends TestCase
{
    public function test_questions()
    {
        $api = Mockery::mock(OpenTriviaApi::class);
        $api->shouldReceive('get')
            ->with(2, 'easy', 'multiple')
            ->andReturn('{"response_code":0,"results":[{"type":"multiple","difficulty":"easy","category":"Entertainment: Video Games","question":"Who created the digital distribution platform Steam?","correct_answer":"Valve","incorrect_answers":["Pixeltail Games","Ubisoft","Electronic Arts"]},{"type":"multiple","difficulty":"easy","category":"Entertainment: Television","question":"The HBO series &quot;Game of Thrones&quot; is based on which series of books?","correct_answer":"A Song of Ice and Fire","incorrect_answers":["The Wheel of Time","Harry Potter","The Notebook"]}]}');


        $trivia = new Trivia($api);
        $trivia->amount(2)
            ->difficulty('easy')
            ->type('multiple')
            ->load();

        $this->assertCount(2, $trivia->questions());
    }

}
