<?php

namespace App\Models\Committee;

use Illuminate\Database\Eloquent\Model;

class CommitteeType extends Model
{
    protected $table = 'committee_type';

    protected $fillable = ['id', 'union_id', 'name'];

    public $timestamps = false;

    
}
