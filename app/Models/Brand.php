<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $brand_name
 * @property string $brand_image
 * @property string $brand_tag
 * @property string $description
 * @property int $rating
 * @property bool $is_exclusive
 **/
class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_exclusive' => 'boolean',
        ];
    }
}
