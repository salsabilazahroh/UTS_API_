<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model 
// implements Authenticatable
{
    protected $table = "users"; // Define table name
    protected $primaryKey = "id"; // Define primary key
    protected $keyType = "int"; // Define primary key type
    public $timestamps = true; // Enable timestamps
    public $incrementing = true; // Enable auto-incrementing
    
    protected $fillable = [ // Define fillable fields
        'username',
        'password',
        'name'
    ];

    public function contacts(): HasMany // Define contacts relationship
    {
        return $this->hasMany(Contact::class, "user_id", "id");
    }

    public function getAuthIdentifierName() // Get authentication identifier name
    {
        return 'username';
    }

    public function getAuthIdentifier() // Get authentication identifier
    {
        return $this->username;
    }

    public function getAuthPassword() // Get authentication password
    {
        return $this->password;
    }

    public function getRememberToken() // Get remember token
    {
        return $this->token;
    }

    public function setRememberToken($value) // Set remember token
    {
        $this->token = $value;
    }

    public function getRememberTokenName() // Get remember token name
    {
        return 'token';
    }
}
