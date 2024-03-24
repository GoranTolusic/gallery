<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Settings extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'settings';

    protected $fillable = [
        'label',
        'title',
        'style',
        'font',
        'about',
        'profile_picture',
        'quote',
        'home_banner_picture',
        'contact_address',
        'contact_phone',
        'contact_email',
        'contact_name',
        'contact_facebook',
        'contact_instagram',
    ];
    
}