<?php

namespace App\Models;

use App\Enums\ProjectReportStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_report extends Model
{
    use HasFactory;
    protected $table = 'project_report';
    protected $fillable = [
        'employee_id',
        'project_id',
        'title_report',
        'description_report',
        'date_cre_report',
        'note',
        'status',
        'file_report'
    ];
    protected $casts = [
        'status' => ProjectReportStatus::class,
    ];
    public function library(){
        return $this->hasOne(Library::class, 'project_report_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function projects(){
        return $this->belongsTo(Projects::class,'project_id');
    }


}
