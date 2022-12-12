<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply',
        'ticket_id',
        'user_id'
    ];

    /**
     * Gets the related user
     *
     * @return Ticket
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
