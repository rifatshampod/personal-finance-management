@props(['amount', 'currency' => 'EUR'])
<span class="tabular-nums">{{ number_format((float) $amount, 2) }} {{ $currency }}</span>


