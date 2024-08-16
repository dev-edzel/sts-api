<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantRequest;
use App\Http\Resources\MerchantResource;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        return $this->success(
            'Searching Merchants Successful',
            MerchantResource::collection(
                Merchant::search($request->input('search'))
                    ->paginate(10)
            ),
        );
    }

    public function store(MerchantRequest $request)
    {
        $validated = $request->validated();

        $merchant = Merchant::create($validated);

        return $this->success(
            'Storing Merchant Successful',
            new MerchantResource($merchant)
        );
    }

    public function show(Merchant $merchant)
    {
        return $this->success(
            'Searching Merchant Successful',
            new MerchantResource($merchant)
        );
    }

    public function update(MerchantRequest $request, Merchant $merchant)
    {
        $changes = DB::transaction(function () use ($request, $merchant) {
            $changes = $this->resourceParser($request, $merchant);

            return $changes;
        });

        return $this->success(
            $changes ? 'Updating Merchant Successful' : 'No changes made.',
            new MerchantResource($merchant)
        );
    }

    public function destroy(Merchant $merchant)
    {
        DB::transaction(function () use ($merchant) {
            $merchant->save();
            $merchant->delete();
        });

        return $this->success(
            'Deleting Merchant Successful',
            new MerchantResource($merchant)
        );
    }

    public function trashed(Request $request)
    {
        return $this->success(
            'Searching Merchant Successful',
            MerchantResource::collection(
                Merchant::search($request->input('search'))
                    ->onlyTrashed()->paginate(10)
            )
        );
    }

    public function restore(string $id)
    {
        $merchant = Merchant::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($merchant) {
            $merchant->save();
            $merchant->restore();
        });

        return $this->success(
            'Restoring Merchant Successful',
            new MerchantResource($merchant)
        );
    }
}
