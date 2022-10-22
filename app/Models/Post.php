<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategoried;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title',
        'slug',
        'post_date',
        'image',
        'description',
        'tags',
        'status',

    ];

    //__ Join with Categort__\\

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    //__ Join with SubCategort__\\

    public function subcategory()
    {
        return $this->belongsTo(Subcategoried::class, 'subcategory_id');
    }
    //__ Join with User__\\

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
