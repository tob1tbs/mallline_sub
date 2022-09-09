<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    use HasFactory;

    protected $table = "new_social_facebook_accounts";

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user() {
          return $this->belongsTo(User::class);
    }
}
