<template>
  <div class="row d-flex justify-content-center">
    <div class="col-md-12 p-0">
      <div class="nav-tabs style-tab-menu">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item col-md-2">
            <a class="nav-link active text-center " id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true" >Datos Personales</a>
          </li>

          <li class="nav-item col-md-2">
            <a class="nav-link text-center" id="laboral-tab" data-toggle="tab" href="#laboral"  role="tab" aria-controls="laboral" aria-selected="false" >Datos Laborales</a>
          </li>
          <li class="nav-item col-md-2">
            <a class="nav-link text-center" id="familiar-tab"  data-toggle="tab" href="#familiar" role="tab" aria-controls="familiar" aria-selected="false" >Datos Familiares</a>
          </li>
          <li class="nav-item col-md-2">
            <a  class="nav-link text-center" id="adicional-tab" data-toggle="tab"  href="#adicional"   role="tab" aria-controls="adicional" aria-selected="false" >Datos Adicionales</a>
          </li>
          <li class="nav-item col-md-2">
            <a class="nav-link text-center"  id="asociativa-tab"  data-toggle="tab"  href="#asociativa" role="tab" aria-controls="asociativa"  aria-selected="false" >Obligaciones asociativas</a>
          </li>
          <li class="nav-item col-md-2">
            <a  class="nav-link text-center" id="declaracion-tab"  data-toggle="tab"  href="#declaracion" role="tab" aria-controls="declaracion" aria-selected="false" >Declaracion</a>
          </li>
        </ul>
      </div>

      <div class="col-md-12 body-tabs">
        <div class="tab-content" id="myTabContent">
          <div  class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab"  >
             <div class="row">
               <div class="form-group col-md-2">
                <label>Tipo de Documento</label>
                <select v-model="form.cliente.tipo_documento" class="form-control">
                  <option value="DNI">DNI</option>
                  <option value="CE">CE</option>
                  <option value="PASAPORTE">PASAPORTE</option>
                </select>
              </div>
 
              <div class="form-group col-md-2">
                <label for="documento">Nro</label>
                <input type="text" class="form-control letter-5"  v-if="form.cliente.tipo_documento=='DNI'" v-model="form.cliente.documento"  @change="datosCliente()"  v-mask="{mask: '99999999'}" />
                <input type="text" class="form-control letter-5"  v-else-if="form.cliente.tipo_documento=='CE'" v-model="form.cliente.documento"  v-mask="{mask: '999999999999'}" />
                <input type="text" class="form-control letter-5"  v-else   disabled/>
              </div>

              <div class="form-group col-md-2">
                <label for="nacimiento">Fecha de Nacimiento</label>
                <date-pick v-model="form.natural.nacimiento" :months="mesEs" :weekdays="diaEs"></date-pick>
              </div>


              <div class="form-group col-md-3">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" v-model="form.natural.nombres" placeholder />
              </div>

              <div class="form-group col-md-3">
                <label for="apellidos">Apellidos</label>
                <input type="text"  class="form-control" v-model="form.natural.apellidos" placeholder />
              </div>

              <div class="form-group col-md-3">
                <label for="apellidos">Nacionalidad</label>
                <input type="text"  :maxlength="15" class="form-control" v-model="form.cliente.pais"/>
                      <!-- <input type="text" class="form-control" placeholder="Build Something Awesome" :maxlength="10" v-model="form.cliente.pais" /> -->
              </div>
              <div class="form-group col-md-3">
                <label for="apellidos">Departamento de Nacimiento</label>
                <input type="text" class="form-control" v-model="form.cliente.departamento" :maxlength="45"  />
              </div>
              <div class="form-group col-md-3">
                <label for="apellidos">Provincia de Nacimiento</label>
                <input type="text" class="form-control" v-model="form.cliente.provincia" :maxlength="45"  />
              </div>
              <div class="form-group col-md-3">
                <label for="apellidos">Distrito de Nacimiento</label>
                <input type="text" class="form-control" v-model="form.cliente.distrito" :maxlength="45"  />
              </div>



              <div class="form-group col-md-2">
                <label>Estado Civil</label>
                <select v-model="form.natural.estado_civil" :maxlength="25"  class="form-control">
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO">DIVORCIADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label>Genero</label>
                <select v-model="form.natural.genero" :maxlength="10" class="form-control">
                  <option value="FEMENINO">FEMENINO</option>
                  <option value="MASCULINO">MASCULINO</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label>Grado de Instrucción</label>
                <select v-model="form.natural.grado_instruccion" :maxlength="10" class="form-control">
                  <option value="PRIMARIA">PRIMARIA</option>
                  <option value="TECNICO">TECNICO</option>
                  <option value="SUPERIOR">SUPERIOR</option>
                  <option value="OTRO">OTRO</option>
                </select>
              </div>

              <div class="form-group  col-md-6">
                  <label>Ocupación</label>
                  <input type="text" v-model="form.natural.ocupacion" :maxlength="50" class="form-control" />
              </div>

            <div class="form-group col-md-6">
                <label>Domicilio Declarado</label>
                <input type="text" v-model="form.natural.direccion" :maxlength="70" class="form-control" />
            </div>

            <div class="form-group col-md-6">
                <label>Domicilio Reniec</label>
                <input type="text" v-model="form.natural.direccion_registros" :maxlength="70" class="form-control" disabled/>
            </div>

            <div class="form-group col-md-2">
                  <label>Número</label>
                  <input type="text" v-model="form.natural.numero" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Manzana</label>
                  <input type="text" v-model="form.natural.manzana" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Lote</label>
                  <input type="text" v-model="form.natural.lote" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Departamento</label>
                  <input type="text" v-model="form.natural.dpto" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Interior</label>
                  <input type="text" v-model="form.natural.int" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Piso</label>
                  <input type="text" v-model="form.natural.piso" :maxlength="5" class="form-control" />
              </div>

              <div class="form-group col-md-4">
                  <label>Distrito</label>
                  <input type="text" v-model="form.natural.domicilio_distrito" :maxlength="45" class="form-control" />
              </div>
              <div class="form-group col-md-4">
                  <label>Provincia</label>
                  <input type="text" v-model="form.natural.domicilio_provincia" :maxlength="45" class="form-control" />
              </div>
              <div class="form-group col-md-4">
                  <label>Departamento</label>
                  <input type="text" v-model="form.natural.domicilio_departamento" :maxlength="45" class="form-control" />
              </div>


              <div class="form-group col-md-3">
                  <label>Referencia</label>
                  <input type="text" v-model="form.natural.referencia" :maxlength="50" class="form-control" />
              </div>
              <div class="form-group col-md-3">
                  <label>Teléfono</label>
                  <input type="text" v-model="form.natural.telefono" :maxlength="10" class="form-control" />
              </div>

              <div class="form-group col-md-3">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-model="form.natural.celular"
                    class="form-control letter-5"
                    v-mask="{mask: '+51 999999999', greedy: true}"
                  />
              </div>

              <div class="form-group col-md-3">
                  <label>Email</label>
                  <input type="text" v-model="form.natural.correo" :maxlength="45" class="form-control" />
              </div>




            </div>

            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="laboral" role="tabpanel" aria-labelledby="laboral-tab">
            <div class="row">

              <div class="form-group col-md-2">
                <label>Estado Trabajador</label>
                <select v-model="form.laboral.estado_laboral" :maxlength="15" class="form-control">
                  <option value="TRABAJA">TRABAJA</option>
                  <option value="NO TRABAJA">NO TRABAJA</option>
                  <option value="JUBILADO">JUBILADO</option>
                  <option value="AMA DE CASA">AMA DE CASA</option>
                  <option value="ESTUDIANTE">ESTUDIANTE</option>
                  <option value="OTROS">OTROS</option>
                </select>
              </div>
              <div class="form-group col-md-4" v-if="form.laboral.estado_laboral=='OTROS'">
                <label>Especifique</label>
                <input type="text" class="form-control"  :maxlength="45" v-model="form.laboral.especificacion">
              </div>
              
              <div class="row col-md-12 m-0 p-0"  v-if="form.laboral.estado_laboral=='TRABAJA'">

                <div class="form-group col-md-3"> 
                  <label>Estado Trabajador</label>
                  <select v-model="form.laboral.tipo_trabajador" :maxlength="15" class="form-control">
                    <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                    <option value="DEPENDIENTE">DEPENDIENTE</option>
                    <option value="AGRICULTOR">AGRICULTOR</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Razon Social</label>
                  <input type="text" class="form-control" :maxlength="45" v-model="form.laboral.razon_social">
                </div>
                <div class="form-group col-md-2">
                  <label>Ingreso Mensual</label>
                  <select v-model="form.laboral.ingreso_mensual" :maxlength="25" class="form-control">
                    <option value="HASTA S/. 1000">HASTA S/. 1000</option>
                    <option value="S/. 1.001 a S/ 2.500">S/. 1000 a S/ 2.500</option>
                    <option value="S/. 2.500 a S/ 5.000">S/. 2.500 a S/ 5.000</option>
                    <option value="S/. 5.001 a S/ 10.000">S/. 5.001 a S/ 10.000</option>
                    <option value="S/ 10.001 A MÀS">S/ 10.001 A MÀS</option>
                  </select>
                </div>

                <div class="form-group col-md-2">
                  <label>Cargo/ Ocupaciòn</label>
                  <input type="text" class="form-control" :maxlength="20" v-model="form.laboral.cargo_ocupacion">
                </div>

                <div class="form-group col-md-2">
                  <label for="nacimiento">Fecha de Ingreso</label>
                  <date-pick v-model="form.laboral.fecha_ingreso" :months="mesEs" :weekdays="diaEs"></date-pick>
                </div>

                <div class="form-group col-md-6">
                  <label>GIRO DEL NEGOCIO</label>
                  <v-select
                    label="giro_negocio"
                    :options="giros"
                    :reduce="giros => giros.giro_negocio"
                    placeholder="Buscar Giro..."
                    v-model="form.laboral.giro_negocio"
                  >
                  </v-select>
                </div>

                <div class="form-group col-md-6">
                  <label for="nacimiento">Direcciòn</label>
                  <input type="text" class="form-control" :maxlength="45" v-model="form.laboral.direccion">
                </div>
                <div class="form-group col-md-2">
                  <label>Número</label>
                  <input type="text" v-model="form.laboral.numero" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Manzana</label>
                  <input type="text" v-model="form.laboral.manzana" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Lote</label>
                  <input type="text" v-model="form.laboral.lote" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Departamento</label>
                  <input type="text" v-model="form.laboral.dpto" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Interior</label>
                  <input type="text" v-model="form.laboral.int" :maxlength="5" class="form-control" />
              </div>
              <div class="form-group col-md-2">
                  <label>Piso</label>
                  <input type="text" v-model="form.laboral.piso" :maxlength="5" class="form-control" />
              </div>

              <div class="form-group col-md-3">
                  <label>Distrito</label>
                  <input type="text" v-model="form.laboral.distrito"  :maxlength="45" class="form-control" />
              </div>
              <div class="form-group col-md-3">
                  <label>Provincia</label>
                  <input type="text" v-model="form.laboral.provincia" :maxlength="45" class="form-control" />
              </div>
              <div class="form-group col-md-3">
                  <label>Departamento</label>
                  <input type="text" v-model="form.laboral.departamento" :maxlength="45" class="form-control" />
              </div>
              <div class="form-group col-md-3">
                  <label>Pais</label>
                  <input type="text" v-model="form.laboral.pais" :maxlength="20" class="form-control" />
              </div>


              <div class="form-group col-md-3">
                  <label>Referencia</label>
                  <input type="text" v-model="form.laboral.referencia" :maxlength="45" class="form-control" />
              </div>
              <div class="form-group col-md-3">
                  <label>Teléfono</label>
                  <input type="text" v-model="form.laboral.telefono" :maxlength="10" class="form-control" />
              </div>
 
              <div class="form-group col-md-3">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-model="form.laboral.celular"
                    class="form-control letter-5"
                    v-mask="{mask: '+51 999999999', greedy: true}"
                  />
              </div>

              <div class="form-group col-md-3">
                  <label>Email</label>
                  <input type="text" v-model="form.laboral.email" :maxlength="45" class="form-control" />
              </div>


              </div>
               


            </div>

            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="familiar" role="tabpanel" aria-labelledby="familiar-tab">

            <div class="row">
              <div class="form-group col-md-3">
                  <label>¿Tiene Hijos?</label>
                  <select v-model="form.familia.hijos" class="form-control">
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div> 
              <div class="form-group col-md-3" v-if="form.familia.hijos=='SI'">
                  <label>Nro de hijos</label>
                  <input type="text" class="form-control" :maxlength="2" v-model="form.familia.numero"  @change="hijosAsignacion()" >
              </div>

               <div class="form-group col-md-3">
                  <label>¿Tiene cónyuge ó conviviente?</label>
                  <select v-model="form.familia.conyugue" class="form-control" @change="conyugeAsignacion()">
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div> 

                <div class="form-group col-md-3" v-if="form.familia.conyugue=='SI'">
                  <label>Ocupación del cónyuge ó conviviente?</label>
                  <select v-model="form.familia.ocupacion" :maxlength="15" class="form-control">
                    
                    <option value="AMA DE CASA">AMA DE CASA</option>
                    <option value="DEPENDIENTE">DEPENDIENTE</option>
                    <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                  </select>
                </div> 


              <div class="col-md-12 mt-3" v-if="form.detalles.length>0">
                          <table class="table table-bordered table-striped table-sm">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>Dc. Identidad</th>
                                          <th>Apellidos y Nombres</th>
                                          <th>Parentesco</th>
                                          <th>Fecha de nacimiento</th>
                                          <th>¿Socio?</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="(row, index) in form.detalles" :key="index">
                                          <td>
                                              
                                              <template>
                                                  <button type="button" class="btn btn-danger btn-sm"  @click.prevent="clickRemoveFamiliar(index)">
                                                      <i class="fas fa-trash"></i>
                                                  </button>
                                              </template>
                                          </td>
                                          <td><input type="text" v-model="row.documento" class="form-control letter-5" v-mask="{mask: '99999999'}" @change="datosFamiliar(index)" /></td>
                                          <td><input type="text" v-model="row.nombres" :maxlength="45" class="form-control" /></td>
                                          <td>
                                            <select v-model="row.parentesco" class="form-control">
                                              
                                              <option value="CONYUGE">CONYUGE</option>
                                              <option value="CONVIVIENTE">CONVIVIENTE</option>
                                              <option value="HIJOS">HIJOS</option>
                                            </select>
                                          </td>
                                          <td>
                                            <date-pick v-model="row.nacimiento" :months="mesEs" :weekdays="diaEs"></date-pick>
                                          </td>
                                          <td>
                                            <select v-model="row.socio" class="form-control">
                                              
                                              <option value="SI">SI</option>
                                              <option value="NO">NO</option>
                                            </select>
                                          </td>
                                      </tr>                                
                                  </tbody>
                            </table>
              </div>

              <div class="col-md-12 mt-3">
                  <button type="button"  @click.prevent="clickAddFamiliar"  class="btn btn-outline-dark more-option w-100" >
                    <i class="fas fa-plus"></i> Agregar Familiar
                  </button>
              </div>



            </div>

            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>
          <div class="tab-pane fade" id="adicional" role="tabpanel" aria-labelledby="adicional-tab">
            
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                <label class="text-center" >Completar esta sección solo si el/la solicitante menor de edad se haya inscrito a través de un(a) representate</label>
              </div>
               <div class="form-group col-md-12">
                  <label>Apellidos y nombres del representate </label>
                  <input type="text" class="form-control" :maxlength="45" v-model="form.adicional.representante" >
                </div>
                 <div class="form-group col-md-4">
                  <label>Tipo de Documento</label>
                  <select v-model="form.adicional.documento" class="form-control">
                    
                    <option value="DNI">DNI</option>
                    <option value="CE">CE</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                  </select>
                </div>

              <div class="form-group col-md-4">
                <label for="documento">Nro</label>
                <input type="text" class="form-control letter-5" :maxlength="15" v-model="form.adicional.numero" />
              </div>
              <div class="form-group col-md-4">
                  <label>Relación con el solicitante</label>
                  <select v-model="form.adicional.relacion" class="form-control">
                    
                    <option value="PADRE">PADRE</option>
                    <option value="MADRE">MADRE</option>
                    <option value="OTRO">OTRO</option>
                  </select>
              </div>
              <div class="col-md-12 d-flex justify-content-center">
                <label class="text-center">********* Esta sección debe ser llenada por la Cooperativa **********</label>
              </div>
            </div>
            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="asociativa"  role="tabpanel"  aria-labelledby="asociativa-tab"  >
            <div class="row">
              <div class="form-group col-md-3">
                  <label>Inscripción </label>
                  <money   v-model="form.asociativa.inscripcion"  v-bind="money" class="form-control"  ></money>
              </div>
              <div class="form-group col-md-3">
                  <label>Aporte </label>
                   <money   v-model="form.asociativa.aporte" v-bind="money" class="form-control"  ></money>
              </div>
              <div class="form-group col-md-3">
                  <label>Fondo de prevencion social </label>
                  <money   v-model="form.asociativa.fondo"  v-bind="money" class="form-control"  ></money>
              </div>
              <div class="form-group col-md-3">
                  <label>Fondo de prevencion social opcional </label>
                  <money v-model="form.asociativa.fondo_opcional"  v-bind="money" class="form-control"  ></money>
              </div>
            </div> 
            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>
          <div class="tab-pane fade" id="declaracion" role="tabpanel" aria-labelledby="declaracion-tab" >
            <div class="row">
              <div class="form-group col-md-4">
                  <label>Es sujeto a informar a la UIF Perú</label>
                  <select v-model="form.declaracion.uif" class="form-control">
                    
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
              <div class="form-group col-md-4">
                  <label>Es PEP (persona expuesta politicamente)</label>
                  <select v-model="form.declaracion.pep" class="form-control">
                    
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
              <div class="form-group col-md-4">
                  <label>Estado</label>
                  <select v-model="form.declaracion.estado" class="form-control">
                    
                    <option value="ADMITIDO">ADMITIDO</option>
                    <option value="RECHAZADO">RECHAZADO</option>
                  </select>
                </div>
              <div class="form-group col-md-12">
                  <label>OBSERVACIONES</label>
                  <textarea class="form-control" v-model="form.declaracion.obervaciones" cols="auto" rows="5"></textarea>
                </div>
            </div>
            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange" @click.prevent="submit()" v-if="loading_submit=='0'">Registrar Solicitud</a>
                <div class="container-load-register" v-else ><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="spinner" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-spinner fa-w-16 fa-spin fa-lg"><path fill="currentColor" d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z" class=""></path></svg> <span class="fw6 f4 ml3">Registrando</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
              
  </div>
</template>

<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import { serviceNumber } from "../../../mixins/functions";
import vSelect from "vue-select";

const mesConf = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
];

const diaConf = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];

export default {
  name: 'natural',
  mixins: [serviceNumber],
  components: { DatePick , vSelect},
  props: ["tipo_persona"],

  data() {
    return {
      giros: [],
      resource: "clientes",
      clientes: [],
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      loading_submit:'0',
      districts: [],
      form: {},
      money: {
          decimal: ',',
          thousands: '.',
          prefix: 'S/. ',
          suffix: '',
          precision: 2,
          masked: false
      },
      notificationSystem: {
        options: {
          success: {
            position: "topRight"
          },
          error: {
            position: "topRight"
          }
        }
      },
      mesEs: mesConf,
      diaEs: diaConf
    };
  },
  async created() {
    // await this.$http.get(`/${this.resource}/datos/`).then(response => {
    //   this.all_departments = response.data.departments;
    //   this.all_provinces = response.data.provinces;
    //   this.all_districts = response.data.districts;
    // });

    await this.initForm();
    
    this.$http.get(`/evaluaciones/giro`).then(response => {
      this.giros = response.data;
    });
  },
  methods: {
    next() {
      $(".nav-tabs .active")
        .parent()
        .next("li")
        .find("a")
        .trigger("click");
    },
    previous() {
      $(".nav-tabs .active")
        .parent()
        .prev("li")
        .find("a")
        .trigger("click");
    },
    clickRemoveFamiliar(index) {
      this.form.detalles.splice(index, 1);
    },

    clickAddFamiliar() {
      this.form.detalles.push({
          nombres: "",
          documento:"",
          parentesco:"0",
          nacimiento:"",
          socio:"0",
      });
    },
    initForm() {
      this.form = {
        cliente:{
          tipo_documento: "DNI",
          documento: "",
          codigo: "",
          tipo_cliente: this.tipo_persona,
          pais: "",
          departamento: "",
          provincia: "",
          distrito: "",
          numero_registro: "",
          agencia: ""
        },
        natural:{
          nombres: "",
          apellidos: "",
          nacimiento: "",
          estado_civil: "SOLTERO",
          ocupacion: "",
          telefono: "",
          celular: "",
          direccion: "",
          direccion_registros: "",
          referencia: "",
          tipo_domicilio: 0,
          centro_laboral: "",
          direccion_laboral: "",
          genero: "MASCULINO",
          grado_instruccion:"PRIMARIA",
          numero: "",
          manzana: "",
          lote: "",
          dpto: "",
          int: "",
          piso:"",
          domicilio_distrito:"",
          domicilio_provincia:"",
          domicilio_departamento:"",
          correo:"",
        },
        laboral:{
          estado_laboral:"TRABAJA",
          tipo_trabajador:"INDEPENDIENTE",
          razon_social:"",
          ingreso_mensual: "HASTA S/. 1000",
          cargo_ocupacion:"",
          fecha_ingreso:"",
          giro_negocio: "",
          direccion: "",
          numero: "",
          manzana: "",
          dpto: "",
          int: "",
          piso:"",
          lote:"",
          distrito:"",
          provincia:"",
          departamento:"",
          pais:"",
          referencia:"",
          telefono:"",
          celular:"",
          email:"",
          especificacion:""
        
        },
         familia:{
          hijos: "SI",
          numero:0,
          conyugue:"NO",
          ocupacion:"",
        },

        detalles: [],

        adicional:{
          representante: "",
          documento: 0,
          numero:"",
          relacion: 0
        },
        asociativa:{
          inscripcion:"",
          aporte:"",
          fondo:"",
          fondo_opcional:"",

        },

        declaracion:{
          uif: "NO",
          pep:"NO",
          obervaciones:"",
          estado: "ADMITIDO",
          fecha: ""
        }

        
      };
    },
    conyugeAsignacion(){

      if(this.form.familia.conyugue=='SI'){
            this.form.detalles.push({
                nombres: "",
                documento:"",
                parentesco:"CONYUGE",
                nacimiento:"",
                socio:"0",
            });
      }

    },

    hijosAsignacion(){
      
      for (var i = 0; i < this.form.familia.hijos; i++) {
          this.form.detalles.push({
                  nombres: "",
                  documento:"",
                  parentesco:"HIJOS",
                  nacimiento:"",
                  socio:"0",
              });
        } 
    },

    resetForm() {
      this.initForm();
    },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.cliente.documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.natural.nombres = response.data["nombres"];
          me.form.natural.apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          me.initForm();
        });
    },

    datosFamiliar(index) {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.detalles[index].documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.detalles[index].nombres = response.data["nombres"]  + ' ' +  response.data["surnames"];
        })
        .catch(function(error) {
          console.log(error);
          me.initForm();
        });
    },


    submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }
      this.loading_submit=1;
      this.$http
        .post(`/${this.resource}/nuevo/natural`, this.form)
        .then(response => {
          if (response.data.success) {
            this.resetForm();
            this.$toast.success(
              "La solicitud fue admitida",
              "Exitoso",
              this.notificationSystem.options.success
            );

            this.loading_submit=0;
            this.$parent.getRecords();
            this.$parent.tipo = true;

            
          } else {
            // this.resetForm();
            this.$toast.error(
              "El cliente ya existe!",
              "Error",
              this.notificationSystem.options.error
            );
          }
        })
        // .catch(error => {
        //   if (error.response.status === 422) {
        //     this.errors = error.response.data;
        //   } else {
        //     this.$message.error(error.response.data.message);
        //   }
        // })
        .then(() => {
          // this.loading_submit = false;
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.vdpWithInput {
  width: 100%;
}
.vdpWithInput > input {
  font-size: 16px;
  display: block;
  width: 100%;
  box-sizing: border-box;
  -webkit-appearance: none;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0.1em 0.3em;
  padding: 5px 40px 6px 15px;
  border-radius: 4px;
  background: white;
  border-width: 1px;
  border-style: solid;
  border-color: rgb(224, 224, 224);
  border-image: initial;
  outline: 0px;
}
</style>
