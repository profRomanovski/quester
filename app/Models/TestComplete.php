<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $result
 * @property int $test_id
 * @property int $id
 * @property int $user_id
 */
class TestComplete extends Model
{
    use HasFactory;

    const TEST_ID = 'test_id';
    const USER_ID = 'user_id';
    const RESULT = 'result';

    /**
     * @var string
     */
    protected $table = 'test_completes';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::TEST_ID,
        self::USER_ID,
        self::RESULT
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
    public function getUserId(): int
    {
        return $this->user_id;
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
    public function getResult(): int
    {
        return $this->result;
    }

}
