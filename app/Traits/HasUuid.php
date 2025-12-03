<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {

                // if ($model instanceof User) {
                //     $model->uuid = self::generateCustomUserUuid();
                // } else {
                $model->uuid = Str::uuid7()->toString();
                // }
            }
        });
    }

    public static function generateCustomUserUuid(): string
    {
        return 'u' . date("y") . '000' . date("md") . rand(1000, 9999) . date("His") . rand(100, 999);
    }
}
