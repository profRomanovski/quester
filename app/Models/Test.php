<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $completed
 * @property string $name
 * @property int $id
 * @property int $user_id
 */
class Test extends Model
{
    use HasFactory;

    const ID = 'id';
    public const NAME = 'name';
    const USER_ID = 'user_id';
    const COMPLETED = 'completed';

    protected $table = 'tests';

    protected $primaryKey = self::ID;
    /**
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
        self::USER_ID,
        self::COMPLETED
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
    public function getName(): string
    {
        return $this->name;
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
    public function getCompleted(): int
    {
        return $this->completed;
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
