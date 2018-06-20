{!! Form::open(['url' => 'home/submit', 'method' => 'post']) !!}
<div class="form-group">
    {{Form::label('text', 'Текст статьи')}}
    {{Form::textarea('text', '', ['class' => 'form-control', 'placeholder' => 'Введите текст сюда'])}}
</div>
<div class="form-group">
    {{Form::label('speed', 'Скорость прокрутки статьи')}}
    {{Form::text('speed', '', ['class' => 'form-control', 'placeholder' => 'Введите скорость прокрутки статьи'])}}
</div>

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
<div>
    {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
</div>
{!! Form::close() !!}