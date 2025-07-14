@extends('layouts.app')

@section('content')
    <!-- Título en un cuadro blanco -->
    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h2 style="text-align: center; color: #F5C518; margin: 0;">
            CONSTANCIA DE RECORD ACADÉMICO, ESTUDIOS, MATRÍCULA Y OTROS
        </h2>
    </div>

    <div style="display: flex; gap: 5%;">

        <!-- Cuadro pequeño de Descripción -->
        <div style="width: 30%; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); display: flex; flex-direction: column; gap: 10px;">
            <h3 style="font-weight: bold;">Descripción :</h3>
            <p style="font-size: 14px; margin: 0;">
                CONSTANCIA DE RECORD ACADÉMICO, ESTUDIOS, MATRÍCULA Y OTROS
            </p>
            <ul style="font-size: 14px; padding-left: 20px; margin: 0;">
                <li>SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</li>
                <li>PAGO POR DERECHO DE CONSTANCIA</li>
                <li>PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO</li>
            </ul>
        </div>

        <!-- Cuadro grande de Detalles -->
        <div style="width: 65%; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
            <h3 style="font-weight: bold;">Detalles :</h3>
            <ul style="font-size: 14px; padding-left: 20px;">
                <li>Duración :<span style="font-weight: normal;"> 3 días</li>
                <li>Área Inicio :<span style="font-weight: normal;"> Unidad de Administración Documentaria</li>
                <li>Dependencia :<span style="font-weight: normal;"> Sin Asignar</li>
            </ul>

            <h4 style="font-weight: bold; margin-top: 20px;">Requisitos :</h4>
            <ul style="font-size: 14px; padding-left: 20px;">
                <li>SOLICITUD DIRIGIDA AL DECANO</li>
                <li>RECIBO POR CONSTANCIA - <span style="font-weight: normal;">Costo :</span> s/. 5.00</li>
                <li>RECIBO POR TRÁMITE DOCUMENTARIO - <span style="font-weight: normal;">Costo :</span> s/. 3.00</li>
                <li>RECIBO POR TRÁMITE Y CONSTANCIA</li>
            </ul>

            <h4 style="font-weight: bold; margin-top: 30px;">Sustento :</h4>
            <div style="display: flex; justify-content: center;">
                <textarea placeholder="Ingresa el sustento..." style="width: 80%; height: 100px; padding: 10px; border-radius: 6px; border: 1px solid #ccc; color: #666;"></textarea>
            </div>

            <h4 style="font-weight: bold; margin-top: 40px;">Adjuntar Requisitos :</h4>

            <table style="width: 100%; border-collapse: separate; border-spacing: 30px 15px; font-size: 14px;">
                <thead>
                    <tr>
                        <th style="text-align: left; font-weight: bold;">Requisito</th>
                        <th style="text-align: left; font-weight: bold;">Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SOLICITUD DIRIGIDA AL DECANO</td>
                        <td>
                            <input type="file">
                        </td>
                    </tr>
                    <tr>
                        <td>RECIBO POR TRÁMITE Y CONSTANCIA</td>
                        <td>
                            <input type="file">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 30px; text-align: center;">
                <button style="padding: 10px 20px; background-color: #245624; border: none; color: #fff; border-radius: 6px; font-weight: bold; cursor: pointer;">
                    + Enviar solicitud
                </button>
            </div>
        </div>
    </div>
@endsection




