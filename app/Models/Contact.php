<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $primaryKey="id"; // Define primary key
    protected $keyType="int"; // Define primary key type
    protected $table="contacts"; // Define table name
    public $incrementing =true; // Enable auto-incrementing
    public $timestamps=true; // Enable timestamps
    
    protected $fillable = [ // Define fillable fields
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    public function user(): BelongsTo // Define user relationship
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function addresses(): HasMany // Define addresses relationship
    {
        return $this->hasMany(Address::class, 'contact_id', 'id');
    }
}
