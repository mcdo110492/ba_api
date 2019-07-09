<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSetAttributes extends Model
{
    protected $table = "attribute_set_attributes";

    protected $fillable = ['set_id', 'attr_id'];

    public function attributes()
    {
        return $this->hasMany("App\Attributes", "id", "attr_id");
    }

    public function attributeSet()
    {
        return $this->belongsTo("App\AttributeSet", "set_id");
    }
}