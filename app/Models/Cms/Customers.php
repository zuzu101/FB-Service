<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $guarded = ['id'];
    
    // Tambahkan fillable untuk field bahasa Inggris dan Indonesia
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address', 
        'status'
    ];

    // Relationship - hasMany device repairs
    public function deviceRepairs()
    {
        return $this->hasMany(\App\Models\Cms\DeviceRepair::class, 'customer_id');
    }
}
