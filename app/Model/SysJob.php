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
 * @property int $enabled
 * @property int $job_sort
 * @property string $create_by
 * @property string $update_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class SysJob extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_job';

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
    protected $casts = ['id' => 'integer', 'enabled' => 'integer', 'job_sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
