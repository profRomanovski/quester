<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int test_id
 * @property string $value
 * @property int $id
 * @property int $condition
 * @property int $mark
 */
class Result extends Model
{
    use HasFactory;

    const VALUE = 'value';
    const TEST_ID = 'test_id';
    const CONDITION = 'condition';
    const MARK = 'mark';

    /**
     * @var string
     */
    protected $table = 'test_results';

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::VALUE,
        self::TEST_ID,
        self::CONDITION,
        self::MARK
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
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
     * @return int
     */
    public function getCondition(): int
    {
        return $this->condition;
    }

    /**
     * @return int
     */
    public function getMark(): int
    {
        return $this->mark;
    }

    /**
     * @return HasOne
     */
    public function test(): HasOne
    {
        return $this->hasOne(Test::class);
    }
}
