<div class="">
    <div class="overflow-x-auto bg-white rounded-lg ">
        <table id="myTable" class="w-full table-auto">
            <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                @foreach($columns as $column)
{{--                    @if(($column['label']) === 'عملیات')--}}
{{--                        <th class="py-3 px-6 text-center {{ $column['class'] ?? '' }}">--}}
{{--                            {{ $column['label'] }}--}}
{{--                        </th>--}}
{{--                    @else--}}
{{--                        <th class="py-3 px-6 text-right {{ $column['class'] ?? '' }}">--}}
{{--                            {{ $column['label'] }}--}}
{{--                        </th>--}}
{{--                    @endif--}}
                        <th class="py-3 px-6 text-center {{ $column['class'] ?? '' }}">
                            {{ $column['label'] }}
                        </th>
                @endforeach
            </tr>
            </thead>

{{--            Body--}}
            <tbody class="text-gray-600 text-sm">
            @foreach($rows as $row)
                <tr class="{{ isset($rowClass) ? $rowClass($row) : '' }} border-b border-gray-200 hover:bg-gray-100">

                    @foreach($columns as $column)

                        {{--                         Index--}}
                        @if(($column['type'] ?? '') === 'index')
                            <td class=" py-3 px-6 text-center">

                                @if(method_exists($rows,'firstItem') && $rows->firstItem())
                                    {{ $rows->firstItem() + $loop->parent->index }}
                                @else
                                    {{ $loop->parent->iteration }}
                                @endif

                            </td>
                            {{--                        @if(($column['type'] ?? '') === 'index')--}}
                            {{--                            <td class="py-3 px-6 text-right">--}}

                            {{--                                    {{ $loop->parent->iteration }}--}}
                            {{--                                {{ $rows->firstItem() + $loop->index }}--}}


                            {{--                            </td>--}}

{{--                            Actions--}}
                        @elseif(($column['type'] ?? '') === 'actions')
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    @foreach($actions as $action)
                                        @if($action === 'edit')
                                            <a href="{{ route($routes[$action], $row->id) }}"
                                               class="w-4 mr-2 transform hover:text-gray-800 hover:scale-110">
                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </a>
                                        @elseif($action === 'show')
                                            <a href="{{ route($routes[$action], $row->id) }}"
                                               class="w-4 mr-2 transform hover:text-slate-800 hover:scale-110">
                                                {{-- <i class="fa-solid fa-eye"></i> --}}
                                                <i class="fas fa-info-circle"></i>                
                                            </a>
                                        @else
                                            <form action="{{ route($routes[$action], $row->id) }}" method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('آیا مطمئن هستید می‌خواهید حذف شود؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-4 mr-2 transform hover:text-red-800 hover:scale-110 bg-transparent border-0 p-0">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                </div>
                            </td>

{{--                            Custom HTML--}}
                        @elseif(isset($column['html']))
                            <td class="py-3 px-6 text-center">
                                {!! $column['html']($row) !!}
                            </td>

{{--                            Custom Value--}}
                        @elseif(isset($column['value']))
                            <td class="py-3 px-6 text-center">
                                {{ $column['value']($row) }}
                            </td>

{{--                            Default Field--}}
                        @else
                            <td class="py-3 px-6 text-center">
                                {{ data_get($row, $column['field']) }}
                            </td>
                        @endif

                    @endforeach

                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>
