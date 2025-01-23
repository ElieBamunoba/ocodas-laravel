{{-- resources/views/admin/users/form.blade.php --}}
@php
   use Illuminate\Support\Js;
   $errors = $errors ?? new \Illuminate\Support\MessageBag();
@endphp

<form method="POST"
   action="{{ isset($user->id) ? route('admin.users.update', $user) : route('admin.users.store') }}" 
   class="space-y-6">
   @csrf
   @if(isset($user->id))
       @method('PUT')
   @endif

   <div class="grid grid-cols-1 gap-6">
       <div>
           <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
           <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
           @error('name')
               <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
           @enderror
       </div>

       <div>
           <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
           <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}">
           @error('email')
               <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
           @enderror
       </div>

       <div>
           <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
               Password {{ isset($user) ? '(Leave blank to keep current password)' : '' }}
           </label>
           <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }}
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}">
           @error('password')
               <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
           @enderror
       </div>

       <div>
           <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
               Confirm Password
           </label>
           <input type="password" name="password_confirmation" id="password_confirmation"
               {{ isset($user) ? '' : 'required' }}
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
       </div>

       <div class="flex justify-end space-x-3">
           <button type="submit"
               class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
               {{ isset($user->id) ? 'Update' : 'Create' }} User
           </button>
       </div>
   </div>
</form>