<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Field;

class AttendanceCards extends Field
{
    public $component = 'attendance-cards';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        
        $this->withMeta([
            'asHtml' => true,
        ]);
    }

    public function resolve($resource, $attribute = null)
    {
        $this->value = $this->resolveCards($resource);
    }

    protected function resolveCards($resource)
    {
        return [
            'session_attendance' => $this->getSessionAttendanceCards($resource),
            'location_signoffs' => $this->getLocationSignoffCards($resource),
            'examination_results' => $this->getExaminationResultCards($resource),
        ];
    }

    protected function getSessionAttendanceCards($resource)
    {
        return $resource->sessionAttendance()
            ->with('session')
            ->orderBy('session_date', 'desc')
            ->get()
            ->map(function ($attendance) {
                return [
                    'type' => 'session',
                    'title' => $attendance->session->SessionTitle ?? 'Unknown Session',
                    'module' => $attendance->session->ModuleCode ?? '',
                    'subtype' => $attendance->session->ClinicalSubType ?? '',
                    'date' => $attendance->session_date->format('Y-m-d H:i'),
                    'session_id' => $attendance->session_id,
                    'bsms_id' => $attendance->bsms_id,
                ];
            })
            ->toArray();
    }

    protected function getLocationSignoffCards($resource)
    {
        return $resource->locationSignoffs()
            ->with('location')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($signoff) {
                return [
                    'type' => 'location',
                    'title' => $signoff->location->name ?? 'Unknown Location',
                    'location_barcode' => $signoff->location_barcode,
                    'date' => $signoff->created_at->format('Y-m-d H:i'),
                    'approver_name' => $signoff->signoff_name,
                    'approver_reg' => $signoff->reg_number_of_approver,
                    'signature_svg' => $signoff->signature_svg,
                    'bsms_id' => $signoff->bsms_id,
                    'postcode' => $signoff->location_postcode,
                ];
            })
            ->toArray();
    }

    protected function getExaminationResultCards($resource)
    {
        return $resource->examinationResults()
            ->with('examination')
            ->orderBy('assessed_at', 'desc')
            ->get()
            ->map(function ($result) {
                return [
                    'type' => 'examination',
                    'title' => $result->examination->examination ?? 'Unknown Examination',
                    'category' => $result->examination->category ?? '',
                    'date' => $result->assessed_at->format('Y-m-d H:i'),
                    'is_competent' => $result->is_competent,
                    'bsms_id' => $result->bsms_id,
                ];
            })
            ->toArray();
    }
}
