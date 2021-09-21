<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $question_id
 * @property string $value
 * @property int $id
 * @property boolean $is_correct
 */
class Answer extends Model
{
    use HasFactory;

    const VALUE = 'value';
    const QUESTION_ID = 'question_id';
    const IS_CORRECT = 'is_correct';
    /**
     * @var string
     */
    protected $table = 'answers';

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::VALUE,
        self::QUESTION_ID,
        self::IS_CORRECT
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->question_id;
    }
    /**
     * @return int
     */
    public function getIsCorrect(): int
    {
        return $this->is_correct;
    }

    /**
     * @return HasOne
     */
    public function question(): HasOne
    {
        return $this->hasOne(Question::class);
    }
}
