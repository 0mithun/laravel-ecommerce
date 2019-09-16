<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'brand_id','sku','name','slug','description','quantity','weight','price','sale_price','status','featured'
    ];


    protected $casts = [
        'brand_id'      =>  'integer',
        'quantity'      =>  'integer',
        'status'        =>  'boolean',
        'featured'      =>  'boolean'
    ];


    public function setNameAttribute($value){
        $this->attributes['name']   = $value;
        $this->attributes['slug']   = str_slug($value);
    }

    public function brand(){
        $this->belongsTo(Brand::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
    }
}
