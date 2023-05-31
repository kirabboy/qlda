<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'admin_id',
        'project_id',
        'fullname',
        'phone',
        'email',
        'address',
        'birthday',
        'avatar',
        'department'
    ];

    protected $casts = [
        'gender'=> Gender::class,
    ];

    public function admins(){
        return $this->belongsTo(Admins::class,'admin_id');
    }

    public function projects(){
        return $this->belongsTo(Projects::class,'project_id');
    }

    public function project_report(){
        return $this->hasOne(Project_report::class,'employee_id');
    }

    public function download_file(){
        return $this->belongsToMany(Down_file::class,'employee_id');
    }
}
