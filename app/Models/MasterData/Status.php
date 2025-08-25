<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'device_repairs';
    protected $guarded = ['id'];
    
    protected $fillable = [
        'customer_id',
        'brand',
        'model', 
        'reported_issue',
        'serial_number',
        'technician_note',
        'status'
    ];

    // Cast attributes to appropriate types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship
    public function customers()
    {
        return $this->belongsTo(\App\Models\MasterData\Customers::class, 'customer_id');
    }
}
