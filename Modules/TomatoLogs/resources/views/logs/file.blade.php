<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-logs::global.title')}} [{{ $record->id }}]
    </x-slot:header>

    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-6 sm:px-6">
            <div class="flex justify-between">
                <div class="flex flex-col justify-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-300">
                        {{trans('tomato-logs::global.details')}}
                    </h3>
                </div>
                <div>
                    <Link href="{{url()->previous()}}" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                        {{trans('tomato-logs::global.back')}}
                    </Link>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-200 overflow-x-scroll w-full bg-gray-50 dark:bg-gray-700">
            <dl>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-200">
                        {{trans('tomato-logs::global.date')}}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        {{$record->date}}
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-200">
                        {{trans('tomato-logs::global.environment')}}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        {{$record->environment}}
                    </dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-200">
                        {{trans('tomato-logs::global.level')}}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        @if($record->level === 'error')
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            {{$record->level}}
                        </span>
                        @elseif($record->level === 'debug')
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            {{$record->level}}
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{$record->level}}
                        </span>
                        @endif
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-200">
                        {{trans('tomato-logs::global.message')}}
                    </dt>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 pb-5">
                    <dd class="overflow-x-auto">
                        <pre
                            class="whitespace-pre-wrap">
                            {{$record->context}}
                        </pre>
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-4 pt-5">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-200">
                        {{trans('tomato-logs::global.stack')}}
                    </dt>
                </div>
                <div class="bg-white dark:bg-gray-800 px-4 py-5 w-full">
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 overflow-x-auto">
                        @php $counter = 0; @endphp
                        @foreach($record->stack_traces as $key=>$stackTrace)
                        <div
                            class="border-gray-200 dark:border-gray-600 py-3  border-t">
                            <div class="grid grid-cols-3 w-full py-0.5 px-1 hover:bg-gray-100 dark:hover:bg-gray-600 rounded">
                                <div class="col-span-1 font-bold"> {{trans('tomato-logs::global.caught_at')}}</div>
                                <div class="col-span-2">{{$stackTrace->caught_at}}</div>
                            </div>
                            <div class="grid grid-cols-3 w-full py-0.5 px-1 hover:bg-gray-100  dark:hover:bg-gray-600 rounded">
                                <div class="col-span-1 font-bold">{{trans('tomato-logs::global.in')}}</div>
                                <div class="col-span-2">{{$stackTrace->in}}</div>
                            </div>
                            <div class="grid grid-cols-3 w-full py-0.5 px-1 hover:bg-gray-100 dark:hover:bg-gray-600 rounded">
                                <div class="col-span-1 font-bold">{{trans('tomato-logs::global.line')}}</div>
                                <div class="col-span-2">{{$stackTrace->line}}</div>
                            </div>
                            <div class="grid grid-cols-3 w-full pt-0.5 px-1 hover:bg-gray-100 dark:hover:bg-gray-600 rounded">
                                <div class="col-span-1 font-bold">{{trans('tomato-logs::global.content')}}</div>
                                <div class="col-span-2">{{$stackTrace}}</div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                        @endforeach
                    </dd>
                </div>
            </dl>
        </div>
    </div>


</x-tomato-admin-layout>
