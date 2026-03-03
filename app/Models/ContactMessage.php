<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lafatour_contact_messages';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'ip_address',
        'user_agent',
        'is_read',
        'is_replied',
        'replied_at',
        'notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeReplied($query)
    {
        return $query->where('is_replied', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_replied', false);
    }

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function markAsReplied()
    {
        $this->update([
            'is_replied' => true,
            'replied_at' => now(),
        ]);
    }
}
