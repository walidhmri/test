<div class="space-y-4">
    <!-- حقل العنوان -->
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
        Title
        <input name="title" type="text" placeholder="Enter title" required
            class="block w-full mt-1 px-3 py-2 text-gray-900 dark:text-gray-300 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition ease-in-out duration-150" />
    </label>

    <!-- حقل الوصف -->
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
        Description
        <textarea name="description" placeholder="Enter description"
            class="block w-full mt-1 px-3 py-2 text-gray-900 dark:text-gray-300 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition ease-in-out duration-150"></textarea>
    </label>

    <!-- حقل الملف -->
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
        File
        <input name="file" type="file"
            class="block w-full mt-1 text-gray-900 dark:text-gray-300 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition ease-in-out duration-150" />
    </label>

    <!-- زر الإرسال -->
    <button type="submit"
        class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium text-gray-900 dark:text-white border border-blue-600 dark:border-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
        
        <!-- أيقونة النشر -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current text-gray-900 dark:text-white" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h4v5a1 1 0 001 1h4a1 1 0 001-1v-5h4a1 1 0 00.707-1.707l-7-7z"/>
        </svg>

        <span class="ml-2">Post</span>
    </button>
<div>
