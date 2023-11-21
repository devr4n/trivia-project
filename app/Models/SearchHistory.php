<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $table= 'search_history';
    protected $fillable = [
        'full_name',
        'email',
        'number_of_questions',
        'difficulty',
        'type',];
}
