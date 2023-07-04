<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Down_file extends Model
{
    use HasFactory;

    protected $table = 'download_files';
    protected $fillable = [
        'employee_id',
        'library_id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function library(){
        return $this->belongsTo(Library::class,'library_id');
    }
}
