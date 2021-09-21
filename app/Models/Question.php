<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $value
 * @property int $test_id
 */
class Question extends Model
{
    use HasFactory;

    const VALUE = 'value';
    const TEST_ID = 'test_id';
    /**
     * @var string
     */
    protected $table = 'questions';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::VALUE,
        self::TEST_ID
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
    public function getTestId(): int
    {
        return $this->test_id;
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return HasOne
     */
    public function test(): HasOne
    {
        return $this->hasOne(Test::class);
    }
}
