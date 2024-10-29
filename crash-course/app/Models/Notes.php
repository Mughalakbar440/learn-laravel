<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notes extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'notes';

    // Define the fillable properties for mass assignment
    protected $fillable = [
        'note',     // The content of the note
        'user_id',  // The ID of the user who created the note
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, you can add a boot method to automatically set the user_id
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($note) {
    //         $note->user_id = Auth::id(); // Automatically set the user_id when creating a note
    //     });
    // }
}
