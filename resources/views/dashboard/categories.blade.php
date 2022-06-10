@extends('dashboard.layout.layout')
  

@section('content')

    <x-dashboard-header>
        <x-slot name="title">
            Categories
        </x-slot>
        <x-slot name="actions">
            <x-button sm >Yeni Ekle</x-button>
        </x-slot>
        <x-slot name="description">
            Manage your categories.
        </x-slot>
    </x-dashboard-header>


    <table class="w-full">
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>
                        {{ $record->title }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
