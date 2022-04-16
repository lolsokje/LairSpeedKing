<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ContentTypes
{
    public function contentTypeName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->content_type->getName(),
        );
    }
}
