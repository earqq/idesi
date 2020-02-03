<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscripcion de Socio</title>
    <style>
        body{
            font-family: sans-serif;
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
                    <td  colspan="2" valign="middle" align="left"  style="width: 70%;border: none;"><span>SOLICITUD DE ADMISIÓN - PERSONA NATURAL</span></td>
                
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
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS PERSONALES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="3">
                            <span class="title">APELLIDOS Y NOMBRES</span> {{$natural->nombres}} <span > </span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"> <span class="title">DOCUMENTO <span>{{$cliente->tipo_documento}} </span> Nro</span> {{$cliente->documento}}  <span > </span> </td>
                            <td> <span class="title">F. NACIMIENTO</span> <span > {{$natural->nacimiento}} </span> </td>
                        </tr>
                        <tr>
                            <td> <span class="title">NACIONALIDAD</span> <span >Peruana</span> </td>
                            <td colspan="2"> <span class="title">DEPARTAMENTO</span> <span >HUANUCO</span>  PROVINCIA <span>HUANUCO </span> DISTRITO <span>HUANUCO</span></td>
                        </tr>
                        <tr>
                            <td> <span class="title">ESTADO CIVIL</span> <span >{{$natural->estado_civil}}</span> </td>
                            <td> <span class="title">GENERO</span> {{$natural->genero}} <span > </span> </td>
                            <td> <span class="title">GRADO DE INSTRUCCION</span> {{$natural->grado_instruccion}} <span >  </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">OCUPACIÓN</span> <span > {{$natural->ocupacion}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">DIRECCIÓN</span> <span > {{$natural->direccion_cliente}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">NÚMERO</span> {{$natural->numero}}  <span class="title">MZ</span>  {{$natural->manzana}} <span class="title">LOTE </span> {{$natural->lote}}  <span class="title">DPTO</span> {{$natural->dpto}}  <span class="title">INT</span> {{$natural->int}}  <span class="title">PISO </span>{{$natural->piso}}</td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">DISTRITO</span> <span >{{$natural->domicilio_distrito}}</span> </td>
                            <td> <span class="title">PROVINCIA</span> {{$natural->domicilio_provincia}} <span > </span> </td>
                            <td> <span class="title">DEPARTAMENTO</span> {{$natural->domicilio_departamento}} <span >  </span> </td>
                        </tr>


                        <tr>
                            <td colspan="3"> <span class="title">REFERENCIA</span> <span > {{$natural->referencia}} </span> </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">TELÉFONO</span> <span >{{$natural->telefono}} </span> </td>
                            <td> <span class="title">CELULAR</span> {{$natural->celular}}  <span > </span> </td>
                            <td> <span class="title">EMAIL</span> {{$natural->correo}} <span >  </span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS LABORALES</th>
                    </tr>
                </thead>
                @if ($laboral->estado_laboral=='TRABAJA')
                    <tbody>
                        <tr>
                            <td > <span class="title">ESTADO LABORAL</span> {{$laboral->estado_laboral}} <span ></span>  </td>
                            <td > <span class="title"> TIPO DE TRABAJADO</span> {{$laboral->tipo_trabajador}} <span ></span>  </td>

                        </tr>

                        <tr>
                            <td colspan="2"> <span class="title">RAZÓN SOCIAL</span>  {{$laboral->razon_social}}  <span ></span> </td>
                            <td > <span class="title">RANGO DE INGRESO MENSUAL </span> {{$laboral->ingreso_mensual}} <span ></span> </td>
                        </tr>

                        <tr>
                            <td> <span class="title">CARGO</span>  {{$laboral->cargo_ocupacion}} <span > </span> </td>
                            <td> <span class="title">FECHA INGRESO </span> {{$laboral->fecha_ingreso}}<span ></span> </td>
                            <td> <span class="title">GIRO DE NEGOCIO</span>  {{$laboral->giro_negocio}} <span >  </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">NÚMERO</span> [ {{$laboral->numero}} ]  <span class="title">Mz</span>  [ {{$laboral->manzana}} ]   <span class="title">Lote </span> [ {{$laboral->lote}} ]  <span class="title">Dpto</span> [ {{$laboral->dpto}} ] <span class="title">Int</span> [ {{$laboral->int}} ] <span class="title">Piso</span> [ {{$laboral->piso}} ] </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">DISTRITO</span> <span > {{$laboral->distrito}} </span> </td>
                            <td> <span class="title">PROVINCIA</span> {{$laboral->provincia}} <span > </span> </td>
                            <td> <span class="title">DEPARTAMENTO</span> {{$laboral->departamento}} <span class="title"> PAIS </span> {{$laboral->pais}} </td>
                        </tr>

                        <tr>
                            <td colspan="3"> <span class="title">REFERENCIA</span> {{$laboral->referencia}} <span > </span> </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">TÉLEFONO</span> <span > {{$laboral->telefono}} </span> </td>
                            <td> <span class="title">CELULAR</span> {{$laboral->cdelular}} <span > </span> </td>
                            <td> <span class="title">EMAIL</span> {{$laboral->email}} <span >  </span> </td>
                        </tr>

                </tbody>
                @else
                    <tbody>
                        <tr>
                            <td > <span class="title"> ESTADO LABORAL</span> {{$laboral->estado_laboral}} <span ></span>  </td>
                            @if ($laboral->estado_laboral=='OTROS')
                            <td > <span class="title"> ESPECIFICACIÓN</span> {{$laboral->especificacion}} <span ></span>  </td>   
                            @endif
                        </tr>
                    </tbody>
                @endif
                
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS FAMILIARES</th>
                    </tr>
                </thead>
                <tbody>
                          
                            <tr>
                                    <td> <span class="title">¿TIENE HIJOS?</span> {{$familiar->hijos}} <span ></td>
                                    @if ($familiar->hijos=='SI')
                                        <td> <span class="title">CUANTOS</span> <span > {{$familiar->numero}} </span> </td>
                                    @else
                                    <td><span >No cuenta con hijos actualmente</span> </td>    
                                    @endif
                                    
                            </tr>
                            <tr>
                                <td> <span class="title">¿TIENE CÓNYUGE?</span> {{$familiar->conyugue}} <span ></td>
                             @if ($familiar->conyugue=='SI')
                                <td> <span class="title">OCUPACIÓN</span> <span > {{$familiar->ocupacion}} </span> </td>
                             @else
                             <td> <span > No cuenta con cónyuge ó conviviente </span> </td> 
                             @endif
                                
                            </tr>
    
                            <tr>
                                <td colspan="3" >Detalle de familiares(cónyuge, conviviente e hijos) </td>
                            </tr>
                            
                            <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Parentesco</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Nacimiento</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">¿Socio?</th>
                                            </tr>
                                           
                                        </thead>
                                        <tbody>
                                            @foreach ($detallesfam as  $detalles)
                                                    <tr>
                                                        <td>{{$detalles->nombres}}</td>
                                                        <td>{{$detalles->documento}}</td>
                                                        <td>{{$detalles->parentesco}}</td>
                                                        <td>{{$detalles->nacimiento}}</td>
                                                        <td>{{$detalles->socio}}</td>
                                                    </tr>
                                            @endforeach           
                                        </tbody>
                                    </table>
                            </tr>
                        

                </tbody>
            </table>



            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS ADICIONALES</th>
                    </tr>
                </thead>
                <tbody>
                          
                            <tr>
                                    <td colspan="3">Completar esta sección solo si el/la solicitante menor de edad se haya inscrito a traves de un(a) representate</td> 
                            </tr>
    
                            <tr>
                                <td colspan="3" ><span class="title">NOMBRES Y APELLIDOS(representante)</span> {{$adicional->representante}}  </td>
                            </tr>
                            <tr>
                                <td><span class="title">DOCUMENTO</span> {{$adicional->documento}}</td>
                                <td><span class="title">N° </span> {{$adicional->numero}}</td>
                                <td><span class="title">RELACIÓN CON EL SOLICITANTE</span> {{$adicional->relacion}}</td>
                            </tr>
                            <tr>
                                <td colspan="3"> ***************************** Esta sección debe ser llenada por la Cooperativa *******************************</td>
                            </tr>
                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">OBLIGACIONES ASOCIATIVAS</th>
                    </tr>
                </thead>
                <tbody>
                          
                    <tr>
                            <td colspan="3"><span class="title">Inscripción</span> S/. {{$asociativa->inscripcion}} <span class="title">Aporte</span> S/. {{$asociativa->aporte}}  <span class="title">Fondo. Preven.</span> S/. {{$asociativa->fondo}}  <span class="title">Fondo Preven. Opc </span> S/. {{$asociativa->fondo_opcional}}  </td> 
                    </tr>
                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DECLARACIONES</th>
                    </tr>
                </thead>
                <tbody>
                          
                    <tr>
                        <td colspan="3"> <span class="title">Es sujeto obligado a informar a la UIF Perú</span> [ {{$declaracion->uif}}] </td>
                    </tr>
                    <tr>
                        <td colspan="3"> <span class="title">Es PEP(persona expuesta politicamente) </span> [ {{$declaracion->pep}}] </td>
                    </tr>
                    <tr>
                        <td><span class="title">Firma</span>____________________</td>
                        <td colspan="2" style="height: 70px;"> <div style="border: 1px solid; width: 100px; height: 70px;margin: 0 auto;"></div> </td>
                    </tr>

                    <tr>
                        <td><span class="title">Estado</span> {{$declaracion->estado}}</td>
                        <td colspan="2"><span class="title">Fecha</span> {{$declaracion->created_at}}</td>

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