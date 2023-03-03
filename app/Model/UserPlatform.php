<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $user_id
 * @property int $platform
 * @property string $wx_openid
 * @property string $login_token
 * @property string $login_token_expire_time
 */
class UserPlatform extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_platform';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['user_id' => 'integer', 'platform' => 'integer'];
}
