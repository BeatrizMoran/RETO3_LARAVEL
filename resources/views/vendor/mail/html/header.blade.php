@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Killer')
                <img src="{{ asset('images/Killerlogo.png') }}" class="logo" alt="Killer Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
