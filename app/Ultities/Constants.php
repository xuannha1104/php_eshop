<?php

namespace App\Ultities;

class Constants
{
    // Order
    const ORDER_STATUS_RECEIVED = 1;
    const ORDER_STATUS_UNCONFIRMED = 2;
    const ORDER_STATUS_CONFIRMED = 3;
    const ORDER_STATUS_PAID = 4;
    const ORDER_STATUS_PROCESSING = 5;
    const ORDER_STATUS_SHIPPING = 6;
    const ORDER_STATUS_FINISH = 7;
    const ORDER_STATUS_CANCEL = 0;

    public static $orderStatus = [
            self::ORDER_STATUS_RECEIVED => 'Receive Orders',
            self::ORDER_STATUS_UNCONFIRMED => 'Unconfirmed',
            self::ORDER_STATUS_CONFIRMED => 'Confirmed',
            self::ORDER_STATUS_PAID => 'Paid',
            self::ORDER_STATUS_PROCESSING => 'Processing',
            self::ORDER_STATUS_SHIPPING => 'Shipping',
            self::ORDER_STATUS_FINISH => 'Finish',
            self::ORDER_STATUS_CANCEL => 'Cancel',
        ];


    //User
    const USER_LEVEL_HOST = 0;
    const USER_LEVEL_ADMIN = 1;
    const USER_LEVEL_CLIENT = 2;

    public static $user_level = [
      self::USER_LEVEL_HOST => 'Host',
      self::USER_LEVEL_ADMIN => 'Admin',
      self::USER_LEVEL_CLIENT => 'Client',
    ];

}
