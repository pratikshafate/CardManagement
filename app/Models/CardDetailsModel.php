<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetailsModel extends Model
{
    use HasFactory;
    public $timestamps = false;
	protected $table="card_details";//table name
	protected $primaryKey='CardId';//primary key

    protected $fillable = [
        'PersonName', 'EmailID','ShortDescription','Contacts','SingleAddress','CreatedDate','LastUpdatedDate'
    ];
}
