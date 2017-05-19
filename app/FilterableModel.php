<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class FilterableModel extends Model
{
    use RecordsActivity;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $relationsToHandleOnStore = [];

    protected $guarded = [];

    public static function scopeFilter($query, $filters = [])
    {
        return $filters->apply($query);
    }

    public function handleRelationsOnStore($request)
    {
        $this->handleRelations($request, "add");
    }

    public function handleRelationsOnUpdate($request)
    {
        $this->handleRelations($request, "update");
    }

    public function handleRelation($relation, $method_name, $request)
    {
        if (key_exists($relation, $request)) {
            $this->$method_name(array_pull($request, $relation));
        }
    }

    /**
     * @return array
     */
    public function getRelationsToHandleOnStore()
    {
        return $this->relationsToHandleOnStore;
    }

    /**
     * @param $request
     */
    public function handleRelations($request, $prefix)
    {
        foreach ($this->relationsToHandleOnStore as $relation) {
            $method_name = "{$prefix}{$relation}";
            if (method_exists($this, $method_name)) {
                $this->handleRelation($relation, $method_name, $request);
            }
        }
    }
}