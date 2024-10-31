<x-guest-layout>
    <div>(<span class="text-red-500 text-sm">*</span>)は記入必須です</div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <div class="inline-flex items-center">
                <x-input-label for="name" :value="__('Name')" /><span class="text-red-500 text-sm ml-1">*</span>
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div class="inline-flex items-center">
                <x-input-label for="email" :value="__('Email')" /><span class="text-red-500 text-sm ml-1">*</span>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <div class="inline-flex items-center">
                <x-input-label for="phone" :value="__('電話番号(-は不要です)')" /><span class="text-red-500 text-sm ml-1">*</span>
            </div>
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('郵便番号')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- Prefecture -->
        <div class="mt-4">
            <x-input-label for="prefecture" :value="__('都道府県')" />
            <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture')" />
            <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('ご住所1(市区町村群)')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- Address Line -->
        <div class="mt-4">
            <x-input-label for="address_line" :value="__('ご住所2(町名・番地)')" />
            <x-text-input id="address_line" class="block mt-1 w-full" type="text" name="address_line" :value="old('address_line')" />
            <x-input-error :messages="$errors->get('address_line')" class="mt-2" />
        </div>

        <!-- Building Name -->
        <div class="mt-4">
            <x-input-label for="building" :value="__('ご住所3(マンション・ビル名・部屋番号)')" />
            <x-text-input id="building" class="block mt-1 w-full" type="text" name="building" :value="old('building')" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="inline-flex items-center">
                <x-input-label for="password" :value="__('Password')" /><span class="text-red-500 text-sm ml-1">*</span>
            </div>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="inline-flex items-center">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span class="text-red-500 text-sm ml-1">*</span>
            </div>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
