<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ImageSource;

class Image extends Model
{

  protected $fillable = ['source', 'url'];

  const DEFAULT = 1;

  public function getUrlAttribute($url)
  {
    switch ($this->source) {

      case ImageSource::ASSET:
        return asset($url);

      case ImageSource::STORAGE:
        return asset('storage/'.$url);

      default:
        return $url;
    }
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
