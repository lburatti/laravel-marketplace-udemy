<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'description', 'phone', 'mobile_phone', 'logo', 'slug',
    ];

    // Get the options for generating the slug.
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrders::class, 'order_store', null, 'order_id');
    }

    // função para notificar donos das lojas
    public function nofityStoreOwners(array $storeId = [])
    {
        $stores = $this::whereIn('id', $storeId)->get();

        // mapeando lojas, encontrando o user dono da loja, criando nova instância de notificação
        $stores->map(function ($store) {
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}
