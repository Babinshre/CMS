<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title','description','content','category_id','image','published_at','user_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function deleteImage()
    {
        Storage::delete($this->image);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    /** 
     *check if post has tag 
     *@return bool 
    
    
    */
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
