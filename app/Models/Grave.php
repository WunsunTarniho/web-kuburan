<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grave extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = ['id'];

    public function relatives(){
        return $this->hasMany(Relative::class);
    }

    public function scopeSearch($query, $filter){
        $query->when($filter ?? false, function($query, $search){
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhereHas('relatives', function($query) use ($search){
                    $query->where('nama_kerabat', 'like', '%' . $search . '%');
                });
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
}
