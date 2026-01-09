<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('User Lists') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4 md:mb-0 justify-between md:justify-normal">
        <button wire:click="create()" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">
            {{ __('Add New User') }}
        </button>
    </div>
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">

            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 xl:p-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            @if($isOpen)
                @include('livewire.user.createuser')
            @endif
            @if (!$viewAll && $allusers->hasPages())
                <div class="mt-4 px-4 mb-4">
                    {{ $allusers->links('vendor.pagination.tailwind') }}
                    <div class="flex justify-center">
                        <button wire:click="toggleViewAll" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2.5 px-5 rounded text-sm xl:text-base" style="margin-top: -40px;">
                            {{ $viewAll ? __('Back to Pagination') : __('View All') }}
                        </button>
                    </div>
                </div>
            @elseif ($viewAll)
                <div class="mt-8 px-4 mb-4">
                    <div class="flex justify-center">
                        <button onclick="window.location.reload()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2.5 px-5 rounded text-sm xl:text-base" style="margin-top: -40px;">
                            {{ $viewAll ? __('Back to Pagination') : __('View All') }}
                        </button>
                    </div>
                </div>
            @endif
            <section class="bg-gray-white w-full relative">
                <div class="w-full">
                    <!-- Start coding here -->
                    <div class="bg-white relative shadow-md rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('name')">
                                            Name
                                            @if ($sortField === 'name')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('email')">
                                            Email
                                            @if ($sortField === 'email')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('username')">
                                            Username
                                            @if ($sortField === 'username')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('role')">
                                            Role
                                            @if ($sortField === 'role')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allusers as $user)
                                    <tr class="border-b">
                                        <th scope="row" wire:click="edit({{ $user->id }})" class="p-2 xl:p-3 font-medium no-underline text-yankees-blue hover:text-vivid-amethyst whitespace-nowrap pointer-events-auto cursor-pointer">{{ $user->name }}</th>
                                        <td class="p-2 xl:p-3">{{ $user->email }}</td>
                                        <td class="p-2 xl:p-3">{{ $user->username }}</td>
                                        <td class="p-2 xl:p-3">{{ $user->role_label }}</td>
                                        <td class="p-2 xl:p-3 flex items-center justify-end">
                                            <button id="dropdown-{{ $user->id }}-button" data-dropdown-toggle="dropdown-{{ $user->id }}" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                                
                                            </button>
                                            <div id="dropdown-{{ $user->id }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-{{ $user->id }}-button">
                                                    <li>
                                                        <button type="button" wire:click="edit({{ $user->id }})" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">Edit</button>
                                                    </li>
                                                </ul>
                                                <div class="py-1">
                                                    <button type="button" wire:click="delete({{ $user->id }})" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white w-full text-left">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>