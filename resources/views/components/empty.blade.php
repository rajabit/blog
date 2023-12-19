@props(['message'])

<div {{ $attributes->merge(['class' => 'w-full flex justify-center items-center flex-col p-10 dark:text-gray-400
    text-gray-600']) }}>
    <x-icons.sad />

    <div class="text-lg">
        {{ $message ?? "List is empty!" }}
    </div>
</div>
