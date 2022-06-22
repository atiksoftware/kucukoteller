@extends('dashboard.layout.layout')

@section('title',__('dashboard.remove_title'))

@section('content')
<form action="{{$confirm_url}}" method="post">
    @csrf
    <div class="max-w-full mx-auto w-[400px]">
        <div class="flex flex-col py-8 lg:py-12 ">
            <div class="flex flex-col items-center text-center">
                <div class="inline-block p-4 rounded-full bg-rose-50">
                    <x-icon name="alert-octagram-outline" class="w-12 h-12 text-rose-500" />
                </div>
                <h2 class="mt-2 font-semibold text-gray-800">{{__('dashboard.remove_title')}}</h2>
                <p class="mt-2 text-sm leading-relaxed text-gray-600">
                    {!!__('dashboard.remove_description',[
                    'name' => $name,
                    ])!!}
                </p>
            </div>

            <div class="flex items-center gap-4 mx-auto mt-3">

                <x-button :href="$cancel_url" color="slate" medium>{{__('dashboard.remove_cancel')}}</x-button>
                
                <x-button submit color="rose" medium>{{__('dashboard.remove_confirm')}}</x-button>

            </div>
        </div>
    </div>
</form>
@endsection
