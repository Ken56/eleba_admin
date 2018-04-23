<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $table='shops';
    protected $fillable=['shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','estimate_time','notice','discount','category_id',];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
