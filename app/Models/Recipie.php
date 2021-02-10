<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Storage;
use Illuminate\Support\Str;

class Recipie extends Model
{
    use HasFactory;
    use SoftDeletes;

    const DIFFICULTY_LEVELS = [
        'EASY' => 1,
        'MEDIUM' => 2,
        'HARD' => 3,
    ];
    const MAIN_IMAGES_DIRECTORY = 'recipies/main/';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredientGroups()
    {
        return $this->hasMany(IngredientGroup::class);
    }

    public function getEditRouteAttribute()
    {
        return route('recipies.edit', $this);
    }

    public function deleteImage()
    {
        if (is_null($this->image_filename)) {
            return false;
        }

        $result = Storage::delete(self::MAIN_IMAGES_DIRECTORY . $this->image_filename);
        $this->image_filename = null;
        return $result;
    }

    public function makeDynamicImageFilename()
    {
        return Str::slug($this->title) . '.' . Str::of($this->image_filename)->afterLast('.');
    }

    public function getImageContent()
    {
        return Storage::response(self::MAIN_IMAGES_DIRECTORY . $this->image_filename);
    }

    public function getImageUrl()
    {
        if (is_null($this->image_filename)) {
            return null;
        }
        return route('recipies-images.show', ['recipie' => $this->id, 'dynamic_filename' => $this->makeDynamicImageFilename()]);
    }

    public function saveImage(?UploadedFile $image)
    {
        if (is_null($image)) {
            return null;
        }
        $this->deleteImage();
        $filename = "{$this->id}.{$image->guessExtension()}";
        $this->image_filename = $filename;
        return $image->storeAs(self::MAIN_IMAGES_DIRECTORY, $filename);
    }
}
