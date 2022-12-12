<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'problem',
        'email',
        'phone_number',
        'status',
        'reference_no',
    ];

    public function replies() {
        return $this->hasMany(Reply::class, 'ticket_id')->latest();
    }
}
