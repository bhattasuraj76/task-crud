<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'project_id',
        'priority',
        'status_id',
    ];


    public function getAllData($inputData = [])
    {
        $data = $this->query();

        if (isset($inputData['project_id'])) {
            $data->where('project_id', $inputData['project_id']);
        }
        return $data->orderBy('priority', 'asc')->get();
    }


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }


    public function getNextPriority()
    {
        return $this->max('priority') + 1;
    }
}
