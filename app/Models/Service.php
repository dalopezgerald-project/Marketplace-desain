<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
protected $fillable = [
 'designer_id','category_id','title','description','price','status'
];

public function designer(){
    return $this->belongsTo(User::class,'designer_id');
}

}
