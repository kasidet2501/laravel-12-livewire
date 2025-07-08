<section class="w-full max-w-7xl mx-auto px-4 py-">

    <x-page-heading>
        <x-slot:title>Users</x-slot:title>
        <x-slot:subtitle>
            Users are the individuals who interact with your application. You can create, edit, and delete users as needed.
        </x-slot:subtitle>
        <x-slot:buttons>
            <flux:button href="{{ route('user.create') }}" variant="primary" icon="plus">
                Create user
            </flux:button>
        </x-slot:buttons>
    </x-page-heading>

    <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex-1 max-w-md">
            <flux:input
                wire:model.live="search"
                placeholder="Search by name or surname..."
                icon="magnifying-glass"
                class="w-full"
            />
        </div>

        <div class="flex gap-2 items-center">
            <span class="text-sm text-gray-600">Sort by:</span>
            <flux:button
                size="sm"
                variant="{{ $sortBy === 'age' ? 'primary' : 'ghost' }}"
                wire:click="sortByField('age')"
            >
                Age
                @if($sortBy === 'age')
                    @if($sortDirection === 'asc')
                        ↑
                    @else
                        ↓
                    @endif
                @endif
            </flux:button>

        </div>
    </div>

    <flux:spacer class="mb-4"/>

    <div class="bg-white dark:bg-zinc-800 border border-black dark:border-gray-400 rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-black">
                <tr>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Profile</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">First name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Last name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Birth date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Age</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Action</th>
            </tr>
        </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            {{-- Loop through products --}}
            @forelse($users as $user)
                <tr class="border-t">
                    @if ($user->profile_image)
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Product Image" class="h-12 w-12 object-cover rounded" />
                        </td>
                    @endif
                    <td class="px-4 py-2">{{ $user->title }}</td>
                    <td class="px-4 py-2">{{ $user->first_name }}</td>
                    <td class="px-4 py-2">{{ $user->last_name }}</td>
                    <td class="px-4 py-2">{{ $user->birthdate }}</td>
                    <td class="px-4 py-2">{{ $user->age }}</td>
                    <td class="px-4 py-2 flex gap-2">
                    <flux:button
                        size="sm"
                        variant="primary"
                        href="{{ route('user.edit', $user->id) }}"
                        wire:navigate
                    >
                        Edit
                    </flux:button>

                    <flux:button
                        size="sm"
                        variant="danger"
                        wire:click="deleteUser({{ $user->id }})"
                        wire:confirm="Are you sure you want to delete {{ $user->first_name }} {{ $user->last_name }}? This action cannot be undone."
                    >
                        Delete
                    </flux:button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        @if(!empty($search))
                            No users found matching "{{ $search }}"
                        @else
                            No users found.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

</section>
