<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RecentBlog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function namacategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function nama(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function namatag()
    {
        return $this->hasMany(TagsBlog::class, 'id', 'tags_id');
    }

    public function tags() {
        return $this->belongsToMany(TagsBlog::class, 'artikel_tags', 'tagsblog_id','recentblog_id');
    }

    public function getTagsId() {
        return $this->tags()->pluck('tags')->toArray();
    }

    public static function ambilnamatags($id){
        $data = TagsBlog::find($id);

        if($data){
            $result = $data->tags;
        }else{
            $result = "";
        }
        return $result;
    }

}
