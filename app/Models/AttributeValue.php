<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Attribute;

class AttributeValue extends Model
{
    protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id','price','value',
    ];

    protected $casts = [
        'attribute_id'      =>  'integer',
    ];



    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

}
