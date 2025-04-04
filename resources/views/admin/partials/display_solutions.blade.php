<div class="mt-8">
    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
        </svg>
        Solutions ({{ isset($solutions) && is_countable($solutions) ? count($solutions) : 0 }})
    </h3>

    @if(isset($solutions) && is_countable($solutions) && count($solutions) > 0)
        <div class="space-y-4" id="solutions-container">
            @foreach($solutions as $solution)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 solution-item" id="solution-{{ $solution->id }}">
                    <!-- Solution Header -->
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <!-- Engineer Avatar -->
                            <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-500 dark:text-indigo-400 overflow-hidden">
                                @if(isset($solution->user) && $solution->user->profile_photo_path)
                                    <img src="{{ asset('storage/'.$solution->user->profile_photo_path) }}" alt="{{ $solution->user->name }}" class="h-full w-full object-cover">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @endif
                            </div>
                            
                            <!-- Engineer Info -->
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">
                                    {{ isset($solution->user) ? $solution->user->name : 'Unknown Engineer' }}
                                </h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $solution->created_at->format('M j, Y • g:i A') }} 
                                    @if($solution->created_at != $solution->updated_at)
                                        <span class="italic">(edited)</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <a href="" 
                               class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="post" action="{{route('admin.ticket.solution.delete',['id'=>$solution->id])}}">
                                @method('DELETE')
                                @csrf
                            <button type="submit" 
                                    class="delete-solution-btn text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600"
                                    onclick="confirm('Are you sure deleting This solution?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                        </div>
                    </div>
                    
                    <!-- Solution Content -->
                    <div class="px-4 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                        <!-- Solution Title -->
                        @if(isset($solution->title) && !empty($solution->title))
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $solution->title }}</h3>
                        @endif
                        
                        <!-- Solution Description -->
                        @if(isset($solution->description) && !empty($solution->description))
                            <div class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                                {{ $solution->description }}
                            </div>
                        @endif
                        
                        <!-- Solution File (if available) -->
                        @if(isset($solution->file) && !empty($solution->file))
                            <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-md">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-indigo-100 dark:bg-indigo-900 rounded border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-500 dark:text-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ basename($solution->file) }}
                                        </p>
                                        <div class="flex mt-1 space-x-3">
                                            <a href="{{ asset('storage/' . $solution->file) }}" download class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                                                Download
                                            </a>
                                            <a href="{{ asset('storage/' . $solution->file) }}" target="_blank" class="text-xs text-gray-600 dark:text-gray-400 hover:underline">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Solution Footer -->
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <!-- Upvote/Downvote (Optional) -->
                            <div class="flex items-center space-x-2 mr-4">
                                <button type="button" class="upvote-btn flex items-center hover:text-indigo-600 dark:hover:text-indigo-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                    </svg>
                                    <span class="ml-1">{{ rand(0, 15) }}</span>
                                </button>
                            </div>
                            
                            <!-- Solution Tags -->
                            @if(isset($solution->tags) && !empty($solution->tags))
                                <div class="flex flex-wrap gap-1">
                                    @foreach(explode(',', $solution->tags) as $tag)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center border border-gray-200 dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No solutions yet</h4>
            <p class="text-gray-500 dark:text-gray-400 mb-4">Be the first to provide a solution for this ticket.</p>
            <a href="{{ route('admin.tickets.solve', ['id' => $ticket->id, 'user_id' => $ticket->user_id]) }}" 
                class="inline-flex items-center px-4 py-2 border border-indigo-500 dark:border-indigo-700 rounded-md shadow-sm text-sm font-medium 
                       text-black dark:text-white bg-indigo-500 hover:bg-indigo-600 dark:bg-indigo-700 dark:hover:bg-indigo-800 
                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                 </svg>
                 Add Solution
             </a>
             
             
        </div>
    @endif
</div>
