<div class="">
    <div>
        <div class="flex max-sm:flex-wrap gap-8 w-full items-end">
            @include('parts.form.input', [
                'title' => 'Search',
                'model' => 'searchText',
                'small' => true
            ])


            <div class="flex max-sm:flex-wrap items-center gap-4">
                <div class="flex max-sm:justify-between max-sm:w-full items-center gap-4">
                    <span class="max-sm:ml-3 font-bold">From</span>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="startAt" autocomplete="off" datepicker-format="dd-mm-yyyy" datepicker id="datepicker-start" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                </div>

                <div class="flex max-sm:justify-between max-sm:w-full items-center gap-4">
                    <span class="max-sm:ml-3 font-bold">To</span>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="endAt" autocomplete="off" datepicker-format="dd-mm-yyyy" datepicker id="datepicker-end" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                </div>
                <div class="sm:ml-6 max-sm:mx-auto">
                    @include('parts.form.select', [
                        'model' => 'selectedLevel',
                        'options' => \Monolog\Level::cases(),
                        'value' => 'value',
                        'name' => 'name',
                        'placeholder' => 'Обрати рівень',
                        'showPlaceholder' => true,
                        'class' => 'font-mono font-bold tracking-wider min-w-full sm:min-w-min min-h-[42px] h-[42px]',
                        'classLabel' => 'min-w-full sm:!max-w-[238px] sm:min-w-min'
                    ])
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table min-w-[500px]">
            <!-- head -->
            <thead>
            <tr>
                <th>Level</th>
                <th>Message</th>
                <th>Context</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td class="font-semibold text-sm text-{{ trans('enums.debug_colors.'.\Monolog\Level::fromValue($log->level)->getName()) }}">{{ \Monolog\Level::fromValue($log->level)->getName() }}</td>
                        <td>{{ $log->message }}</td>
                        <td>
                            <div class="max-w-[300px] text-wrap break-words">
                                {{ json_encode($log->context) }}
                            </div>
                        </td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $logs->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const datepicker = new Datepicker(document.getElementById('datepicker-start'), {
            format: 'mm/dd/yyyy',
            autohide: true,
            todayHighlight: true
        });

        const datepickerEnd = new Datepicker(document.getElementById('datepicker-end'), {
            format: 'mm/dd/yyyy',
            autohide: true,
            todayHighlight: true
        });

        // Слухаємо подію зміни дати і передаємо її в Livewire
        document.getElementById('datepicker-start').addEventListener('changeDate', function (event) {
        @this.set('startAt', event.target.value); // або event.detail.date в залежності від версії
        });

        document.getElementById('datepicker-end').addEventListener('changeDate', function (event) {
        @this.set('endAt', event.target.value); // або event.detail.date в залежності від версії
        });
    });
</script>
