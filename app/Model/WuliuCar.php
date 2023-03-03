<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $number
 * @property int $motorcade_id
 * @property int $driver_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class WuliuCar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wuliu_car';

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
    protected $casts = ['id' => 'integer', 'motorcade_id' => 'integer', 'driver_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
