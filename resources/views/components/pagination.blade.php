@if($paginator->hasPages())
<div class="card-footer" style="padding: var(--space-4) var(--space-6); border-top: 1px solid var(--border-light);">
    <div class="pagination-wrapper">
        <div class="pagination-info">
            <span class="pagination-text">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} {{ $label ?? 'results' }}
            </span>
        </div>
        <nav aria-label="Page navigation">
            {{ $paginator->links() }}
        </nav>
    </div>
</div>
@endif