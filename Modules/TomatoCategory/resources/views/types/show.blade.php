<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Type') }} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('For')" :value="$model->for" type="text" />
        <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="text" />
        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="text" />
        <x-tomato-admin-row :label="__('Key')" :value="$model->key" type="text" />
        <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="text" />
        <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />
        <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />
        <x-tomato-admin-row :label="__('Image')" :value="$model->getMedia('image')?->first()?->getUrl()" type="image" />
    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning :href="route('admin.types.edit', $model->id)">
            {{__('Edit')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button
            danger
            :href="route('admin.types.destroy', $model->id)"
            title="{{trans('tomato-admin::global.crud.edit')}}"
            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
            class="px-2 text-red-500"
            method="delete"
        >
            {{__('Delete')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button secondary :href="route('admin.types.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
