<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'exam_date',
        'exam_end',
        'filiere_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
