<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $phone
 * @property string $wx_unionid
 * @property string $real_name
 * @property string $nickname
 * @property string $avatar_image_id
 * @property int $gender
 * @property string $birthday
 * @property string $constellation
 * @property string $city
 * @property string $province
 * @property string $country
 * @property int $status
 * @property int $social_id
 * @property string $social_dazzle_nickname
 * @property string $social_signature
 * @property int $social_charm_value
 * @property int $social_magnate_value
 * @property int $social_noble_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

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
    protected $casts = ['id' => 'integer', 'gender' => 'integer', 'status' => 'integer', 'social_id' => 'integer', 'social_charm_value' => 'integer', 'social_magnate_value' => 'integer', 'social_noble_value' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
