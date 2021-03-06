<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;

    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $chars = array(".", "-", "(", ")", " ");

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'phone' => str_replace($chars, "", $request['phone']),
            'mobile_phone' => str_replace($chars, "", $request['mobile_phone']),
            'logo' => $request['logo'],
        ];

        $user = auth()->user();

        // LOGO
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success();
        return redirect()->route('stores.index');
    }

    public function edit($store)
    {
        $store = $this->store->findOrFail($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $chars = array(".", "-", "(", ")", " ");

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'phone' => str_replace($chars, "", $request['phone']),
            'mobile_phone' => str_replace($chars, "", $request['mobile_phone']),
            'logo' => $request['logo'],
        ];
        
        $store = $this->store->find($store);

        // LOGO
        if ($request->hasFile('logo')) {
            if(Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        flash('Loja atualizada com sucesso')->success();
        return redirect()->route('stores.index');
    }

    public function destroy($store)
    {
        $store = $this->store->find($store);
        $store->delete();

        flash('Loja removida com sucesso')->success();
        return redirect()->route('stores.index');
    }
}
