<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Picture extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pictures';

    protected $fillable = [
        'title',
        'url_path',
        'description',
        'size',
        'order'
    ];
    
}