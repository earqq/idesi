<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: monospace;
        }
        span{
            border: 1px solid #cbcbcb;
            padding: 4px 19px;
            border-radius: 2px;
            width: 100%;
        }
        td{
            border: 1px solid #d5d5d5;
            font-size: 10px;
        }
    </style>
</head>
<body>


            <table style="width: 100%;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #d2d0d0;">TITULAR</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="3">
                            APELLIDOS Y NOMBRES  <span > {{$cliente->apellidos}} {{$cliente->nombres}}</span>
                            </td>
                        </tr>

                        <tr>
                        <td> DNI <span > {{$cliente->documento}}</span> </td>
                            <td> F. DE NACIMIENTO <span > {{$cliente->nacimiento}}</span> </td>
                            <td> ESTADO DIVIL <span > {{$cliente->estado_civil}} </span> </td>
                        </tr>
                        <tr>
                            <td> OCUPACIÓN <span > {{$cliente->ocupacion}}</span> </td>
                            <td> TELEFONO <span > {{$cliente->telefono}}</span> </td>
                            <td> CELULAR <span > {{$cliente->celular}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="2"> DIRECCION <span > {{$cliente->direccion}}</span> </td>
                            <td> DEPARTAMENTO <span > {{$cliente->departamentos_id}}</span> </td>
                        </tr>
                        <tr>
                            <td colspan="2"> PROVINCIA <span > {{$cliente->provincias_id}}</span> </td>
                            <td> DISTRITO <span > {{$cliente->distritos_id}}</span> </td>
                        </tr>

                        <tr>
                            <td colspan="2"> REFERENCIA <span >{{$cliente->referencia}}</span> </td>
                            <td> TIPO DE DOMICILIO <span > {{$cliente->tipo_domicilio}}</span> </td>
                        </tr>

                        <tr>
                            <td > CENTRO LABORAL  <span > {{$cliente->centro_laboral}}</span> </td>
                            <td colspan="2"> DIRECCION <span > {{$cliente->direccion}} </span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #d2d0d0;">CONYUGUE O CONVIVIENTE</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="3">
                                APELLIDOS Y NOMBRES  <span >{{$cliente->apellidos_conyugue}} {{$cliente->nombres_conyugue}}</span>
                            </td>
                        </tr>

                        <tr>
                            <td> DNI <span >{{$cliente->documento_conyugue}}</span> </td>
                            <td> F. DE NACIMIENTO <span > {{$cliente->nacimiento_conyugue}}</span> </td>
                            <td> ESTADO DIVIL <span > {{$cliente->estado_civil_conyugue}} </span> </td>
                        </tr>
                        <tr>
                            <td> OCUPACIÓN <span > {{$cliente->ocupacion_conyugue}}</span> </td>
                            <td> TELEFONO <span > {{$cliente->telefono_conyugue}}</span> </td>
                            <td> CELULAR <span > {{$cliente->celular_conyugue}} </span> </td>
                        </tr>
                        <tr>
                            <td> ¿ES SOCIO? SI <span > X </span>  NO <span ></span> </td>
                            <td> CODIGO DE SOCIO <span > 001154</span> </td>
                            <td> APORTE <span > 1500</span> </td>
                        </tr>

                        <tr>
                            <td > CENTRO LABORAL  <span > {{$cliente->centro_laboral_conyugue}}</span> </td>
                            <td colspan="2" > DIRECCION <span >{{$cliente->direccion_laboral_conyugue}}</span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #d2d0d0;">AVAL</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="3">
                                APELLIDOS Y NOMBRES  <span >BETETA CABRERA SHEYLI</span>
                            </td>
                        </tr>

                        <tr>
                            <td> DNI <span >72114126</span> </td>
                            <td> F. DE NACIMIENTO <span > 06/02/1995</span> </td>
                            <td> ESTADO DIVIL <span > CASADO </span> </td>
                        </tr>
                        <tr>
                            <td> OCUPACIÓN <span > PSICOLOGIA</span> </td>
                            <td> TELEFONO <span > 51 6099</span> </td>
                            <td> CELULAR <span > +51 959273321 </span> </td>
                        </tr>
                        <tr>
                            <td> ¿ES SOCIO? SI <span > X </span>  NO <span ></span> </td>
                            <td> CODIGO DE SOCIO <span > 001154</span> </td>
                            <td> APORTE <span > 1500</span> </td>
                        </tr>

                        <tr>
                            <td colspan="2" > DIRECCION  <span > NINGUNO</span> </td>
                            <td  > DISTRITO <span > -- -- </span> </td>
                        </tr>
                        <tr>
                            <td > CENTRO LABORAL  <span > NINGUNO</span> </td>
                            <td colspan="2" > DIRECCION <span > -- -- </span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #d2d0d0;">GARANTIA</th>
                    </tr>
                </thead>
                <tbody>
                        

                        <tr>
                            <td> BIEN EN GARANTIA <span >CARRO COMPRAS</span> </td>
                            <td> INS. <span > NINGUNO </span> </td>
                            <td>D. J <span > SIN DECLARACION JURADA </span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="4" style="text-align: inherit;background: #d2d0d0;">PROPUESTA DEL ANALISTA</th>
                    </tr>
                </thead>
                <tbody>
                        

                        <tr>
                            <td colspan="2"> PRODUCTO <span >PLASO SIMPLE</span> </td>
                            <td> FORMA <span > CUOTAS</span> </td>
                        </tr>
                        <tr>
                            <td> IMPORTE <span > 5400</span> </td>
                            <td> PLAZO <span > 15</span> </td>
                            <td> CUOTAS <span > 21 </span> </td>
                            <td> APORTE <span > 23 </span> </td>
                        </tr>
                        <tr>
                            <td colspan="4" > COMENTARIOS <span > SIN OCMENTARIOS </span></td>
                        </tr>


                </tbody>
            </table>
</body>
</html>