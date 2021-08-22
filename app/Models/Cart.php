<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    protected $fillable = [
        "product_id",
        "qty"
    ];
}
