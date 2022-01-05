<?php

namespace App\Actions\Merchants;

use App\Actions\ActionContract;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MerchantUpdateAction implements ActionContract
{
    /**
     * @param Merchant $merchant
     * @param Request $request
     * @return Merchant
     */
    public function execute(Model $merchant, Request $request): Merchant
    {
        $merchant->name = $request->input('name');
        $merchant->brand = $request->input('brand');
        $merchant->document = $request->input('document');
        $merchant->url = $request->input('url');
        $merchant->logo = $request->input('logo');
        $merchant->country_id = $request->input('country_id');
        $merchant->currency_id = $request->input('currency_id');
        $merchant->document_type_id = $request->input('document_type_id');
        $merchant->save();

        return $merchant;
    }
}
