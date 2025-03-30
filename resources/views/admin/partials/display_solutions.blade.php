
<div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 mb-4">
    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Solutions Found <strong>"{{$solutions->count()}}"</strong> </h3>
</div>
<div class="p-4 space-y-4 w-full relative">
    @foreach ($solutions as $solution)
        <div
            class="p-5 rounded-xl shadow-lg bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 w-full">
            <!-- Header with Timestamp and Action Buttons -->
            <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        {{ $solution->user->name ?? 'Unknown User' }}
                        
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ now()->diffForHumans() }}</p>
                </div>
                <div class="flex space-x-2">
                    <button
                        onclick="showUpdateModal('{{ $solution->id }}', '{{ $solution->title }}', '{{ $solution->description }}', '{{ $solution->ticket_id }}')"
                        class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Edit
                    </button>
                    <form method="post" action="{{ route('admin.ticket.solution.delete', ['id' => $solution->id]) }}">
                        @csrf
                        @method('delete') <button type="submit" onclick="confirm('Are you sure? to delte')"
                            class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>

                </div>
            </div>

            <!-- Post Content -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 mb-4">
                <h5 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $solution->title }}</h5>
                <p class="text-gray-700 dark:text-gray-300">{{ $solution->description }}</p>
            </div>

            <!-- File Button -->
            @if (!empty($solution->file))
                <div class="flex">
                    <button onclick="showFileModal('{{ asset('storage/' . $solution->file) }}')"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center">
                        <span class="mr-2">📂</span> View Attachment
                    </button>
                </div>
            @endif
        </div>
    @endforeach

    @if ($solutions->isEmpty())
        <div
            class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow border border-gray-300 dark:border-gray-700 text-center">
            <p class="text-gray-500 dark:text-gray-400">No solutions available.</p>
        </div>
    @endif

    <!-- Update Modal - Using absolute positioning within the container -->
    <div id="updateModal" class="hidden absolute inset-0 flex items-center justify-center">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
        <!-- Modal Content -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full mx-4 z-10">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Update Solution</h3>
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" id="update_solution_id" name="solution_id">
                <input type="hidden" id="update_ticket_id" name="ticket_id">

                <div class="mb-4">
                    <label for="update_title"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                    <input type="text" id="update_title" name="title"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="mb-4">
                    <label for="update_description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea id="update_description" name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                </div>

                <div class="mb-4">
                    <label for="update_file"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File (Optional)</label>
                    <input type="file" id="update_file" name="file"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep current file</p>
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" onclick="closeUpdateModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:text-white">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- File Preview Modal - Kept at document level -->
<div id="fileModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">File Preview</h3>
        <iframe id="fileViewer" class="w-full h-72 border border-gray-300 rounded"></iframe>
        <div class="flex justify-end mt-4">
            <button onclick="closeFileModal()"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                Close
            </button>
        </div>
    </div>
</div>



<script>
    // File Modal Functions
    function showFileModal(fileUrl) {
        document.getElementById('fileViewer').src = fileUrl;
        document.getElementById('fileModal').classList.remove('hidden');
    }

    function closeFileModal() {
        document.getElementById('fileModal').classList.add('hidden');
    }

    // Update Modal Functions
    function showUpdateModal(id, title, description, ticketId) {
        document.getElementById('update_solution_id').value = id;
        document.getElementById('update_ticket_id').value = ticketId;
        document.getElementById('update_title').value = title;
        document.getElementById('update_description').value = description;
        document.getElementById('updateForm').action = "".replace(':id', id);
        document.getElementById('updateModal').classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('updateModal').classList.add('hidden');
    }


    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
