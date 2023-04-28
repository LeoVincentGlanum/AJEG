<x-app-layout>
    <div class="container mx-auto">
        <h1>Jeux d'echec inter-pôle en ligne</h1>
        <div class="grid grid-cols-[1fr_1fr_1fr] mt-4 items-center text-center">
            <h2>pion adversse</h2>
            <div class="grid grid-rows-8 grid-cols-8 w-full h-full border-4">
                @for($row=7; $row >= 0; $row--)
                    @for($col=0;$col < 8; $col++)
                        @php 
                            $a = 65+$col;
                            $total=$row+$col;
                        @endphp
                        @if($total%2==0)
                            <span class="p-4"  id="{{$col}}.{{$row}}" >{{$col}}, {{$row}}</span>
                        @else 
                            <span class="p-4 bg-black text-white" id="{{$col}}.{{$row}}">{{$col}}, {{$row}}</span>
                        @endif
                    @endfor
                    @php
                        $a = $a + 1;
                    @endphp
                @endfor
            </div>
            <h2>mes pion perdu</h2>
        </div>
        
    </div>

</x-app-layout>