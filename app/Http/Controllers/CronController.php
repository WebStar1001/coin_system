<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Invest;
use App\Plan;
use App\Transection;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;


class CronController extends Controller
{
    public function returnInterest()
    {
        $now = Carbon::now();
        $invest = Invest::where('next_time','<=',$now)->get();
        $gnl = GeneralSettings::first();
        foreach ($invest as $data)
        {


            $user = User::find($data->user_id);
            $plan = Plan::find($data->plan_id);
            $next_time = Carbon::parse($now)->addHours($data->hours);
            $price = $data->amount * $plan->price;


            $in = Invest::find($data->id);
            $in->return_rec_time = $data->return_rec_time + 1;
            $in->next_time = $next_time;
            $in->last_time = $now;
            $in->save();

            $interest_amount = ($price * $plan->grow)/100;

            $new_balance = $user->balance + $interest_amount;
            $user->balance = $new_balance;
            $user->save();

            Transection::create([
                'trxid' => 'TRX-'.rand(1000,9999).uniqid(),
                'user_id' => $user->id,
                'des' => 'Interest Return '.$interest_amount.''.$gnl->currency.' Added on Your Wallet',
                'amount' => $interest_amount,
                'balance' => round($new_balance,4)
            ]);

        }

    }
}
