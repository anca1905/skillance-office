<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = []; // Izinkan semua kolom diisi

    // --- RELASI PENTING (JANGAN DIHAPUS) ---

    // 1. Menghubungkan Invoice ke Item-itemnya
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // 2. Menghubungkan Invoice ke Project (Opsional)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
