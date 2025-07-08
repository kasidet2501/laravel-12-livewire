<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
        'amount',
        'category',
        'transaction_date'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2'
    ];

    // Scope สำหรับรายรับ
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    // Scope สำหรับรายจ่าย
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    // Relationship
    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_id');
    }
}
