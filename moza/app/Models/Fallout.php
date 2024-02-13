<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fallout extends Model
{
    use HasFactory;

    public $timestamp = false;
    
    protected $table = 'fallout';
    
    protected $primaryKey = 'order_id';
    
    protected $fillable = 
    [
        'order_id',
        'status_message',
        'sto',
        'tanggal_fallout',
        'pic',
        'status',
        'ket',
        'ticket',
        'created_at',
        'end_at',
        'updated_at'
    ];

    // Tentukan kolom timestamp yang ingin Anda gunakan
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'end_at';
    
    public static function rules() {
        return [
            'order_id' => 'required|string|min:9|max:9',
            'status_message' =>'required|string|max:200',
            'sto' => 'require|string|min:3|max:3',
            'tanggal_fallout' => 'required|date_format:d/m/y',
            'pic' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'ket' => 'required|integer|min:4|max:4',
        ];
    }
}
