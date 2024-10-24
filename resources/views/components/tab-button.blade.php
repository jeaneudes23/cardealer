@props(['active','tab','attributes'])

<button {{$attributes->merge(['class' => 'font-medium capitalize ' . ($active ? 'text-red-600' : '')])}}>
  {{$tab}}
</button>