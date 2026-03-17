<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Illuminate\Support\Facades\File;

class AdminDocsDisplay extends Partition
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
        // Read the markdown file
        $content = File::get(app_path('nova_access.md'));
        
        // Split into sections for display
        $sections = $this->parseMarkdownSections($content);
        
        // Return as partition data
        return $this->result($sections);
    }

    /**
     * Parse markdown into displayable sections.
     *
     * @param string $markdown
     * @return array
     */
    protected function parseMarkdownSections($markdown)
    {
        $lines = explode("\n", $markdown);
        $sections = [];
        $currentSection = '';
        $sectionContent = '';
        
        foreach ($lines as $line) {
            // Check for H2 headers (sections)
            if (preg_match('/^## (.+)$/', $line, $matches)) {
                // Save previous section
                if ($currentSection) {
                    $sections[$currentSection] = strlen($sectionContent);
                }
                $currentSection = $matches[1];
                $sectionContent = '';
            } else {
                $sectionContent .= $line . "\n";
            }
        }
        
        // Save last section
        if ($currentSection) {
            $sections[$currentSection] = strlen($sectionContent);
        }
        
        // If no sections found, create a simple display
        if (empty($sections)) {
            $sections = [
                'Documentation Available' => 1,
                'See app/nova_access.md' => 1,
            ];
        }
        
        return $sections;
    }

    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return '🧭 Admin Access Control Guide';
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'admin-docs-display';
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
