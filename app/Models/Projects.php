<?php

namespace App\Models;

use App\Enums\Projectcontract;
use App\Enums\Projectmaterial;
use App\Enums\Projectsample;
use App\Enums\Projectstatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'admin_id',
        'name_project',
        'description',
        'ref',
        'planning',
        'status',
        'date_cre',
        'version',
        'sample_status_MA',
        'file_upload',
        'note',
        'name_CT',
        'company_CT',
        'designtion_CT',
        'mobile_CT',
        'email_CT',
        'contract_status',
        'material_delivery_Pro',
        'lead_time_Pro',
        'person_in_charge_Ur'
    ];

    protected $casts = [
        'status' => Projectstatus::class,
        'sample_status_MA' => Projectsample::class,
        'contract_status' => Projectcontract::class,
        'material_delivery_Pro' => Projectmaterial::class,
    ];

    public function admins(){
        return $this->belongsTo(Admins::class,'admin_id');
    }

    public function library(){
        return $this->belongsToMany(Library::class,'project_id');
    }

    public function employee(){
        return $this->hasMany(Employee::class,'project_id');
    }

    public function project_report(){
        return $this->hasOne(Project_report::class,'project_id');
    }

}
