<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $table = "new_product_options";

    public function optionValues() {
        return $this->hasMany('App\Modules\Products\Models\ProductOptionValue', 'option_id', 'id');
    }
}
