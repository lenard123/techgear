<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ImageSource;

class Image extends Model
{

  protected $fillable = ['source', 'url'];

  public function getUrlAttribute($url)
  {
    return $url;
  }

  public static function generateAvatar(User $user)
  {
    $fullname = strtolower(urlencode("{$user->firstname} {$user->lastname}"));
    
    return Image::create([
      'url' => "https://avatars.dicebear.com/api/initials/$fullname.svg",
      'source' => ImageSource::URL,
    ]);
  }

}
