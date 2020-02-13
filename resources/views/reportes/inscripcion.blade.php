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
                
                    <td rowspan="2" style="padding: 10px 0;"><span class="title"> <img src="{{env('RUTA')}}/public/img/logo.png" alt="" srcset=""></span> </td>
                </tr>
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;border: none;"><span class="title">Nro de Registro</span> 00001 <span class="title">AGENCIA</span> HUÀNUCO  </td>
                </tr>
            </table>


            <table style="width: 100%; margin: 4px 0 27px 0px;"   cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px;text-align: center">Sr. Presidente del Consejo de Administración de la Cooperativa de Ahorro
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
                            <span class="title">APELLIDOS Y NOMBRES</span> {{$persona->nombres}} {{$persona->apellidos}} <span > </span>
                            </td>
                        </tr>

                        <tr>
                            <td> <span class="title">DOCUMENTO </span> {{$cliente->tipo_documento}} </td>
                            <td> <span class="title">NUMERO DOC. </span> <span > {{$cliente->documento}} </span> </td>
                            <td> <span class="title">F. NACIMIENTO</span> <span > {{$persona->fecha_nacimiento}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">NACIONALIDAD</span> <span >{{$cliente->pais}} </span> </td> 
                        </tr>
                        <tr>
                            <td><span class="title">DEPARTAMENTO</span> {{$persona->nacimiento_departamento}} </td>
                            <td><span class="title">PROVINCIA</span> {{$persona->nacimiento_provincia}} </td>
                            <td><span class="title">DISTRITO</span>  {{$persona->nacimiento_distrito}} </td>
                        </tr>
                        <tr>
                            <td> <span class="title">ESTADO CIVIL</span> <span >{{$persona->estado_civil}}</span> </td>
                            <td> <span class="title">GENERO</span> {{$persona->genero}} <span > </span> </td>
                            <td> <span class="title">GRADO DE INSTRUCCION</span> {{$persona->grado_instruccion}} <span >  </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">OCUPACIÓN</span> <span > {{$persona->ocupacion}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">DIRECCIÓN</span> <span > {{$cliente->ubicacion_direccion_declarada}} </span> </td>
                        </tr>
                        <tr>
                            <td> <span class="title">NÚMERO</span> {{$cliente->ubicacion_numero}}</td>
                            <td> <span class="title">MZ</span>  {{$cliente->ubicacion_manzana}} </td>
                            <td> <span class="title">LOTE </span> {{$cliente->ubicacion_lote}}  </td>
                        </tr>
                        <tr>
                            <td> <span class="title">DPTO</span> {{$cliente->ubicacion_nro_departamento}}</td>
                            <td> <span class="title">INT</span> {{$cliente->ubicacion_interior}}</td>
                            <td> <span class="title">PISO </span>{{$cliente->ubicacion_piso}}</td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">DEPARTAMENTO</span> {{$departamento_domicilio->descripcion}} <span >  </span> </td>
                            <td> <span class="title">PROVINCIA</span> {{$provincia_domicilio->descripcion}} <span > </span> </td>
                            <td> <span class="title">DISTRITO</span> <span >{{$distrito_domicilio->descripcion}}</span> </td>                  
                        </tr>
                        
                        <tr>
                            <td colspan="3"> <span class="title">REFERENCIA</span> <span > {{$cliente->ubicacion_referencia}} </span> </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">TELÉFONO</span> <span >{{$cliente->telefono}} </span> </td>
                            <td> <span class="title">CELULAR</span> {{$cliente->celular}}  <span > </span> </td>
                            <td> <span class="title">EMAIL</span> {{$cliente->email}} <span >  </span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS LABORALES</th>
                    </tr>
                </thead>
                @if ($persona->estado_trabajo=='TRABAJA')
                    <tbody>
                        <tr>
                            <td > <span class="title">ESTADO LABORAL</span> {{$persona->estado_trabajo}}   </td>
                            <td  colspan="2"> <span class="title"> TIPO DE TRABAJADO</span> {{$trabajo->tipo_trabajador}}  </td>

                        </tr>

                        <tr>
                            <td colspan="2"> <span class="title">RAZÓN SOCIAL</span>  {{$trabajo->empresa_razon_social}}  <span ></span> </td>
                            <td > <span class="title">RANGO DE INGRESO MENSUAL </span> {{$trabajo->ingreso_mensual}} <span ></span> </td>
                        </tr>

                        <tr>
                            <td> <span class="title">CARGO</span>  {{$trabajo->cargo_ocupacion}} <span > </span> </td>
                            <td> <span class="title">FECHA INGRESO </span> {{$trabajo->fecha_ingreso}}<span ></span> </td>
                            <td> <span class="title">GIRO DE NEGOCIO</span>  {{$trabajo->empresa_giro_negocio}} <span >  </span> </td>
                        </tr> 
                        <tr>
                            <td><span class="title">NÚMERO</span>  {{$trabajo->empresa_numero}}   </td>
                            <td><span class="title">MANZANA</span>  {{$trabajo->empresa_manzana}}   </td>
                            <td><span class="title">LOTE</span>  {{$trabajo->empresa_lote}}  </td>
                        </tr>
                        <tr>
                            <td><span class="title">Nº DEPARTAMENTO</span>  {{$trabajo->empresa_dpto}}    </td>
                            <td><span class="title">INTERIOR</span>  {{$trabajo->empresa_int}}  </td>
                            <td><span class="title">PISO</span>  {{$trabajo->empresa_piso}}   </td>
                        </tr>
                        <tr>
                            <td colspan="3"><span class="title"> PAIS </span> {{$trabajo->empresa_pais}}</td>
                        </tr>
                        <tr>
                            <td> <span class="title">DEPARTAMENTO</span> {{$departamento_trabaja->descripcion}} </td>
                            <td> <span class="title">PROVINCIA</span> {{$provincia_trabaja->descripcion}} <span > </span> </td>
                            <td> <span class="title">DISTRITO</span> <span > {{$distrito_trabaja->descripcion}} </span> </td>
                        </tr>
 
                        <tr>
                            <td colspan="3"> <span class="title">REFERENCIA</span> {{$trabajo->empresa_referencia}} <span > </span> </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">TÉLEFONO</span> <span > {{$trabajo->empresa_telefono}} </span> </td>
                            <td> <span class="title">CELULAR</span> {{$trabajo->empresa_celular}} <span > </span> </td>
                            <td> <span class="title">EMAIL</span> {{$trabajo->empresa_email}} <span >  </span> </td>
                        </tr>

                </tbody>
                @else
                    <tbody>
                        <tr>
                            <td > <span class="title"> ESTADO LABORAL</span> {{$persona->estado_trabajo}} <span ></span>  </td>
                            @if ($persona->estado_trabajo=='OTROS')
                            <td > <span class="title"> ESPECIFICACIÓN</span> {{$persona->trabajo_especificacion}} <span ></span>  </td>   
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
                                    <td> <span class="title">¿TIENE HIJOS?</span> 
                                        
                                        @if (count($hijos)>0)
                                            SI
                                        @else
                                            NO
                                        @endif
                                    </td>
                                    @if (count($hijos)>0)
                                        <td> <span class="title">CUANTOS</span> <span > {{ count($hijos)}} </span> </td>
                                    @else
                                    <td><span >NO CUENTA CON HIJOS ACTUALMENTE</span> </td>    
                                    @endif
                                    
                            </tr>
                            <tr>
                                <td> 
                                    <span class="title">¿TIENE CÓNYUGE?</span> 
                                        @if (isset($conyuge))
                                            SI
                                        @else
                                            NO
                                        @endif
                                    <span >

                                </td>

                                @if (isset($conyuge))
                                    <td  colspan="2"> <span class="title">OCUPACIÓN</span> <span > {{$conyuge->ocupacion}} </span> </td>
                                @else
                                    <td colspan="2"> <span > NO CUENTA CON CÓNYUGE O CONVIVIENTE </span> </td> 
                                @endif
                                
                            </tr>
    
                            <tr>
                                <td  colspan="3" style="text-align: center">DETALLE DE FAMILIARES(CÓNYUGE, CONVIVIENTE E HIJOS) </td>
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
                                           
                                            @isset($conyuge)
                                                    <tr>
                                                        <td>{{$conyuge->nombres}}</td>
                                                        <td>{{$conyuge->documento}}</td>
                                                        <td>CONYUGE</td>
                                                        <td>{{$conyuge->fecha_nacimiento}}</td>
                                                        <td>{{$conyuge->socio }} </td>
                                                    </tr>        
                                            @endisset

                                            @foreach ($hijos as  $hijo)
                                                <tr>
                                                    <td>{{$hijo->nombres}}</td>
                                                    <td>{{$hijo->documento}}</td>
                                                    <td>HIJO</td>
                                                    <td>{{$hijo->fecha_nacimiento}}</td>
                                                    <td>{{$hijo->socio}} </td>
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
 
                            @if (isset($representante))
                            <tr>
                                <td colspan="3" ><span class="title">NOMBRES Y APELLIDOS(representante)</span> {{$representante->nombres}}  </td>
                            </tr>
                            <tr>
                                <td><span class="title">DOCUMENTO</span> {{$representante->tipo_documento}}</td>
                                <td><span class="title">N° </span> {{$representante->documento}}</td>
                                <td><span class="title">RELACIÓN CON EL SOLICITANTE</span> {{$representante->tipo_relacion}}</td>
                            </tr> 
                            <tr>
                                <td colspan="3" style="text-align: center"> ***************************** Esta sección debe ser llenada por la Cooperativa *******************************</td>
                            </tr>
                               
                            @else
                            <tr>
                                <td colspan="3" style="text-align: center">
                                     *************** EL SOLICITANTE NO ES MENOR DE EDAD ***************
                                </td>
                            </tr>
                            @endif
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
                            <td colspan="2"><span class="title">INSCRIPCIÓN</span> S/. {{$obligacion->inscripcion}}</td> 
                            <td><span class="title">APORTE</span> S/. {{$obligacion->aporte}} </td>
                    </tr>
                    <tr>
                            <td colspan="2"> <span class="title">FONDO. PREVENCIÓN.</span> S/. {{$obligacion->fondo}}  </td> 
                            <td> <span class="title">FONDO PREVENCIÓN OPCIONAL </span> S/. {{$obligacion->fondo_opcional}} </td>
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
                        <td colspan="3"> <span class="title">Es sujeto obligado a informar a la UIF Perú</span>
                        @if ($declaracion->uif == 0)
                            
                        [ NO ] 
                        @else
                           
                        [ SI ]  
                        @endif  
                    
                    </td>
                    </tr>
                    <tr>
                        <td colspan="3"> <span class="title">Es PEP(persona expuesta politicamente) </span>  
                            @if ($declaracion->pep== 0)
                            [ NO ] 
                            @else
                            [ SI ]  
                            @endif  
                        </td>
                    </tr>
                    <tr>
                        <td><span class="title">Firma</span>____________________</td>
                        <td colspan="2" style="height: 70px;"> <div style="border: 1px solid; width: 100px; height: 70px;margin: 0 auto;"></div> </td>
                    </tr>

                    <tr>
                        <td><span class="title">Estado</span>

                            @if ($cliente->estado=='1')
                                CREADO - PENDIENTE 
                            @endif 
                        
                        </td>
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