<div class="grid grid-cols-12 gap-4 mt-8"> 
    <div class="col-span-12 md:col-span-6 ">
        <x-textbox name="name" :label="__('dashboard.name')" :placeholder="__('dashboard.name_placeholder')" :value="Request::old('name') ?? $hotel->name" />
    </div> 
    <div class="col-span-12 md:col-span-6 ">
        <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="Request::old('slug') ?? $hotel->slug" />
    </div> 
    <div class="col-span-12 ">
        <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="Request::old('content') ?? $hotel->content" />
    </div>
    <div class="col-span-12 ">
        <x-dashboard-meta-title-description :object="$hotel" />
    </div> 
</div>