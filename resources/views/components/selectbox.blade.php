@props([ 
    'type' => 'text',
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '', 
    'items' => [],
    'item_value' => 'id',
    'item_text' => 'name', 
    'searchable' => false,
    'advanced' => false,
])

<div  >
    @if ($label)
        <label class="text-sm font-medium">{{ $label }}</label> 
    @endif 
    @if ($advanced)
        
    <div class="relative" data-selectbox data-searchable="{{$searchable}}">
        
        <input type="hidden" name="{{$name}}" value="{{$value}}" data-input-value />

        <div class="flex items-center w-full px-4 py-3 bg-white border rounded cursor-pointer border-slate-400" data-view-container>
            <div class="flex-1" data-view-text>
                @if ($value == null)
                    <span class="text-rose-500">{{__('dashboard.none')}}</span>
                @endif
                @foreach ($items as $item) 
                    @if ($value == $item->{$item_value})
                        {{ $item->{$item_text} }}
                    @endif
                @endforeach 
            </div>
            <x-icon name="caret-down" class="w-3 text-slate-500" />
        </div>

        <div class="absolute left-[3px] right-[3px] z-10 bg-white border border-slate-400 rounded top-full -m-[3px] hidden" data-option-container>
            @if ($searchable)
            <input type="text" class="w-full px-3 py-2 text-sm border-b focus:outline-none" placeholder="{{__('dashboard.type_here_to_search')}}" data-input-filter>
            @endif
            <div class="hidden p-4 text-xs italic text-rose-500" data-no-result> 
                {{__('dashboard.no_results_for_your_search')}}
            </div>
            <div class="max-h-[200px] overflow-y-auto divide-y divide-slate-100" data-option-list>
                <div 
                    class="px-3 py-2 cursor-pointer text-rose-500 hover:bg-blue-500 hover:text-white"
                    data-value=""
                    data-text="{{__('dashboard.none')}}"
                    data-option-item
                >{{__('dashboard.none')}}</div>
                @foreach ($items as $item)
                    <div 
                        class="px-3 py-2 cursor-pointer hover:bg-blue-500 hover:text-white"
                        data-value="{{$item->$item_value}}"
                        data-text="{{$item->$item_text}}"
                        data-option-item
                    >{{ $item->{$item_text} }}</div>
                @endforeach
            </div>
        </div>
    </div>
    @else
        <select name="{{$name}}" class="block w-full px-4 py-3 h-[50px] bg-white border rounded cursor-pointer border-slate-400"> 
            @foreach ($items as $item)
                <option value="{{$item->$item_value}}" {{$value == $item->$item_value ? 'selected' : ''}}>{{ $item->{$item_text} }}</option>
            @endforeach
        </select>
    @endif
</div>