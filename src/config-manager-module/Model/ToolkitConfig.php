<?php

namespace TheBachtiarz\Toolkit\Config\Model;

use Illuminate\Database\Eloquent\Model;

class ToolkitConfig extends Model
{
    protected $fillable = [
        'name',
        'access_group',
        'is_enable',
        'is_encrypt',
        'value'
    ];
}
