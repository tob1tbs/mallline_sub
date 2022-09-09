<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialGoogleAccount extends Model
{
    use HasFactory;

    protected $table = "new_social_google_accounts";

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user() {
          return $this->belongsTo(User::class);
    }
}
