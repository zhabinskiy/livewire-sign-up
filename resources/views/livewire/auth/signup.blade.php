<main class="container mx-auto py-24">
    <div class="w-2/5 mx-auto flex flex-col items-center">
        <h1 class="text-gray-900 text-3xl font-extrabold">Sign up</h1>
        <div class="w-full mt-12 p-16 bg-white shadow rounded-lg">
            <form wire:submit.prevent="signup" class="space-y-4">

                <div class="flex flex-col">
                    <label for="email" class="text-sm text-gray-800 mb-2">Email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="px-4 py-2 border border-gray-400 rounded-lg outline-none focus:shadow-outline @error('email') border-red-500 @enderror">

                    @error('email') 
                    <span class="mt-2 text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="password" class="text-sm text-gray-800 mb-2">Password</label>
                    <input wire:model.lazy="password" type="password" name="password" id="password" class="px-4 py-2 border border-gray-400 rounded-lg outline-none focus:shadow-outline @error('password') border-red-500 @enderror">

                    @error('password') 
                    <span class="mt-2 text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="passwordConfirmation" class="text-sm text-gray-800 mb-2">Password confirmation</label>
                    <input wire:model.lazy="passwordConfirmation" type="password" name="passwordConfirmation" id="passwordConfirmation" class="px-4 py-2 border border-gray-400 rounded-lg outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                </div>

                <div class="pt-4">
                    <input 
                    type="submit" 
                    value="Sign Up" 
                    class="px-8 py-3 text-xs text-white font-medium uppercase tracking-wider bg-gray-800 border border-gray-900 rounded-lg cursor-pointer transition duration-75 hover:bg-gray-700 hover:border-gray-800 outline-none focus:shadow-outline">
                </div>

            </form>
        </div>
    </div>
</main>
