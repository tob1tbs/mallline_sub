<?php

namespace App\Modules\Main\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = "new_wishlist";

    protected $fillable = ['user_id', 'product_id', 'session_id', 'deleted_at', 'deleted_at_int'];

    public function getProductData() {
        return $this->hasOne('App\Modules\Products\Models\Product', 'id', 'product_id');
    }
}
