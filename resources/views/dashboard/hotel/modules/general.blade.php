<div class="grid grid-cols-12 gap-4 mt-8"> 

    <div class="col-span-12 sm:col-span-6 lg:col-span-3 ">
        <x-textbox name="email" :label="__('dashboard.email')" :placeholder="__('dashboard.email_placeholder')" :value="Request::old('email') ?? $hotel->email" />
        <x-checkbox name="email_viewable" :value="$hotel->email_viewable" :label="__('dashboard.viewable')" class="mt-2"/>
    </div> 
    <div class="col-span-12 sm:col-span-6 lg:col-span-3 ">
        <x-textbox name="phone" :label="__('dashboard.phone')" :placeholder="__('dashboard.phone_placeholder')" :value="Request::old('phone') ?? $hotel->phone" />
        <x-checkbox name="phone_viewable" :value="$hotel->phone_viewable" :label="__('dashboard.viewable')" class="mt-2"/>
    </div> 
 
    <div class="col-span-12 sm:col-span-6 lg:col-span-3 ">
        <x-textbox name="whatsapp" :label="__('dashboard.whatsapp')" :placeholder="__('dashboard.whatsapp_placeholder')" :value="Request::old('whatsapp') ?? $hotel->whatsapp" />
        <x-checkbox name="whatsapp_viewable" :value="$hotel->whatsapp_viewable" :label="__('dashboard.viewable')" class="mt-2"/>
    </div> 
    <div class="col-span-12 sm:col-span-6 lg:col-span-3 ">
        <x-textbox name="website" :label="__('dashboard.website')" :placeholder="__('dashboard.website_placeholder')" :value="Request::old('website') ?? $hotel->website" />
        <x-checkbox name="website_viewable" :value="$hotel->website_viewable" :label="__('dashboard.viewable')" class="mt-2"/>
    </div> 
 
</div>

<div class="mt-8 -mx-4 border-2 border-dashed"></div>

<div class="grid grid-cols-12 gap-4 mt-8">   
    <div class="col-span-12 sm:col-span-6 lg:col-span-3 ">
        <x-textbox name="contact_person_name" :label="__('dashboard.contact_person_name')" :value="Request::old('contact_person_name') ?? $hotel->contact_person_name" />
    </div> 
    <div class="col-span-12 sm:col-span-6 lg:col-span-3 ">
        <x-textbox name="unit_count" :label="__('dashboard.unit_count')" :value="Request::old('unit_count') ?? $hotel->unit_count" type="number" />
    </div>   
</div>

<div class="mt-8 -mx-4 border-2 border-dashed"></div>

<div class="grid grid-cols-12 gap-4 mt-8">  
    <div class="col-span-12">
        <x-textbox name="address" :label="__('dashboard.facility_address')" :value="Request::old('address') ?? $hotel->address" />
    </div>  
</div>

<div class="mt-8 -mx-4 border-2 border-dashed"></div>

<div class="grid grid-cols-1 gap-4 mt-8">  
    <div >
        <x-textbox name="how_is_there_like" :label="__('dashboard.how_is_there_like')" :value="Request::old('how_is_there_like') ?? $hotel->how_is_there_like" />
    </div>  
</div>

<div class="mt-8 -mx-4 border-2 border-dashed"></div>

<div class="grid grid-cols-1 gap-4 mt-8">  
    <div>
        <div class="text-lg font-medium ">Çevre mesafe bilgisi</div>
        <div class="text-sm text-slate-500"><b>Merkeze mesafe kısmı:</b> Otel panelinde göreceğiniz bu özellik ile insanlar merkeze (Örneğin: Cunda Adası’nda iseniz, merkeze ana caddeye) uzaklığınızı belirtebilecek, konukların belde ve otel sayfasında bilgi almasında ve otel seçimlerinde etkili olabileceksiniz.</div>
    </div>
    
    <div class="grid grid-cols-2 gap-2 p-2 border border-blue-400 border-dashed rounded lg:flex bg-blue-50" >
        <div class="col-span-2 lg:w-72">
            <x-selectbox :label="__('dashboard.is_there_a_sea')" :items="\App\Constants\HotelDistances::seaExistsOptions()" item_value="value" item_text="text" />
        </div>
        <div class="col-span-2 lg:flex-1">
            <x-textbox name="sea_name" :label="__('dashboard.sea_name')" :value="Request::old('sea_name') ?? $hotel->sea_name" />
        </div> 
        <div class="lg:w-32 ">
            <x-textbox name="sea_distance" :label="__('dashboard.distance')" :value="Request::old('sea_distance') ?? $hotel->sea_distance" type="number" />
        </div>
        <div class="lg:w-40 "> 
            <x-selectbox :label="__('dashboard.distance_unit')" :items="\App\Constants\HotelDistances::distanceUnitOptions()" item_value="value" item_text="text" />
        </div>
    </div>  

    <div class="grid grid-cols-2 gap-2 p-2 border border-blue-400 border-dashed rounded lg:flex bg-blue-50" >
        <div class="col-span-2 lg:w-72">
            <x-selectbox :label="__('dashboard.is_there_a_airport')" :items="\App\Constants\HotelDistances::airportExistsOptions()" item_value="value" item_text="text" />
        </div>
        <div class="col-span-2 lg:flex-1">
            <x-textbox name="airport_name" :label="__('dashboard.airport_name')" :value="Request::old('airport_name') ?? $hotel->airport_name" />
        </div> 
        <div class="lg:w-32 ">
            <x-textbox name="airport_distance" :label="__('dashboard.distance')" :value="Request::old('airport_distance') ?? $hotel->airport_distance" type="number" />
        </div>
        <div class="lg:w-40 "> 
            <x-selectbox :label="__('dashboard.distance_unit')" :items="\App\Constants\HotelDistances::distanceUnitOptions()" item_value="value" item_text="text" />
        </div>
    </div>  

    <div class="grid grid-cols-2 gap-2 p-2 border border-blue-400 border-dashed rounded lg:flex bg-blue-50" >
        <div class="col-span-2 lg:w-72">
            <x-selectbox :label="__('dashboard.is_there_a_citycenter')" :items="\App\Constants\HotelDistances::citycenterExistsOptions()" item_value="value" item_text="text" />
        </div>
        <div class="col-span-2 lg:flex-1">
            <x-textbox name="citycenter_name" :label="__('dashboard.citycenter_name')" :value="Request::old('citycenter_name') ?? $hotel->citycenter_name" />
        </div> 
        <div class="lg:w-32 ">
            <x-textbox name="citycenter_distance" :label="__('dashboard.distance')" :value="Request::old('citycenter_distance') ?? $hotel->citycenter_distance" type="number" />
        </div>
        <div class="lg:w-40 "> 
            <x-selectbox :label="__('dashboard.distance_unit')" :items="\App\Constants\HotelDistances::distanceUnitOptions()" item_value="value" item_text="text" />
        </div>
    </div>   
</div>