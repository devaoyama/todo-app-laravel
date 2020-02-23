<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    /**
     * 状態定義
     */
    const STATUS = [
        1 => [
            'label' => '未着手',
            'class' => 'label-danger',
        ],
        2 => [
            'label' => '着手中',
            'class' => 'label-info',
        ],
        3 => [
            'label' => '完了',
            'class' => '',
        ],
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        return self::STATUS[$status]['label'];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        return self::STATUS[$status]['class'];
    }

    public function getFormattedLimitDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['limit_date'])
                     ->format('Y/m/d');
    }
}
