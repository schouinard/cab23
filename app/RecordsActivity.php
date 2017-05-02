<?php
/**
 * Created by PhpStorm.
 * User: schouinard
 * Date: 17-05-02
 * Time: 11:18
 */

namespace App;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) {
            return;
        }

        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity('created');
            });
        }
    }

    protected static function getActivitiesToRecord()
    {
        if (isset($activities)) {
            return $activities;
        }

        return ['created'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event)
    {
        return $event.'_'.strtolower(class_basename($this));
    }
}