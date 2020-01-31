<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EVALUACION CUANTITATIVA</title>
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
                    <td  colspan="2" valign="middle" align="left"  style="width: 80%;border: none;"><span>EVALUACIÓN CUANTITATIVA DEL PRESTAMO</span></td>
                
                    <td rowspan="2" style="padding: 10px 0;"><span class="title"> ***  Logo ****</span> </td>
                </tr>
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;border: none;"><span class="title"></span>   <span class="title"></span>  </td>
                </tr>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS DEL TITULAR</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- ingreso negocio -->
                        <tr>
                            <td colspan="3"> <span class="title">INGRESOS DE NEGOCIO</td>
                         </tr>

                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Concepto</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Lun.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Mar.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Mier.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Juev.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Vier.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Sáb.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Dom.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Sub. Total</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i <= 1; $i++)
                                        @if ($cuantitativa->titular['ingresos_negocio'][$i]['concepto'])
                                            
                                        
                                            <tr>
                                                <td>{{$cuantitativa->titular['ingresos_negocio'][$i]['concepto']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['lunes']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['martes']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['miercoles']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['jueves']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['viernes']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['sabado']}}</td>
                                                <td>S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['domingo']}}</td>
                                                <td style="background: #009688;color:#fff">S/. {{$cuantitativa->titular['ingresos_negocio'][$i]['subtotal']}}</td>
                                            </tr>
                                            @endif
                                        @endfor
                                       
                                    </tbody>
                                </table>
                             </td>
                         </tr>
                         
                         

                         <!-- ingresos categoria -->
                         <tr>
                            <td colspan="3"> <span class="title">INGRESOS POR 2DA, 4TA Y/O 5TA CATEGORIA</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Concepto</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Monto mensual.</th> 
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i <=1; $i++)
                                        @if ($cuantitativa->titular['ingresos_por_categoria'][$i]['concepto'])
                                        <tr>
                                            <td>{{$cuantitativa->titular['ingresos_por_categoria'][$i]['concepto']}}</td>
                                            <td>{{$cuantitativa->titular['ingresos_por_categoria'][$i]['mes']}}</td> 
                                        </tr>
                                        @endif
                                        @endfor
                                        
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                         <!-- giro del negocio -->
                         <tr>
                             <td><span class="title">GIRO DEL NEGOCIO </span> <span> {{$cuantitativa->titular['giro_negocio']}} </span></td>
                             <td><span class="title">MARGEN COSTO </span> <span> {{$cuantitativa->titular['margen_costo']}} </span></td>
                             <td><span class="title">VALOR INVENTARIO </span> <span> {{$cuantitativa->titular['valor_inventario']}} </span></td>
                         </tr>
                         <!-- GASTOS FINANCIEROS -->
                         <tr>
                            <td colspan="3"> <span class="title">GASTO FINANCIERO TITULAR</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Saldo Capital</th> 
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cuota</th> 
                                        </tr>
                                       
                                    </thead>
                                    <tbody> 
                                        @foreach ($cuantitativa->titular['gasto_financiero'] as $cuant)
                                            <tr>
                                                <td>{{$cuant['entidad']}}</td>
                                                <td>S/. {{$cuant['saldo_capital']}}</td> 
                                                <td>S/. {{$cuant['cuota']}}</td> 
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                         <!-- gasto del negocio -->
                         <tr>
                            <td colspan="3"> <span class="title">GASTO DEL NEGOCIO</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Saldo Capital</th> 
                                         </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach($cuantitativa->titular['gasto_negocio'] as $gasto_tit)
                                        <tr>
                                            <td>{{$gasto_tit['entidad']}}</td>
                                            <td>S/. {{$gasto_tit['pago']}}</td>  
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                </tbody>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS DEL CÓNYUGE</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- ingreso negocio -->
                        <tr>
                            <td colspan="3"> <span class="title">INGRESOS DE NEGOCIO</td>
                         </tr>

                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Concepto</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Lun.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Mar.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Mier.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Juev.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Vier.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Sáb.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Dom.</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Sub. Total</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>                                       
                                        @foreach($cuantitativa->conyuge['ingresos_negocio'] as $conyuge_ingreso)
                                        @if ($conyuge_ingreso['concepto'])
                                         
                                         
                                        <tr>
                                            <td>{{$conyuge_ingreso['concepto']}}</td>
                                            <td>S/. {{$conyuge_ingreso['lunes']}}</td>
                                            <td>S/. {{$conyuge_ingreso['martes']}}</td>
                                            <td>S/. {{$conyuge_ingreso['miercoles']}}</td>
                                            <td>S/. {{$conyuge_ingreso['jueves']}}</td>
                                            <td>S/. {{$conyuge_ingreso['viernes']}}</td>
                                            <td>S/. {{$conyuge_ingreso['sabado']}}</td>
                                            <td>S/. {{$conyuge_ingreso['domingo']}}</td>
                                            <td style="background: #009688;color:#fff">S/. {{$conyuge_ingreso['subtotal']}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr>
                         <!-- ingresos categoria -->
                         <tr>
                            <td colspan="3"> <span class="title">INGRESOS POR 2DA, 4TA Y/O 5TA CATEGORIA</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Concepto</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Monto mensual.</th> 
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach($cuantitativa->conyuge['ingresos_por_categoria'] as $ingreso_cat)
                                        @if ($ingreso_cat['concepto'])
                                          
                                        <tr>
                                            <td>{{$ingreso_cat['concepto']}}</td>
                                            <td>S/. {{$ingreso_cat['mes']}}</td> 
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                         <!-- giro del negocio -->
                         <tr>
                            <td><span class="title">GIRO DEL NEGOCIO </span> <span> {{$cuantitativa->conyuge['giro_negocio']}} </span></td>
                            <td><span class="title">MARGEN COSTO </span> <span> {{$cuantitativa->conyuge['margen_costo']}} </span></td>
                            <td><span class="title">VALOR INVENTARIO </span> <span> {{$cuantitativa->conyuge['valor_inventario']}} </span></td>
                        </tr>
                         <!-- GASTOS FINANCIEROS -->
                         <tr>
                            <td colspan="3"> <span class="title">GASTO FINANCIERO CÓNYUGE</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Saldo Capital</th> 
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cuota</th> 
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach($cuantitativa->conyuge['gasto_financiero'] as $conyuge_gasto)
                                            @if ($conyuge_gasto['entidad'])
                                            
                                            <tr>
                                                <td>{{$conyuge_gasto['entidad']}}</td>
                                                <td>S/. {{$conyuge_gasto['saldo_capital']}}</td> 
                                                <td>S/. {{$conyuge_gasto['cuota']}}</td> 
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                         <!-- gasto del negocio -->
                         <tr>
                            <td colspan="3"> <span class="title">GASTO DE NEGOCIO DEL CÓNYUGE</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Saldo Capital</th> 
                                         </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach($cuantitativa->conyuge['gasto_negocio'] as $conyuge_gasto)
                                        <tr>
                                            <td>{{$conyuge_gasto['entidad']}}</td>
                                            <td>S/. {{$conyuge_gasto['pago']}}</td>  
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                </tbody>
            </table>
 
            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS DEL HOGAR</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- ingreso negocio -->
                        <tr>
                            <td colspan="3"> <span class="title">GASTOS SERVICIO DEL HOGAR</td>
                         </tr>

                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Concepto</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Pago</th>
                                         </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach($cuantitativa->gastos_hogar as $gastos_hogar)
                                        <tr>
                                            <td>{{$gastos_hogar['concepto']}}</td>
                                            <td>S/. {{$gastos_hogar['pago']}}</td> 
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                             </td>
                         </tr>
                         <!-- ingresos categoria -->
                         <tr>
                            <td colspan="3"> <span class="title">PROPIEDADES</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Concepto</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Pago</th> 
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach($cuantitativa->propiedades as $propiedades)
                                        @if ($propiedades['concepto'])
                                         
                                        <tr>
                                            <td>{{$propiedades['concepto']}}</td>
                                            <td>S/. {{$propiedades['valor_estimado']}}</td> 
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                         
                         <tr>
                            <td colspan="3"> <span class="title">GASTO FINANCIERO PERSONAL DEL TITULAR</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px"> Saldo Capital</th>   
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px"> Cuota</th>   
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach ($cuantitativa->titular['gasto_financiero_personal'] as $cuant)
                                        <tr>
                                            <td>{{$cuant['entidad']}}</td>
                                            <td>S/. {{$cuant['saldo_capital']}}</td> 
                                            <td>S/. {{$cuant['cuota']}}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr
 
                         <tr>
                            <td colspan="3"> <span class="title">GASTO FINANCIERO PERSONAL CÓNYUGE O CONVIVIENTE</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px"> Saldo Capital</th>   
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px"> Cuota</th>   
                                         </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach ($cuantitativa->conyuge['gasto_financiero_personal'] as $cuant)
                                        <tr>
                                            <td>{{$cuant['entidad']}}</td>
                                            <td>S/. {{$cuant['saldo_capital']}}</td> 
                                            <td>S/. {{$cuant['cuota']}}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             </td>
                         </tr>

                </tbody>
            </table>

</body>
</html>