@extends('layouts.app')

@section('content')
    <h2>Solicitud enviada con éxito</h2>
    <p>Gracias por enviar tu solicitud. Los archivos fueron recibidos.</p>
    <ul>
        <li>Archivo 1: {{ $archivo1 }}</li>
        <li>Archivo 2: {{ $archivo2 }}</li>
    </ul>
@endsection
