<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Contact extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'messages';

    protected $fillable = [
        'name',
        'isRead',
        'email',
        'message'
    ];
    
}