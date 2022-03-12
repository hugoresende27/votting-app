@if(Auth::check())

<div class="col-md-4">

    <h3>Contribute a Link</h3>

    <div class="panel panel-default ">
        <div class="panel-body form-control mb-3 ">
            <form action="/community" method="POST">
                {{ csrf_field() }}




                <div class="form-group">
                    <label for="channel">Channel:</label>
                   <select name="channel_id" class="form-group mb-3 mt-3">

                        <option selected disabled>Pick a Channels</option>

                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected': '' }}>{{ $channel->title }}</option>
                        @endforeach
                      
                       

                   </select>
                   <br>
                   {!! $errors->first('channel_id', '<span style="color:red" >:message</span>') !!}

                
                </div>

                <div class="form-group mb-3">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="form-control" name="title" placeholder="What is the title of your article? " value="{{ old('title') }}">

                    {!! $errors->first('title', '<span style="color:red" >:message</span>') !!}
                </div>

                <div class="form-group mb-3 ">
                    <label for="link" >Link:</label>
                    <input type="text" id="link" class="form-control" name="link" placeholder="What is the URL? " value="{{ old('link') }}">

                    {!! $errors->first('link', '<span style="color:red">:message</span>') !!}
                </div>

                <div class="form-group mb-3 ">
                    <button class="btn btn-primary">
                        Contribute Link
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@else
<div class="col-md-4">
    <h3><a href="{{ route('login') }}">Please sign in </a> </h3>
</div>

@endif