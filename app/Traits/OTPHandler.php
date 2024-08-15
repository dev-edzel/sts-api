<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait OTPHandler
{
    public function generateOTP()
    {
        $otp = strtoupper(Str::random(6));
        $ts = Carbon::now()->toDateTimeString();
        $hashed = hash_hmac('sha256', "{$otp}{$ts}", config('otp.secret'));

        return [
            'otp' => $otp,
            'hashed' => [
                'otp' => $hashed,
                't' => $ts
            ]
        ];
    }

    public function checkOTP($otp, $hashedOTP, $hashDate)
    {
        $ts = Carbon::now()->subMinutes(5)->toDateTimeString();

        $isValid = $hashDate > $ts;
        $isMatched = hash_equals(
            hash_hmac('sha256', "{$otp}{$hashDate}", config('otp.secret')),
            $hashedOTP
        );

        if (!$isValid || !$isMatched) {
            throw new HttpException(400, 'Invalid verification.');
        }
    }
}
