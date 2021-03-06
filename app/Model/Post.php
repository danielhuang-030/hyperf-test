<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Post extends Model
{
    /**
     * IS LIKED DISLIKE.
     *
     * @var int
     */
    const LIKED_DISLIKE = 0;

    /**
     * IS LIKED LIKE.
     *
     * @var int
     */
    const LIKED_LIKE = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * user.
     *
     * @return \Hyperf\Database\Model\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * liked users.
     *
     * @return \Hyperf\Database\Model\Relations\BelongsToMany
     */
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'post_like')
            ->where('liked', static::LIKED_LIKE)
            ->withTimestamps();
    }
}
