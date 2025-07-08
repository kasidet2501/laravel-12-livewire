<section class="w-full max-w-7xl mx-auto px-4 py-">
    <x-page-heading>
        <x-slot:title>Create product</x-slot:title>
        <x-slot:subtitle>
            Create product means you can add a new product to your inventory. Fill in the details below to create a new product.
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="saveUser" class="space-y-6">

        <flux:select wire:model.live="form.title" label="Title">
            <flux:select.option value="">-- Choose tilte --</flux:select.option>
            <flux:select.option value="นาย">นาย</flux:select.option>
            <flux:select.option value="นางสาว">นางสาว</flux:select.option>
            <flux:select.option value="นาง">นาง</flux:select.option>
        </flux:select>

        <flux:input wire:model.live="form.first_name" label="First name" />
        <flux:input wire:model.live="form.last_name" label="Last name" />
        <flux:input wire:model.live="form.birthdate" label="Date" type="date" />

        <flux:input wire:model.live="form.profile_image" label="Image" type="file" />
            @if ($form->profile_image)
                <div class="mb-4">
                    <img src="{{ $form->profile_image->temporaryUrl() }}" alt="Selected Image" class="h-25">
                </div>
            @endif

        <flux:button type="submit" icon="save" variant="primary">
            Submit
        </flux:button>
    </x-form>

</section>
