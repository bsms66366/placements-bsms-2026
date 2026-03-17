<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Illuminate\Support\Facades\File;

class AdminAccessGuide extends Value
{
    /**
     * The width of the card.
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        // Count the number of allowed roles
        $allowedRoles = array_map('trim', explode(',', env('NOVA_ACCESS_ROLES', 'admin')));
        $roleCount = count($allowedRoles);
        
        // Return the count with helpful suffix
        return $this->result($roleCount)
            ->suffix('roles can access Nova: ' . implode(', ', $allowedRoles))
            ->format('0');
    }

    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return '🔐 Nova Access Control';
    }
    
    /**
     * Get the help text for the metric.
     *
     * @return string
     */
    public function helpText()
    {
        return 'Access is controlled via .env NOVA_ACCESS_ROLES. Full docs: app/nova_access.md';
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'admin-access-guide';
    }

    /**
     * Convert markdown to simple HTML for display.
     *
     * @param string $markdown
     * @return string
     */
    protected function convertMarkdownToHtml($markdown)
    {
        $html = '<div style="padding: 20px; line-height: 1.6; color: #374151;">';
        
        $lines = explode("\n", $markdown);
        
        foreach ($lines as $line) {
            $trimmed = trim($line);
            
            // Skip empty lines
            if ($trimmed === '') {
                continue;
            }
            
            // H1
            if (preg_match('/^# (.+)$/', $trimmed, $matches)) {
                $html .= '<h2 style="font-size: 1.5rem; font-weight: bold; margin: 1rem 0; color: #111827;">' . $matches[1] . '</h2>';
            }
            // H2
            elseif (preg_match('/^## (.+)$/', $trimmed, $matches)) {
                $html .= '<h3 style="font-size: 1.25rem; font-weight: 600; margin: 1.5rem 0 0.75rem 0; color: #1f2937;">' . $matches[1] . '</h3>';
            }
            // H3
            elseif (preg_match('/^### (.+)$/', $trimmed, $matches)) {
                $html .= '<h4 style="font-size: 1.1rem; font-weight: 600; margin: 1rem 0 0.5rem 0; color: #374151;">' . $matches[1] . '</h4>';
            }
            // Horizontal rule
            elseif ($trimmed === '---') {
                $html .= '<hr style="margin: 1.5rem 0; border: 0; border-top: 2px solid #e5e7eb;">';
            }
            // Code block start
            elseif (preg_match('/^```/', $trimmed)) {
                $html .= '<pre style="background: #1f2937; color: #10b981; padding: 1rem; border-radius: 0.5rem; margin: 1rem 0; overflow-x: auto;"><code>';
            }
            // Code block end
            elseif ($trimmed === '```') {
                $html .= '</code></pre>';
            }
            // Table separator (skip)
            elseif (preg_match('/^\|[-:\s|]+\|$/', $trimmed)) {
                continue;
            }
            // Table row
            elseif (preg_match('/^\|(.+)\|$/', $trimmed, $matches)) {
                $cells = array_map('trim', explode('|', trim($matches[1], '|')));
                $html .= '<div style="display: flex; border-bottom: 1px solid #e5e7eb; padding: 0.5rem 0;">';
                foreach ($cells as $cell) {
                    // Process inline formatting
                    $cell = $this->processInlineFormatting($cell);
                    $html .= '<div style="flex: 1; padding: 0 0.5rem;">' . $cell . '</div>';
                }
                $html .= '</div>';
            }
            // Regular paragraph
            else {
                $processed = $this->processInlineFormatting($trimmed);
                $html .= '<p style="margin: 0.75rem 0;">' . $processed . '</p>';
            }
        }
        
        $html .= '</div>';
        
        return $html;
    }

    /**
     * Process inline formatting (bold, code, etc.)
     *
     * @param string $text
     * @return string
     */
    protected function processInlineFormatting($text)
    {
        // Bold
        $text = preg_replace('/\*\*(.+?)\*\*/', '<strong style="font-weight: 600; color: #111827;">$1</strong>', $text);
        
        // Inline code
        $text = preg_replace('/`([^`]+)`/', '<code style="background: #f3f4f6; color: #dc2626; padding: 0.125rem 0.375rem; border-radius: 0.25rem; font-family: monospace; font-size: 0.875rem;">$1</code>', $text);
        
        return $text;
    }

    /**
     * Determine if the metric should be shown only to admins.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function canSee($request)
    {
        // Only show to users with 'admin' role
        return optional($request->user()?->role)->name === 'admin';
    }
}
