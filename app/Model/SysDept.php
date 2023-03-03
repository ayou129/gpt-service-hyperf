<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $pid
 * @property int $sub_count
 * @property string $name
 * @property int $dept_sort
 * @property int $enabled
 * @property string $create_by
 * @property string $update_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class SysDept extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_dept';

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
    protected $casts = ['id' => 'integer', 'pid' => 'integer', 'sub_count' => 'integer', 'dept_sort' => 'integer', 'enabled' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
