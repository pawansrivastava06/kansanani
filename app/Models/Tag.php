<?php

namespace SundaySim\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $fillable = ['name', 'created_by', 'updated_by', 'created_on', 'updated_on', 'status'];
    
    protected $dates = ['created_on','updated_on'];
    
    protected $table='tag_entity';
    
    
   public function getAllTag() {        
        return Tag::all()->toArray();
    }
}
