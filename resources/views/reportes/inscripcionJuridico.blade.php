<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscripcion de Socio</title>
    <style>
        body{
            font-family: monospace;
        } 
        td{
            border: 1px solid #d5d5d5;
            font-size: 12px;
        }
        .title{
            font-weight: bold
        }

    </style>
</head>
<body>
            <table style="border: none;" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr style="border: none;">
                    <th style="border: none;"></th>
                    <th style="border: none;"></th>
                    <th style="border: none;"></th>
                </tr>
                <tr >
                    <td  colspan="2" valign="middle" align="left"  style="width: 70%;border: none;"><span>SOLICITUD DE ADMISIÓN - PERSONA JURIDICA</span></td>
                
                    <td rowspan="2" style="padding: 10px 0;"><span class="title"> ***  Logo ****</span> </td>
                </tr>
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;border: none;"><span class="title">Nro de Registro</span> 45222  <span class="title">Agencia</span> Huánuco </td>
                </tr>
            </table>


            <table style="width: 100%; margin: 4px 0 27px 0px;"   cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px">Sr. Presidente del Consejo de Administración de la Cooperativa de Ahorro
                         y Crédito Sembrar, solicito ser aceptado(a) como socio(a), asimismo me comprometo a cumplir con las disposiciones del Estatuto y Leyes vigentes.</th>
                    </tr>
                </thead>
            </table>



            <table style="width: 100%;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">DATOS PERSONALES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="2">
                            <span class="title">RAZON SOCIAL</span> {{$juridico->razon_social}} <span > </span>
                            </td>
                            <td >
                            <span class="title">RUC</span> {{$cliente->documento}} <span > </span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"> <span class="title">NOMBRE COMERCIAL </span>  <span>{{$cliente->nombre_comercial}} </span> </td>
                            <td> <span class="title">ACTIVIDAD PRINCIPAL</span> <span > {{$juridico->actividad_principal}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="2"> <span class="title">NRO. FR PARTIDA REGISTRAL</span> <span > {{$juridico->partida_registral}} </span> </td>
                            <td> <span class="title">OFICINA REGISTRAL</span> <span> {{$juridico->oficina_principal}}</span> </td>
                        </tr>
                        <tr>
                            <td> <span class="title">P.N CON NEGOCIO </span> <span >{{$juridico->tipo_negocio}}</span> </td>
                            <td colspan="2"> <span class="title">DIRECCIÓN</span> {{$juridico->direccion}} <span > </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">NÚMERO</span> {{$juridico->numero}}  <span class="title">MZ</span>  {{$juridico->manzana}} <span class="title">LOTE </span> {{$juridico->lote}}  <span class="title">DPTO</span> {{$juridico->pdto}}  <span class="title">INT</span> {{$juridico->int}}  <span class="title">PISO </span>{{$juridico->piso}}</td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">DISTRITO</span> <span >{{$cliente->distrito}}</span> </td>
                            <td> <span class="title">PROVINCIA</span> {{$cliente->provincia}} <span > </span> </td>
                            <td> <span class="title">DEPARTAMENTO</span> {{$cliente->departamento}} <span >  </span> </td>
                        </tr>


                        <tr>
                            <td colspan="3"> <span class="title">REFERENCIA</span> <span > {{$juridico->referencia}} </span> </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">TELÉFONO</span> <span >{{$juridico->telefono}} </span> </td>
                            <td> <span class="title">CELULAR</span> {{$juridico->celular}}  <span > </span> </td>
                            <td> <span class="title">EMAIL</span> {{$juridico->correo}} <span >  </span> </td>
                        </tr>

                </tbody>
            </table>
            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;;">REPRESENTANTES LEGALES</th>
                    </tr>
                </thead>
                <tbody>
                          <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cargo</th>
                                            </tr>
                                           
                                        </thead>
                                        @if ($tiene_representantes=='SI')
                                            <tbody>
                                                @foreach ($listaRepresentante as  $representante)
                                                        <tr>
                                                            <td>{{$representante->nombres}}</td>
                                                            <td>{{$representante->documento}}</td>
                                                            <td>{{$representante->cargo}}</td>
                                                        </tr>
                                                @endforeach           
                                            </tbody>
                                        @else
                                            <tbody>
                                                <td colspan="3">
                                                    <span>*****************************************  NO REGISTRA REPRESENTANTES  ******************************</span>
                                                </td>         
                                            </tbody>   
                                        @endif
                                       
                                    </table>
                            </tr>
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;;">PRINCIPALES DIRECTORES</th>
                    </tr>
                </thead>
                <tbody>
                          <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cargo</th>
                                            </tr>
                                           
                                        </thead>
                                        @if ($tiene_directores=='SI')
                                            <tbody>
                                                @foreach ($listaDirector as  $director)
                                                        <tr>
                                                            <td>{{$director->nombres}}</td>
                                                            <td>{{$director->documento}}</td>
                                                            <td>{{$director->cargo}}</td>
                                                        </tr>
                                                @endforeach           
                                            </tbody>
                                        @else
                                        <tbody>
                                            <td colspan="3">
                                                <span>*****************************************  NO REGISTRA DIRECTORES  *********************************</span>
                                            </td>         
                                        </tbody>
                                        @endif
                                        
                                    </table>
                            </tr>
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;;">PRINCIPALES ACCIONISTAS (más del 25%) O PARTICIPACIONISTAS Y/O ASOCIADOS</th>
                    </tr>
                </thead>
                <tbody>
                          <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                            </tr>
                                           
                                        </thead>
                                        @if ($tiene_accionistas=='SI')
                                            <tbody>
                                                @foreach ($listaAccionista as  $accionista)
                                                        <tr>
                                                            <td>{{$accionista->nombres}}</td>
                                                            <td>{{$accionista->documento}}</td>
                                                        </tr>
                                                @endforeach           
                                            </tbody>
                                        @else
                                        <tbody>
                                            <td colspan="3">
                                                <span>*****************************************  NO REGISTRA ACCIONITAS  *********************************</span>
                                            </td>         
                                        </tbody>
                                        @endif
                                        
                                        
                                    </table>
                            </tr>
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;;">OBLIGACIONES ASOCIATIVAS</th>
                    </tr>
                </thead>
                <tbody>
                          
                    <tr>
                            <td colspan="3"><span class="title">Inscripción</span> S/. {{$asociativa->inscripcion}} <span class="title">Aporte</span> S/. {{$asociativa->aporte}}</td> 
                    </tr>
                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;;">DECLARACIONES</th>
                    </tr>
                </thead>
                <tbody>
                          
                    <tr>
                        <td colspan="3"> <span class="title">Es sujeto obligado a informar a la UIF Perú</span> [ {{$declaracion->uif}}] </td>
                    </tr>
                    <tr>
                        <td colspan="2"> 
                            
                        </td> 
                        <td > <span class="title"> Huella </span></td>
                    </tr>

                    <tr>
                        <td><span class="title">Estado</span> {{$declaracion->estado}}</td>
                        <td><span class="title">Fecha</span> {{$declaracion->created_at}}</td>
                        <td><span class="title">Firma</span>____________________</td>
                    </tr>

                    <tr>
                        <td colspan="3"> <span class="title">observaciones</span>
                            <span> {{$declaracion->observaciones}}
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
</body>
</html>