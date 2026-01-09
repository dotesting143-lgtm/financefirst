<form wire:submit.prevent="uploadFile">
    <div class="document-storage bg-white px-4 pt-5 pb-4 sm:p-6 w-full">
        @if (session()->has('message'))
            <p class="mt-2 text-green-500">{{ session('message') }}</p>
        @endif
        <div class="flex flex-wrap flex-row gap-4 lg:gap-6 bg-oxford-blue text-white rounded-md py-3 px-4 lg:px-7 items-center relative mb-8">
            <div class="grow text-base text-sm lg:text-base text-left font-medium">
                 {{ __('Upload Document') }}
            </div>
            <div class="grow">
                <label for="title" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('Document Title') }}:</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-sm w-full p-2 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="title"  wire:model="title">
            </div>
            <div class="grow">
                <label for="file" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('File') }}:</label>
                <input type="file" class="block w-full text-xs lg:text-sm text-black border border-pale-blue-gray rounded-sm cursor-pointer bg-white focus:outline-none" id="file"  wire:model="file">
            </div>
            <div class="w-max self-end">
                <button type="submit" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-1.5 px-5 rounded">
                  {{ __('Upload Now') }}
                </button>
            </div>
        </div>
        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="relative w-full overflow-x-auto">
                <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('title')">
                                {{ __('Document Title') }}
                                @if($sortField === 'title')
                                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                @endif
                            </th>

                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('created_at')">
                                {{ __('Upload Date/Time') }}
                                @if($sortField === 'created_at')
                                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                @endif
                            </th>

                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('uploaded_by')">
                                {{ __('Uploaded By') }}
                                @if($sortField === 'uploaded_by')
                                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                @endif
                            </th>

                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('filename')">
                                {{ __('Filename') }}
                                @if($sortField === 'filename')
                                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                @endif
                            </th>

                            <th scope="col" class="p-2 xl:p-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uploadedFiles as $file)
                        <tr class="border-b">
                            <!-- <th scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">
                                <a href="{{ $file->download_link }}" target="_blank">{{ $file->title }}</a>
                            </th> -->
                            <th scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">
                                @php
                                    // Primary path (new structure)
                                    $filePath = "uploads/documents/{$file->client_id}/{$file->filename}";

                                    // If not found, fall back to old path
                                    if (!Storage::disk('public')->exists($filePath)) {
                                        $filePath = "uploads/documents/{$file->filename}";
                                    }
                                @endphp

                                @if (Storage::disk('public')->exists($filePath))
                                    <a href="{{ Storage::url($filePath) }}" target="_blank">{{ $file->title }}</a>
                                @else
                                    <span class="text-gray-400 italic">{{ __('File missing') }}</span>
                                @endif
                            </th>
                            <td class="p-2 xl:p-3">{{ $file->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-2 xl:p-3">{{ $file->user->name ?? 'N/A' }}</td>
                            <!-- <td class="p-2 xl:p-3">{{ $file->filename }}</td> -->
                            <td scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">
                                @php
                                    // Primary path (new structure)
                                    $filePath = "uploads/documents/{$file->client_id}/{$file->filename}";

                                    // If not found, fall back to old path
                                    if (!Storage::disk('public')->exists($filePath)) {
                                        $filePath = "uploads/documents/{$file->filename}";
                                    }
                                @endphp

                                @if (Storage::disk('public')->exists($filePath))
                                    <a href="{{ Storage::url($filePath) }}" target="_blank">{{ $file->filename }}</a>
                                @else
                                    <span class="text-gray-400 italic">{{ __('File missing') }}</span>
                                @endif
                            </td>
                            <td class="p-2 xl:p-3 flex items-center justify-end relative">
                                <div class="py-1">
                                    @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                                    <button wire:confirm.expect="Are you sure?" wire:click="delete({{ $file->id }})" type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Delete</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>