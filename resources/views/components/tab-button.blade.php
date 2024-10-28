@props(['active','tab','attributes'])

<button {{$attributes->merge(['class' => 'font-medium capitalize ' . (($active ?? false) ? 'text-red-600' : '')])}}>
  {{$tab}}
</button>