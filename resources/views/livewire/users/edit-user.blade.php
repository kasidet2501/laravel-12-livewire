@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section class="w-full max-w-7xl mx-auto px-4 py-">
    <x-page-heading>
        <x-slot:title>Edit user</x-slot:title>
        <x-slot:subtitle>
            Edit user means you can modify the details of an existing user. Fill in the fields below to update the
            user's information.
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateUser" class="space-y-6">

        <flux:select wire:model.live="form.title" label="Title">
            <flux:select.option value="">-- Choose tilte --</flux:select.option>
            <flux:select.option value="นาย">นาย</flux:select.option>
            <flux:select.option value="นางสาว">นางสาว</flux:select.option>
            <flux:select.option value="นาง">นาง</flux:select.option>
        </flux:select>

        <flux:input wire:model.live="form.first_name" label="First name" />
        <flux:input wire:model.live="form.last_name" label="Last name" />
        <flux:input wire:model.live="form.birthdate" label="Date" type="date" />

        <div class="space-y-4">
                <flux:label>Profile Image</flux:label>

                <flux:input wire:model.live="form.profile_image" type="file" accept="image/*" />

                @if ($form->user && $form->user->profile_image && !$form->profile_image)
                    <div class="mb-4">
                        <div class="mb-4">
                            <img src="{{ Storage::url($form->user->profile_image) }}" alt="Selected Image"
                                class="h-25">
                        </div>
                    </div>
                @endif

                @if ($form->profile_image)
                    <div class="mt-4">
                        <div class="w-32 h-32 border-2 border-green-500 rounded-lg overflow-hidden shadow-md">
                            <img src="{{ $form->profile_image->temporaryUrl() }}" alt="New Profile Image Preview"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif
        </div>

        <flux:button type="submit" icon="save" variant="primary">
            Update
        </flux:button>
    </x-form>

</section>
