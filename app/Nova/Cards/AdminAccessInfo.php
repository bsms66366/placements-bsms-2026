<?php

namespace App\Nova\Cards;

use Laravel\Nova\Card;
use Illuminate\Support\Facades\File;

class AdminAccessInfo extends Card
{
    /**
     * The width of the card (1/3, 1/2, 2/3, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'custom-card';
    }

    /**
     * Prepare the card for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        $markdownContent = File::get(app_path('nova_access.md'));
        
        return array_merge(parent::jsonSerialize(), [
            'title' => '🧭 Admin Access Control Guide',
            'markdown' => $markdownContent,
        ]);
    }

    /**
     * Convert markdown to HTML for display.
     *
     * @param string $markdown
     * @return string
     */
    protected function convertMarkdownToHtml($markdown)
    {
        // Simple markdown to HTML conversion
        $html = $markdown;
        
        // Headers
        $html = preg_replace('/^# (.+)$/m', '<h2 class="text-2xl font-bold mb-4 text-gray-900">$1</h2>', $html);
        $html = preg_replace('/^## (.+)$/m', '<h3 class="text-xl font-semibold mt-6 mb-3 text-gray-800">$1</h3>', $html);
        $html = preg_replace('/^### (.+)$/m', '<h4 class="text-lg font-semibold mb-2 text-gray-700">$1</h4>', $html);
        
        // Bold
        $html = preg_replace('/\*\*(.+?)\*\*/s', '<strong class="font-semibold text-gray-900">$1</strong>', $html);
        
        // Code blocks
        $html = preg_replace('/```(\w+)?\n(.*?)\n```/s', '<pre class="bg-gray-900 text-green-400 p-4 rounded-lg mb-4 overflow-x-auto text-sm"><code>$2</code></pre>', $html);
        
        // Inline code
        $html = preg_replace('/`([^`]+)`/', '<code class="bg-gray-200 text-red-600 px-2 py-1 rounded text-sm font-mono">$1</code>', $html);
        
        // Horizontal rules
        $html = preg_replace('/^---$/m', '<hr class="my-6 border-t-2 border-gray-300">', $html);
        
        // Tables (basic support)
        $html = preg_replace_callback('/\|(.+)\|\n\|[-:\s|]+\|\n((?:\|.+\|\n?)+)/m', function($matches) {
            $header = $matches[1];
            $rows = $matches[2];
            
            $headerCells = array_map('trim', explode('|', trim($header, '|')));
            $headerHtml = '<thead class="bg-gray-50"><tr>';
            foreach ($headerCells as $cell) {
                $headerHtml .= '<th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700">' . trim($cell) . '</th>';
            }
            $headerHtml .= '</tr></thead>';
            
            $bodyHtml = '<tbody class="bg-white">';
            $rowLines = array_filter(explode("\n", $rows));
            foreach ($rowLines as $row) {
                $cells = array_map('trim', explode('|', trim($row, '|')));
                $bodyHtml .= '<tr class="hover:bg-gray-50">';
                foreach ($cells as $cell) {
                    $bodyHtml .= '<td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">' . trim($cell) . '</td>';
                }
                $bodyHtml .= '</tr>';
            }
            $bodyHtml .= '</tbody>';
            
            return '<table class="min-w-full border border-gray-300 rounded-lg mb-6 overflow-hidden">' . $headerHtml . $bodyHtml . '</table>';
        }, $html);
        
        // Paragraphs - wrap lines that aren't already HTML
        $lines = explode("\n", $html);
        $processedLines = [];
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '') {
                $processedLines[] = '';
            } elseif (!preg_match('/^<[h|p|t|u|d|c|s|hr]/', $trimmed)) {
                $processedLines[] = '<p class="mb-3 text-gray-700 leading-relaxed">' . $trimmed . '</p>';
            } else {
                $processedLines[] = $line;
            }
        }
        $html = implode("\n", $processedLines);
        
        return $html;
    }

    /**
     * Determine if the card should be shown only to admins.
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
