@extends('dashboard.layout.layout')
   
@section('title',__('dashboard.zone_edit_title'))

@section('content')

<form action="{{route('dashboard.zone.update',$zone)}}" method="POST">
    @csrf
    
    <x-dashboard-header>
        <x-slot name="title">{{__('dashboard.zone_edit_title')}}</x-slot>
        <x-slot name="actions" >
            <x-button :href="route('dashboard.zone.remove',$zone)" sm color="rose" text >{{__('dashboard.remove_this_content')}}</x-button>
            <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
        </x-slot>
        <x-slot name="description">{{__('dashboard.zone_edit_description')}}</x-slot>
    </x-dashboard-header>
 
    <x-dashboard-errors :errors="$errors"></x-dashboard-errors>

    <div class="grid grid-cols-12 gap-4 mt-8"> 
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="name" :label="__('dashboard.name')" :placeholder="__('dashboard.name_placeholder')" :value="Request::old('name') ?? $zone->name" />
        </div>
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="title" :label="__('dashboard.title')" :placeholder="__('dashboard.title_placeholder')" :value="Request::old('title') ?? $zone->title" />
        </div>
        <div class="col-span-12 md:col-span-4 ">
            <x-textbox name="slug" :label="__('dashboard.slug')" :placeholder="__('dashboard.slug_placeholder')" :value="Request::old('slug') ?? $zone->slug" />
        </div>

        <div class="col-span-12 md:max-w-xs">
            <x-selectbox name="parent_id" :label="__('dashboard.parent')" :placeholder="__('dashboard.parent_placeholder')" 
                :value="Request::old('parent_id') ?? $zone->parent_id" 
                :items="$zones"
                item_value="id"
                item_text="name" 
                searchable
            />
        </div> 

        <div class="col-span-12 ">
            <x-textarea name="brief" :label="__('dashboard.brief')" :placeholder="__('dashboard.brief_placeholder')" :value="Request::old('brief') ?? $zone->brief" />
        </div>
        <div class="col-span-12 ">
            <x-textarea name="content" :label="__('dashboard.content')" :placeholder="__('dashboard.content_placeholder')" :value="Request::old('content') ?? $zone->content" />
        </div>
        <div class="col-span-12 ">
            <x-dashboard-meta-title-description :object="$zone" />
        </div> 
    </div>
    
    <div class="grid w-full grid-cols-2 mt-8 md:hidden">
        <x-button :href="route('dashboard.zone.remove',$zone)" sm color="rose" text >{{__('dashboard.remove_this_content')}}</x-button>
        <x-button submit sm >{{__('dashboard.save_changes')}}</x-button>
    </div>

    <div class="mt-8 -mx-4 border-2 border-dashed"></div>

    <div class="mt-8 ">
        <div class="text-sm font-medium">{!!__('dashboard.zone_proposal_list',[
            'zone_name' => $zone->name,
        ])!!}</div>
        <table class="w-full mt-2 overflow-hidden rounded bg-amber-100/75"> 
            <tbody class="divide-y divide-amber-400 divide-dashed"> 
                @foreach ($zone->proposals as $proposal)
                    <tr class="hover:bg-amber-100 hover:text-rose-500">
                        <td class="text-sm italic font-medium ">
                            <a href="{{route('dashboard.zone.proposal.edit',$proposal)}}" class="block px-4 py-2">{{__('dashboard.proposal_type.' . $proposal->type->name)}} </a> 
                        </td>
                        <td class="">
                            <a href="{{route('dashboard.zone.proposal.edit',$proposal)}}" class="block px-4 py-2 ">{{$proposal->title}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 -mx-4 border-2 border-dashed"></div>
    
    <div class="mt-8 ">
        <div class="text-sm font-medium">{!!__('dashboard.zone_faq_list',[
            'zone_name' => $zone->name,
        ])!!}</div>
        @if ($zone->faqs->count() > 0)
        <div class="py-4 text-sm italic text-blue-500">
            <span class="block p-4 border border-blue-500 border-dashed rounded bg-blue-50">{!!__('dashboard.zone_faq_count',[
                'count' => $zone->faqs->count()
            ])!!}</span> 
        </div>
        @else 
        <div class="py-4 text-sm italic text-rose-500">
            <span class="block p-4 border border-dashed rounded border-rose-500 bg-rose-50">{{__('dashboard.zone_no_faq_found')}}</span> 
        </div>
        @endif
        <div>
            <x-button :href="route('dashboard.zone.faq.edit',$zone)" sm color="slate"   >{!!__('dashboard.zone_goto_faq_list_edit_page')!!}</x-button>
        </div> 
        
    </div>

</form>

@endsection
