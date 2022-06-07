@extends('dashboard.layout')
  

@section('content')

    <div class="border-b pb-4">
        <div class="md:flex w-full items-center">
            <div class="flex-1">
                <h1 class=" text-2xl font-medium text-center md:text-left">Profil Bilgilerim</h1>
            </div>
            <div class="flex w-full md:w-auto justify-center gap-4">
                <x-button sm >Düzenle</x-button>
                <x-button sm >Düzenle</x-button>
            </div>
        </div>
        <div class="text-sm mt-2">
            Uygulamanızın seçtiğiniz ülkelerdeki tüm kullanıcılara sunulması için üretim sürümleri oluşturup yönetin.
        </div>
    </div>

@endsection
