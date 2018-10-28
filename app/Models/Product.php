<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 

Class Product extends Model {

    protected $fillable  = ['name', 'qty']; 

    public static $rules =[
        'name'=>'required', 
        'qty'=>'required'
    ]; 
}