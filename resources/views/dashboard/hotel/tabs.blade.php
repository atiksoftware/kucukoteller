<div class="flex -mx-4 overflow-x-hidden text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <div class="flex items-center justify-center w-8 text-gray-500 rounded cursor-pointer hover:text-black">
        <x-icon name="chevron-left" class="w-2 " />
    </div>
    <div class="flex-1 swiper " data-tabs>
        <div class="flex swiper-wrapper">
        @foreach (\App\Constants\HotelTabs::tabs($hotel) as $i => $tab)
        <div 
            class="!w-auto swiper-slide" 
            data-tab-index="{{$i}}" 
            data-tab-key="{{$tab['key']}}"
            @if ($tab['key'] == $module_name) active-tab @endif
        > 
            <a  
            href="{{$tab['link']}}" 
            class="
                block p-4 border-b-2 border-transparent 
                @if (  $tab['key'] == $module_name)
                border-blue-600 text-blue-600
                @else
                hover:text-gray-600 hover:border-gray-300 
                @endif
            ">
                {{$tab['label']}}
            </a>
        </div> 
        @endforeach
        </div>
    </div>
    <div class="flex items-center justify-center w-8 text-gray-500 rounded cursor-pointer hover:text-black">
        <x-icon name="chevron-right" class="w-2 " />
    </div>
</div>