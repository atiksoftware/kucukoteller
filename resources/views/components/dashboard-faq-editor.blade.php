@props([
    'faqs' => [],
])
@php
$column_class = 'md:grid-cols-2';
switch (\App\Helpers\LocaleHelper::getLocaleCount()) {
    case 1:
        $column_class = 'md:grid-cols-1';
        break; 
    case 2:
        $column_class = 'md:grid-cols-2';
        break; 
    case 3:
        $column_class = 'md:grid-cols-3';
        break; 
    case 4:
        $column_class = 'md:grid-cols-4';
        break; 
} 
@endphp
<div class="text-sm italic text-slate-400">
    {{__('dashboard.faq_editor_loading')}}
</div>
<div class="space-y-8 " data-faq-editor data-faqs="{{$faqs}}" data-locale-codes="{{json_encode(\App\Helpers\LocaleHelper::getLocaleCodes())}}" data-locale-names="{{json_encode(\App\Helpers\LocaleHelper::getLocaleNames())}}">
    <div class="hidden border border-blue-400 border-dashed rounded bg-blue-50" data-faq >
        <div class="grid flex-1 md:divide-x divide-dashed divide-blue-400 rounded {{$column_class}} ">
            @foreach (\App\Helpers\LocaleHelper::getLocaleCodes() as $code)
            <div class="p-2" data-locale-code="{{$code}}" data-locale-name="{{\App\Helpers\LocaleHelper::getLocaleName($code)}}"> 
                <input type="text" data-question placeholder="{{__('dashboard.faq_question_placeholder',['locale_name' => \App\Helpers\LocaleHelper::getLocaleName($code)])}}" class="block w-full px-3 py-2 text-sm bg-white border border-b-0 rounded-t border-slate-400 focus:outline-primarydark">
                <input type="text" data-answer placeholder="{{__('dashboard.faq_answer_placeholder',['locale_name' => \App\Helpers\LocaleHelper::getLocaleName($code)])}}" class="block w-full px-3 py-2 text-sm bg-white border rounded-b border-slate-400 focus:outline-primarydark">
            </div>
            @endforeach 
        </div>
        <div class="flex flex-col justify-between py-2 pr-2">
            <div sortable-handler class="flex items-center justify-center w-8 h-8 rounded cursor-move bg-slate-100 hover:bg-slate-200">
                <x-icon name="arrow-up-down" class="w-4 text-slate-500" />
            </div>
            <div remove-handler class="flex items-center justify-center w-8 h-8 rounded cursor-pointer bg-slate-100 hover:bg-slate-200">
                <x-icon name="xmark" class="w-4 text-red-500" />
            </div>
        </div>
    </div>
</div>

<div class="justify-center hidden w-full mt-8">
    <x-button >{{__('dashboard.add_new_question')}}</x-button>
</div>