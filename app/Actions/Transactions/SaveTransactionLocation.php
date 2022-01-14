<?php

namespace App\Actions\Transactions;

use App\Location\Location;
use App\Models\Transaction;

class SaveTransactionLocation
{
    public static function execute(Transaction $transaction): Transaction
    {
        $location = resolve(Location::class);
        $latLng = $location->getLocation($transaction->ip_address);
        $transaction->latitude = $latLng['latitude'];
        $transaction->longitude = $latLng['longitude'];
        $transaction->save();
        return $transaction;
    }
}
