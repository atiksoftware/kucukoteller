@props(['records'])
<div class="py-4 ">
{{ $records->appends(['search' => request()->get('search')])->links('pagination::tailwind') }}
</div>