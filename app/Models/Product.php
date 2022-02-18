<?php

namespace App\Models;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'photo_path',
        'in_stock'
    ];

    /**
     * @var string[]
     */
    protected $appends = ['photo_url'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getIsInStockAttribute(): bool
    {
        return $this->in_stock > 0;
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo_path ? Storage::disk(self::photoDisk())->url($this->photo_path) : $this->defaultPhotoUrl();
    }

    public function defaultPhotoUrl(): string
    {
        return 'https://skillz4kidzmartialarts.com/wp-content/uploads/2017/04/default-image.jpg';
    }

    public static function photoDisk(): string
    {
        return 'public';
    }
}
