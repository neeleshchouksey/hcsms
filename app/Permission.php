<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function childs()
    {
        return $this->hasMany(self::class, 'is_parent');

    }
}
