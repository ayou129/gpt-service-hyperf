<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $dept_id
 * @property string $username
 * @property string $password
 * @property string $token
 * @property string $token_expiretime
 * @property string $nick_name
 * @property string $gender
 * @property string $phone
 * @property string $email
 * @property string $avatar_name
 * @property string $avatar_path
 * @property int $is_admin
 * @property int $enabled
 * @property string $create_by
 * @property string $update_by
 * @property string $pwd_reset_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class SysUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_user';

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
    protected $casts = ['id' => 'integer', 'dept_id' => 'integer', 'is_admin' => 'integer', 'enabled' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
