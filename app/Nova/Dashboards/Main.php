<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;
//use Laravel\Nova\Dashboards\AnatomyInterface as Dashboard;

use App\Nova\IIHAllocations;
use App\Nova\IIHGroups;
use App\Nova\Metrics\FacilitatorCount;
use App\Nova\Metrics\GPCount;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\results;
use App\Nova\Metrics\Surgeries;
use App\Nova\Metrics\StudentCount;

use App\Nova\Metrics\SessionNotes;
use App\Nova\Metrics\NotesCount;
use App\Nova\Metrics\PhysQuizzesCount;
//use App\Nova\Metrics\VideoCount;
use App\Nova\Metrics\DissectionVideos;
//use App\Nova\Metrics\Dissection;
use App\Nova\Metrics\PathPotsCount;
use App\Nova\Metrics\AdminAccessGuide;
use App\Nova\Metrics\DicomStudies;

//use App\Mostviewednotes\Mostviewednotes;

class Main extends Dashboard
{
public static $displayInNavigation = false;
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
       //$this->max($request, Dissection::class, 'total');
        new AdminAccessGuide(),
        new NewUsers(),
        new NotesCount(),
        new PhysQuizzesCount(),
        //new Mostviewednotes(),
        //new SessionNotes(),
        //new Dissection(),
        new DissectionVideos(),
        new PathPotsCount(),
        new DicomStudies(),
        //new VideoCount(),
        //new Help,
        //new GPCount(),
        //new NewUsers(),
        //new FacilitatorCount(),
        //new Surgeries(),
        //new StudentCount(),
        ];
    }
}
