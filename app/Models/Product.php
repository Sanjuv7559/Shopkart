<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'image', 'admin_id'];

    // Define the relationship between Product and Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

