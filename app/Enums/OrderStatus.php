<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';

//    public function label(): string
//    {
//        return match($this) {
//            self::PENDING => __('Pending'),
//            self::COMPLETED => __('Completed'),
//        };
//    }
}
