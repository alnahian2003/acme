<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Keep your profile picture up-to-date so that our users can easily find you across the site!') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <div class="col-span-full">
                <div class="mt-2 flex items-center gap-x-3">
                    <div class="relative">
                        <img class="h-16 w-16 rounded-full object-cover ring-2 ring-gray-300 dark:ring-gray-500"
                            src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                        <span
                            class="absolute left-12 top-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-green-400 dark:border-gray-800"></span>
                    </div>

                    <x-input-label for="avatar">
                        <div
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                            Change</div>
                    </x-input-label>

                    <input class="hidden" id="avatar" type="file" name="avatar">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p class="text-sm text-gray-600 dark:text-gray-400" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)">{{ __('Profile Picture Updated!') }}</p>
            @endif
        </div>
    </form>

    @error('avatar')
        {{ $message }}
    @enderror
</section>
