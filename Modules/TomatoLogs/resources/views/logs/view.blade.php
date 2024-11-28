<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-logs::global.title')}} [{{ $record->name }}]
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button href="{{route('admin.logs.index')}}">
            {{__('Back')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <x-tomato-admin-button success type="icon" title="{{trans('tomato-logs::global.open')}}" href="/admin/logs/file/{{ $item->id }}">
                        <x-heroicon-s-eye class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>

</x-tomato-admin-layout>
