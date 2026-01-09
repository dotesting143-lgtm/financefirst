<form>
	<div class="document-storage bg-white px-4 pt-5 pb-4 sm:p-6 w-full">
		<div class="flex flex-wrap flex-row gap-4 lg:gap-6 bg-oxford-blue text-white rounded-md py-3 px-4 lg:px-7 items-center relative mb-8">
			<div class="grow text-base text-sm lg:text-base text-left font-medium">
                 {{ __('Upload Document') }}
            </div>
            <div class="grow">
                <label for="do_title" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('Document Title') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-sm w-full p-2 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="do_title"  wire:model="do_title">
            </div>
            <div class="grow">
            	<label for="title" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('File') }}</label>
				<input type="file" class="block w-full text-xs lg:text-sm text-black border border-pale-blue-gray rounded-sm cursor-pointer bg-white focus:outline-none" id="filename"  wire:model="filename">
            </div>
            <div class="w-max self-end">
				<button type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-1.5 px-5 rounded">
		          {{ __('Upload Now') }}
		        </button>
            </div>
		</div>
		<div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="relative w-full overflow-x-auto">
                <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="p-2 xl:p-3">{{ __('Document Title') }}</th>
                            <th scope="col" class="p-2 xl:p-3">{{ __('Upload Date/Time') }}</th> 
                            <th scope="col" class="p-2 xl:p-3">{{ __('Uploaded By') }}</th>
                            <th scope="col" class="p-2 xl:p-3">{{ __('Filename') }}</th>
                            <th scope="col" class="p-2 xl:p-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <th scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">Document</th>
                            <td class="p-2 xl:p-3">08/09/2011 13:42:17</td>
                            <td class="p-2 xl:p-3">Leo Healy</td>
                            <td class="p-2 xl:p-3">20110908134217.pdf</td>
                            <td class="p-2 xl:p-3 flex items-center justify-end relative">
                                <button id="document-1-button" data-dropdown-toggle="document-1" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                </button>
                                <div id="document-1" class="hidden z-10 w-44 bg-slate-100 rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="document-1-button">
                                        <li>
                                            <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">View</button>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">L&ILL quote</th>
                            <td class="p-2 xl:p-3">20/01/2023 16:13:23</td>
                            <td class="p-2 xl:p-3">Lara Fennell</td>
                            <td class="p-2 xl:p-3">20230120161323.pdf</td>
                            <td class="p-2 xl:p-3 flex items-center justify-end relative">
                                <button id="document-2-button" data-dropdown-toggle="document-2" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                </button>
                                <div id="document-2" class="hidden z-10 w-44 bg-slate-100 rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="document-2-button">
                                        <li>
                                            <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">View</button>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">Motor Policy</th>
                            <td class="p-2 xl:p-3">26/08/2011 08:34:36</td>
                            <td class="p-2 xl:p-3">Brightcube</td>
                            <td class="p-2 xl:p-3">20110826083436.pdf</td>
                            <td class="p-2 xl:p-3 flex items-center justify-end relative">
                                <button id="document-3-button" data-dropdown-toggle="document-2" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                </button>
                                <div id="document-3" class="hidden z-10 w-44 bg-slate-100 rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="document-3-button">
                                        <li>
                                            <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">View</button>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center pt-8">
		    <button type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
		    	{{ __('Upload Now') }}
		    </button>
		</div>
	</div>
</form>