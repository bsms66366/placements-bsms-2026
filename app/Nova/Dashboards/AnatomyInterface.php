<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
//use Laravel\Nova\Dashboards\AnatomyInterface as Dashboard;

use App\Nova\Metrics\NewUsers;
//use App\Nova\Metrics\results;
//use App\Nova\Metrics\Surgeries;
//use App\Nova\Metrics\StudentCount;

use App\Nova\Metrics\SessionNotes;
//use App\Nova\Metrics\DissectionVideos;
use App\Nova\Metrics\Dissectionvideos;
use App\Nova\Metrics\PathPotsCount;


class AnatomyInterface extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
        new NewUsers(),
        new SessionNotes(),
        new Dissectionvideos(),
        new PathPotsCount(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'anatomy-interface';
    }
}
