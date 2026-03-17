<?php

namespace App\Nova\Metrics;
use App\Models\Student;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class StudentCount extends Value
{

    public $name ='Students';
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Student::class, 'name');
        
        //return $this->result(0)->allowZeroResult();
        //eturn $this->countByMonths($request, Student::class);
        //return $this->count($request, Student::class, 'id');
        //return $this->sum($request, Student::class, 'name','year');
        //return $this->max($request, Student::class, 'id');
        

    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            //30 => __('30 Days'),
            //60 => __('60 Days'),
            //365 => __('365 Days'),
            //'TODAY' => __('Today'),
            //'MTD' => __('Month To Date'),
            //'QTD' => __('Quarter To Date'),
            //'YTD' => __('Year To Date'),
            'ALL' => 'All Time',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'StudentCount';
    }
}
