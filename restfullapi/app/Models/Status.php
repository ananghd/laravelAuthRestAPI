<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\StatusResource;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    public $transformer = StatusResource::class;

    const ACTIVE_USER = 'active';
    const INACTIVE_USER = 'inactive';
    
    const POSITIONS = [
    	'direktur utama',
    	'direktur keuangan',
    	'direktur kepegawaian',
    	'direktur teknis',
    	'direktur operasional',
    	'direktur it',
    	'general manager',
    	'manager',
    	'senior staff',
    	'staff',
    	'intern',
    	'kontrak',
    ];

    protected $fillable = [
    	'user_id',
    	'status',
    	'position',
    ];

    public function isActive()
    {
    	return $this->status == Status::ACTIVE_USER;
    }
}
