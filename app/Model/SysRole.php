<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $level
 * @property string $description
 * @property string $data_scope
 * @property string $create_by
 * @property string $update_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class SysRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_role';

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
    protected $casts = ['id' => 'integer', 'level' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
