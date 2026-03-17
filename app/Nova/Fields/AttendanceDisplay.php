<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class AttendanceDisplay extends Field
{
    public $component = 'textarea-field';
    
    public $showOnIndex = false;
    public $showOnCreation = false;
    public $showOnUpdate = false;

    public function __construct($name, $type = 'all')
    {
        parent::__construct($name, null, null);
        
        $this->withMeta([
            'asHtml' => true,
            'type' => $type,
        ]);
    }

    public function resolve($resource, $attribute = null)
    {
        $type = $this->meta['type'] ?? 'all';
        
        $html = '<div style="margin: 20px 0;">';
        
        if ($type === 'all' || $type === 'sessions') {
            $html .= $this->renderSessionAttendance($resource);
        }
        
        if ($type === 'all' || $type === 'locations') {
            $html .= $this->renderLocationSignoffs($resource);
        }
        
        if ($type === 'all' || $type === 'examinations') {
            $html .= $this->renderExaminationResults($resource);
        }
        
        $html .= '</div>';
        
        $this->value = $html;
    }

    protected function renderSessionAttendance($resource)
    {
        $sessions = $resource->sessionAttendance()
            ->with('session')
            ->orderBy('session_date', 'desc')
            ->get();

        if ($sessions->isEmpty()) {
            return '<p style="color: #999; font-style: italic;">No session attendance records found.</p>';
        }

        $html = '<h3 style="margin-top: 20px; margin-bottom: 15px; color: #005e7e; font-size: 18px; font-weight: 600;">Session Attendance (' . $sessions->count() . ' sessions attended)</h3>';
        $html .= '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; margin-bottom: 30px;">';
        
        foreach ($sessions as $attendance) {
            $session = $attendance->session;
            $html .= '<div style="background: #005e7e; color: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">';
            $html .= '<div style="font-weight: bold; font-size: 14px; margin-bottom: 8px;">' . e($session->SessionTitle ?? 'Unknown Session') . '</div>';
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Module:</strong> ' . e($session->ModuleCode ?? 'N/A') . '</div>';
            
            if ($session->ClinicalSubType) {
                $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Type:</strong> ' . e($session->ClinicalSubType) . '</div>';
            }
            
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Session ID:</strong> ' . e($attendance->session_id) . '</div>';
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>BSMS ID:</strong> ' . e($attendance->bsms_id) . '</div>';
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(255,255,255,0.3);">📅 ' . $attendance->session_date->format('d M Y, H:i') . '</div>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        return $html;
    }

    protected function renderLocationSignoffs($resource)
    {
        $signoffs = $resource->locationSignoffs()
            ->with('location')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($signoffs->isEmpty()) {
            return '<p style="color: #999; font-style: italic;">No location signoff records found.</p>';
        }

        $html = '<h3 style="margin-top: 20px; margin-bottom: 15px; color: #005e7e; font-size: 18px; font-weight: 600;">Placement Location Signoffs (' . $signoffs->count() . ' locations)</h3>';
        $html .= '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; margin-bottom: 30px;">';
        
        foreach ($signoffs as $signoff) {
            $html .= '<div style="background: #005e7e; color: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">';
            $html .= '<div style="font-weight: bold; font-size: 14px; margin-bottom: 8px;">' . e($signoff->location->name ?? 'Unknown Location') . '</div>';
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Barcode:</strong> ' . e($signoff->location_barcode) . '</div>';
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>BSMS ID:</strong> ' . e($signoff->bsms_id) . '</div>';
            
            if ($signoff->signoff_name) {
                $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Approver:</strong> ' . e($signoff->signoff_name) . '</div>';
            }
            
            if ($signoff->reg_number_of_approver) {
                $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Reg #:</strong> ' . e($signoff->reg_number_of_approver) . '</div>';
            }
            
            if ($signoff->location_postcode) {
                $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Postcode:</strong> ' . e($signoff->location_postcode) . '</div>';
            }
            
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(255,255,255,0.3);">📅 ' . $signoff->created_at->format('d M Y, H:i') . '</div>';
            
            if ($signoff->signature_svg) {
                $html .= '<div style="background: white; border-radius: 4px; padding: 10px; margin-top: 10px; min-height: 60px;">';
                $html .= '<svg width="100%" height="80" viewBox="0 0 300 100" style="border: 1px solid #ddd; border-radius: 4px;">';
                $html .= '<path d="' . e($signoff->signature_svg) . '" stroke="#000" stroke-width="2" fill="none" />';
                $html .= '</svg>';
                $html .= '</div>';
            }
            
            $html .= '</div>';
        }
        
        $html .= '</div>';
        return $html;
    }

    protected function renderExaminationResults($resource)
    {
        $results = $resource->examinationResults()
            ->with('examination')
            ->orderBy('assessed_at', 'desc')
            ->get();

        if ($results->isEmpty()) {
            return '<p style="color: #999; font-style: italic;">No examination results found.</p>';
        }

        $competentCount = $results->where('is_competent', true)->count();
        $notCompetentCount = $results->where('is_competent', false)->count();

        $html = '<h3 style="margin-top: 20px; margin-bottom: 15px; color: #005e7e; font-size: 18px; font-weight: 600;">Examination Results (' . $results->count() . ' total)</h3>';
        $html .= '<div style="display: flex; gap: 15px; margin-bottom: 15px;">';
        $html .= '<div style="background: #10b981; color: white; padding: 10px 20px; border-radius: 6px; font-weight: 600;">✓ Competent: ' . $competentCount . '</div>';
        $html .= '<div style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 6px; font-weight: 600;">✗ Not Yet: ' . $notCompetentCount . '</div>';
        $html .= '</div>';
        
        $html .= '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; margin-bottom: 30px;">';
        
        foreach ($results as $result) {
            $bgColor = $result->is_competent ? '#10b981' : '#6b7280';
            $statusText = $result->is_competent ? '✓ Competent' : '✗ Not Yet';
            
            $html .= '<div style="background: ' . $bgColor . '; color: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">';
            $html .= '<div style="font-weight: bold; font-size: 14px; margin-bottom: 8px;">' . e($result->examination->examination ?? 'Unknown Examination') . '</div>';
            
            if ($result->examination->category) {
                $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>Category:</strong> ' . e($result->examination->category) . '</div>';
            }
            
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-bottom: 4px;"><strong>BSMS ID:</strong> ' . e($result->bsms_id) . '</div>';
            $html .= '<div style="font-size: 13px; font-weight: 600; margin-top: 8px; padding: 6px 10px; background: rgba(255,255,255,0.2); border-radius: 4px; text-align: center;">' . $statusText . '</div>';
            $html .= '<div style="font-size: 12px; opacity: 0.9; margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(255,255,255,0.3);">📅 ' . $result->assessed_at->format('d M Y, H:i') . '</div>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        return $html;
    }
}
