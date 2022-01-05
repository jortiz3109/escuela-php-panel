<?php

namespace App\Actions\Merchants;

use App\Actions\ActionContract;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MerchantStoreAction extends MerchantUpdateAction implements ActionContract
{
    /**
     * @param Merchant $merchant
     * @param Request $request
     * @return Merchant
     */
    public function execute(Model $merchant, Request $request): Merchant
    {
        $merchant->uuid = Str::uuid()->toString();

        return parent::execute($merchant, $request);
    }
}
