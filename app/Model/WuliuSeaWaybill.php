<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $sail_schedule_id
 * @property string $number
 * @property string $case_number
 * @property string $qf_number
 * @property string $box
 * @property string $box_main_code
 * @property string $good_name
 * @property string $weight
 * @property string $ship_company_towing_fee
 * @property string $car_fee
 * @property string $car_other_fee
 * @property string $car_other_fee_desc
 * @property int $car_id
 * @property string $car_finished_date
 * @property int $receipt_status
 * @property int $poundbill_status
 * @property int $box_reporting_status
 * @property string $liaison
 * @property string $liaison_mobile
 * @property string $liaison_address
 * @property string $liaison_address_detail
 * @property string $liaison_remark
 * @property string $estimated_time
 * @property string $driver_name
 * @property string $driver_mobile_number
 * @property string $driver_id_card
 * @property int $fh_status
 * @property int $rush_status
 * @property int $tos
 * @property int $ship_company_bill_id
 * @property int $motorcade_bill_id
 * @property int $partner_id
 * @property string $partner_towing_fee
 * @property string $partner_overdue_fee
 * @property string $partner_stockpiling_fee
 * @property string $partner_thc_fee
 * @property string $partner_print_fee
 * @property string $partner_clean_fee
 * @property string $partner_other_fee
 * @property string $partner_other_fee_desc
 * @property int $partner_stay_pole
 * @property string $partner_remarks
 * @property int $partner_bill_id
 * @property int $self_bill_id
 * @property int $type
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class WuliuSeaWaybill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wuliu_sea_waybill';

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
    protected $casts = ['id' => 'integer', 'sail_schedule_id' => 'integer', 'car_id' => 'integer', 'receipt_status' => 'integer', 'poundbill_status' => 'integer', 'box_reporting_status' => 'integer', 'fh_status' => 'integer', 'rush_status' => 'integer', 'tos' => 'integer', 'ship_company_bill_id' => 'integer', 'motorcade_bill_id' => 'integer', 'partner_id' => 'integer', 'partner_stay_pole' => 'integer', 'partner_bill_id' => 'integer', 'self_bill_id' => 'integer', 'type' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
