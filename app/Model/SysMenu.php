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
 * @property int $type
 * @property string $title
 * @property string $name
 * @property string $component
 * @property int $menu_sort
 * @property string $icon
 * @property string $path
 * @property int $is_frame
 * @property int $cache
 * @property int $hidden
 * @property string $permission
 * @property string $create_by
 * @property string $update_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class SysMenu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_menu';

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
    protected $casts = ['id' => 'integer', 'pid' => 'integer', 'sub_count' => 'integer', 'type' => 'integer', 'menu_sort' => 'integer', 'is_frame' => 'integer', 'cache' => 'integer', 'hidden' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
