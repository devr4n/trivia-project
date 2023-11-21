<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $table= 'search_histories';
    protected $fillable = [
        'full_name',
        'email',
        'number_of_questions',
        'difficulty',
        'type',
        'question_link',];
}
