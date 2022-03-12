@extends('layouts.app')

@section('content')




    <div class="row">

        <div class="col-md-8">

            <h3 class="teste">Community</h3>

          

            <ul class="list-group">

                @if (count($links))
                    
               

                    @foreach ($links as $link)
                        <li class="list-group-item" style="list-style: none">

                            <span class="badge badge-secondary" style="background: {{ $link->channel->color }}">{{ $link->channel->title }}</span>
                            <a href="{{ $link->link }}"> 
                                    {{ $link->title }}
                            </a>

                            <small>
                                Contributed By: <a href=""> {{ $link->creator->name }} </a> at {{ $link->updated_at->diffForHumans() }}
                                            {{-- função    diffForHumans() para a data --}}
                            </small>

                        </li>
                    @endforeach
                   
                @else

                    <li>No contributions yet</li>

                @endif
                
            </ul>

        </div>
        
    

        @include('community.add-link')

    </div>




@endsection