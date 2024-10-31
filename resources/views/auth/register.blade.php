<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role  -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Role')" />
            {{-- <select name="role" id="" class="w-full bg-[#111827] text-white border-none rounded-lg">

                <option selected disabled value="">Select role</option>
                
                @foreach ($roles as $role)
                
                <option  value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
                
            </select> --}}
            
            <div class=" flex items-center gap-x-5">
            @foreach ($roles as $role)


            <div class="text-white">
                <label for="">{{ $role->name }}</label>
                <input value="{{ $role->id }}" type="checkbox" name="role[]" id="">
            </div>
            @endforeach
        </div>
            
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
