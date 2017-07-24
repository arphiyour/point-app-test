@extends('core::app.layout')

@section('content')
    <div id="page-content">
        <div class="row">
        <?php

        $files = \File::files(base_path().'/resources/views/menu/manufacture');
        foreach ($files as $file) {
            $array = explode('/', $file);
            $view_name = end($array);
            $array = explode('.', $view_name);
            $view_name = $array[0]; ?>
        @include('menu/manufacture/'.$view_name)
        <?php

        }

        ?>
        </div>
    </div>
@stop

