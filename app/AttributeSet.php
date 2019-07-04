<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    protected $table = "attribute_set";

    protected $fillable = ['code', 'project_id'];
}
