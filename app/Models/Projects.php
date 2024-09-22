<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ticket\Category;
use App\Models\Projects_category;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [

        'name','product_id','company_id','sla_id','start_date','end_date','agent_id','auto_assign'
    ];


    public function projectscategory()
    {
        return $this->belongsToMany(Projects_category::class,'projects_categories','projects_id','category_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function sla()
    {
        return $this->belongsTo(Sla::class,'sla_id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class,'agent_id');
    }
}
