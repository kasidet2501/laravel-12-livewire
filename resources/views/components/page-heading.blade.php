@props([
    'title' => null,
    'subtitle' => null,
])
<div class="relative mb-6 w-full">
    <div class="flex flex-col items-center text-center @if (empty($subtitle)) mb-4 @endif">
        <div class="mb-4">
            @if (!empty($title))
                <flux:heading size="xl" level="1" class="text-center">{{ $title }}</flux:heading>
            @endif
            @if (!empty($subtitle))
                <flux:subheading size="lg" class="mb-2 text-center">{{ $subtitle }}</flux:subheading>
            @endif
        </div>
    </div>
    <flux:separator variant="subtle" />

    @if (!empty($buttons))
        <div class="w-full flex justify-start mt-3">
            {{ $buttons }}
        </div>
    @endif
</div>
