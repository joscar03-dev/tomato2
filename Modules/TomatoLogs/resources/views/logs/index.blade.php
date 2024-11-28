<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-logs::global.title')}}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-logout />
    </x-slot:buttons>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-logs::global.open')}}" :href="route('admin.logs.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button
                            danger
                            type="icon"
                            :href="route('admin.logs.destroy', $item->id)"
                            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                            class="px-2 text-red-500"
                            method="delete"
                            title="{{trans('tomato-admin::global.crud.delete')}}"
                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
