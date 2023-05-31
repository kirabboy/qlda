<?php

namespace App\Models;

use App\Enums\Librarystatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $table = 'library';
    protected $fillable = [
        'project_id',
        'project_report_id',
        'filename',
        'file_path',
        'file_size',
        'file_type',
        'birthday'
    ];

    protected $casts = [
        'status' => Librarystatus::class,
    ];

    public function projects(){
        return $this->belongsToMany(Projects::class,'project_id');
    }

    public function project_report(){
        return $this->belongsTo(Project_report::class,'project_report_id');
    }

    public function download_files(){
        return $this->hasMany(Down_file::class,'library_id');
    }
}
