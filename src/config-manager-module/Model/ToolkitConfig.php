<?php

namespace TheBachtiarz\Toolkit\Config\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolkitConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'access_group',
        'is_enable',
        'is_encrypt',
        'value'
    ];
}
