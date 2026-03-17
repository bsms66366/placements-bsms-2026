<template>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ card.title }}</h2>
        <div class="prose prose-sm max-w-none" v-html="renderedMarkdown"></div>
    </div>
</template>

<script>
export default {
    props: ['card'],
    
    computed: {
        renderedMarkdown() {
            let html = this.card.markdown || '';
            
            // Headers
            html = html.replace(/^# (.+)$/gm, '<h2 class="text-2xl font-bold mt-6 mb-4">$1</h2>');
            html = html.replace(/^## (.+)$/gm, '<h3 class="text-xl font-semibold mt-5 mb-3">$1</h3>');
            html = html.replace(/^### (.+)$/gm, '<h4 class="text-lg font-semibold mt-4 mb-2">$1</h4>');
            
            // Bold
            html = html.replace(/\*\*(.+?)\*\*/g, '<strong class="font-semibold">$1</strong>');
            
            // Inline code
            html = html.replace(/`([^`]+)`/g, '<code class="bg-gray-100 text-red-600 px-2 py-0.5 rounded text-sm font-mono">$1</code>');
            
            // Horizontal rules
            html = html.replace(/^---$/gm, '<hr class="my-6 border-gray-300">');
            
            // Code blocks
            html = html.replace(/```(\w+)?\n([\s\S]*?)\n```/g, '<pre class="bg-gray-900 text-green-400 p-4 rounded-lg my-4 overflow-x-auto"><code>$2</code></pre>');
            
            // Tables - convert to HTML table
            html = html.replace(/\|(.+)\|\n\|[-:\s|]+\|\n((?:\|.+\|\n?)+)/gm, (match, header, rows) => {
                const headerCells = header.split('|').map(c => c.trim()).filter(c => c);
                const rowLines = rows.trim().split('\n');
                
                let table = '<table class="min-w-full border border-gray-300 my-4"><thead class="bg-gray-50"><tr>';
                headerCells.forEach(cell => {
                    table += `<th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">${cell}</th>`;
                });
                table += '</tr></thead><tbody>';
                
                rowLines.forEach(row => {
                    const cells = row.split('|').map(c => c.trim()).filter(c => c);
                    table += '<tr>';
                    cells.forEach(cell => {
                        // Process inline formatting in cells
                        let processedCell = cell.replace(/`([^`]+)`/g, '<code class="bg-gray-100 text-red-600 px-1 py-0.5 rounded text-xs font-mono">$1</code>');
                        table += `<td class="border border-gray-300 px-4 py-2 text-sm">${processedCell}</td>`;
                    });
                    table += '</tr>';
                });
                
                table += '</tbody></table>';
                return table;
            });
            
            // Paragraphs
            const lines = html.split('\n');
            const processed = lines.map(line => {
                const trimmed = line.trim();
                if (!trimmed || trimmed.startsWith('<')) {
                    return line;
                }
                return `<p class="mb-3">${line}</p>`;
            });
            
            return processed.join('\n');
        }
    }
}
</script>

<style scoped>
.prose {
    color: #374151;
    line-height: 1.6;
}

.prose h2:first-child,
.prose h3:first-child {
    margin-top: 0;
}

.prose code {
    font-size: 0.875em;
}

.prose pre {
    font-size: 0.875rem;
    line-height: 1.5;
}

.prose table {
    border-collapse: collapse;
}
</style>
