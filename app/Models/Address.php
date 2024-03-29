<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = "addresses"; // Define table name
    protected $primaryKey = "id"; // Define primary key
    protected $keyType = "int"; // Define primary key type
    public $incrementing = true; // Enable auto-incrementing
    public $timestamps = true; // Enable timestamps
    protected $fillable = [ // Define fillable fields
        'street',
        'city',
        'province',
        'country',
        'postal_code'
    ];

    public function contact(): BelongsTo // Define contact relationship
    {
        return $this->belongsTo(Contact::class, "contact_id", "id");
    }
}
