<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Here is your Todo List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($errors->any())
                        <div class="bg-red-10 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Sorry </strong>
                            <span class="block sm:inline">{{ $errors->first() }}</span>
                        </div>
                    @endif
                    <a href="{{ route('todos.create') }}"
                       class="inline-block border border-1 py-2 px-4 border-green-500 mb-6 bg-green-200">Add New Todo</a>
                    <br>
                   @forelse($todos as $todo)
                        <ul>
                            <li class="mb-4 flex"><a href="{{ route('todos.show',$todo->id)  }}">{{ $todo->title }}</a>
                                    <span class="ml-4 border border-orange-50 bg-orange-500 px-2 inline-block">
                                        <a href="{{ route('todos.edit',$todo->id)  }}" >Edit</a>
                                         </span>
                                        <form action="{{ route('todos.destroy',$todo->id) }}" method="post" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="ml-4 border border-red-500 bg-red-200 px-2"  type="submit">
                                                Delete
                                            </button>
                                        </form>
                            </li>
                        </ul>
                    @empty
                       You don't have anything on your ToDO list
                   @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
