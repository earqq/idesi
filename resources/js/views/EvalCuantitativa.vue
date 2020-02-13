<template >
<div class="">
    <div class="create_client_content">
      <section class="tabs_section">
        <div class="tabs_wrapper">
          <div class="tab"  @click="tab = 1" :class="[{complete : validateStep1 }, {selected: tab == 1}]" >
            <span>1</span>
            <p>DATOS TITULAR</p>
          </div>
          <div class="tab" v-if='cliente.conyuge' @click="validateStep1 ? tab = 2 : tabError()" :class="{selected: tab == 2}">
            <span>2</span>
            <p>DATOS CÓNYUGE</p>
          </div>
          <div class="tab" @click="validateStep1 ? tab = 3 : tabError()" :class="{selected: tab == 3}">
            <span>3</span>
            <p>DATOS HOGAR</p>
          </div>
        </div>
      </section>

      <section class="client_forms">
          <div class="client_forms_wrapper">
            <div v-show="tab == 1" class="form_step">

              <div class="form_step_wrapper">
                <h3 class="title">Ingreso del Negocio</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper " v-for="(val, index) in evaluacion.titular.ingresos_negocio" :key="index">
                    <div class="form_content">
                        <div class="group_form">

                          <div class="input_wrapper">
                            <label>Concepto</label>
                            <input  :disabled='index==0' type="text" v-model="val.concepto" />
                          </div>
                          
                          <div class="input_wrapper">
                            <label>Subtotal</label>
                            <vue-numeric  disabled='disabled'  :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].subtotal" v-bind:precision="2"></vue-numeric>
                          </div>
                        </div>

                        <div class="group_form small all" >
                          <div class="input_wrapper" :class="{require: !validateNegocioLunes && index==0}">
                            <label>Lunes</label> 
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].lunes" v-bind:precision="2"></vue-numeric>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateNegocioMartes && index==0}">
                            <label>Martes</label>
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].martes" v-bind:precision="2"></vue-numeric>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateNegocioMiercoles && index==0}">
                            <label>Miercoles</label>
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].miercoles" v-bind:precision="2"></vue-numeric>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateNegocioJueves && index==0}">
                            <label>Jueves</label>
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].jueves" v-bind:precision="2"></vue-numeric>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateNegocioViernes && index==0}">
                            <label>Viernes</label>
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].viernes" v-bind:precision="2"></vue-numeric>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateNegocioSabado && index==0}">
                            <label>Sabado</label>
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].sabado" v-bind:precision="2"></vue-numeric>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateNegocioDomingo && index==0}">
                            <label>Domingo</label>
                            <vue-numeric   :change="negocioIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.titular.ingresos_negocio[index].domingo" v-bind:precision="2"></vue-numeric>
                          </div>
                          
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Ingresos por 2da, 4ta y/o 5ta Categoria</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(ingreso,index) in evaluacion.titular.ingresos_por_categoria" v-bind:key="index">
                    <div class="form_content">
                      <div class="group_form">
                        <div class="input_wrapper">
                          <label>CONCEPTO</label>
                          <input type="text"  v-model="evaluacion.titular.ingresos_por_categoria[index].concepto"  />
                        </div>
                        <div class="input_wrapper">
                          <label>MONTO MENSUAL</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.ingresos_por_categoria[index].mes" v-bind:precision="2"></vue-numeric>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Giro de Negocio</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Tipo de Giro de Negocio</label>
                      <v-select
                        label="giro_negocio"
                        :options="giros"
                        disabled
                        :reduce="giros => giros.giro_negocio"
                        placeholder="Giro negocio.."
                        v-model="evaluacion.titular.giro_negocio"
                      ></v-select>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateNegocioMargen}">
                      <label>Margen de Costo</label>
                      <input type="text" v-model="evaluacion.titular.margen_costo" @keyup="cambioValor()"/>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateNegocioValor}">
                      <label>Valor Inventario</label>
                      <input type="text"  v-model="evaluacion.titular.valor_inventario"  />
                    </div>

                  </div>
                </div>
              </div>

              <div class="form_step_wrapper in_bottom" v-if=" evaluacion.titular.gasto_financiero.length > 0">
                <h3 class="title">Gasto Financiero Titular</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(gasto,index) in evaluacion.titular.gasto_financiero" v-bind:key="index">
                    <h3 class="title">Entidad {{index + 1}}</h3>
                    <div class="form_content">
                      <div class="group_form">
                          <div class="input_wrapper">
                            <label>Entidad</label>
                            <input  type="text" disabled='disabled' v-model="evaluacion.titular.gasto_financiero[index].entidad" />
                          </div>
                          <div class="input_wrapper" :class="{require: !validateSaldoCapitalTitular1}">
                            <label>Saldo Capital</label>
                            <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_financiero[index].saldo_capital" v-bind:precision="2"></vue-numeric>
                            <div class="message">Ingrese saldo capital de prestamo</div>
                          </div>
                          <div class="input_wrapper" :class="{require: !validateCuotaTitular1}">
                            <label>Cuota</label>
                            <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_financiero[index].cuota" v-bind:precision="2"></vue-numeric>
                            <div class="message">Ingrese cuota de prestamo</div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Gasto del Negocio</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper" :class="{require: !validateNegocioAlquiler}">
                      <label v-text="evaluacion.titular.gasto_negocio[0].entidad">Alquiler</label>
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_negocio[0].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper" :class="{require: !validateNegocioEmpleado}">
                      <label v-text="evaluacion.titular.gasto_negocio[1].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_negocio[1].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper" :class="{require: !validateNegocioImpuesto}">
                      <label v-text="evaluacion.titular.gasto_negocio[2].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_negocio[2].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper" :class="{require: !validateNegocioAgua}">
                      <label v-text="evaluacion.titular.gasto_negocio[3].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_negocio[3].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper" :class="{require: !validateNegocioLuz}">
                      <label v-text="evaluacion.titular.gasto_negocio[4].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_negocio[4].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                  </div>
                </div>
              </div>

              <div v-if='cliente.conyuge' class="form_buttons all">
                <a class="button_primary medium next" @click="validateStep1 ? next(1): tabError() ">
                  <span>SIGUIENTE</span>
                  <i class="material-icons-outlined">navigate_next</i>
                </a>
              </div>
              <div v-else class="form_buttons all">
                <a class="button_primary medium next" @click="validateStep1 ? next(2): tabError() ">
                  <span>SIGUIENTE</span>
                  <i class="material-icons-outlined">navigate_next</i>
                </a>
              </div>
            </div>

            <div v-show="tab == 2"  class="form_step">

              <div class="form_step_wrapper">

                <h3 class="title">Ingreso del Negocio</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(ingreso,index) in evaluacion.conyuge.ingresos_negocio" v-bind:key="index">
                    <div class="form_content">
                      <div class="group_form">

                        <div class="input_wrapper">
                          <label>Concepto</label>
                          <input type="text" v-model="evaluacion.conyuge.ingresos_negocio[index].concepto" />
                        </div>

                        <div class="input_wrapper">
                          <label>Lunes</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].lunes" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Martes</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].martes" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Miercoles</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].miercoles" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Jueves</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].jueves" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Viernes</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].viernes" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Sabado</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].sabado" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Domingo</label>
                          <vue-numeric   :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].domingo" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Subtotal</label>
                          <vue-numeric   disabled='disabled'  :change="conyugeIngresosSubtotal(index)" currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_negocio[index].subtotal" v-bind:precision="2"></vue-numeric>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Ingresos por 2da, 4ta y/o 5ta Categoria</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(ingresos,index) in evaluacion.conyuge.ingresos_por_categoria" v-bind:key="index">
                    <div class="form_content">
                      <div class="group_form">
                        <div class="input_wrapper">
                          <label>CONCEPTO</label>
                          <input type="text" v-model="evaluacion.conyuge.ingresos_por_categoria[index].concepto" />
                        </div>
                        <div class="input_wrapper">
                          <label>MONTO MENSUAL</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.ingresos_por_categoria[index].mes"  v-bind:precision="2"></vue-numeric>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Giro de Negocio</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Tipo de Giro de Negocio</label>
                      <v-select
                        label="giro_negocio"
                        :options="giros"
                        :reduce="giros => giros.giro_negocio"
                        placeholder="Buscar Giro..."
                        v-model="evaluacion.conyuge.giro_negocio"
                      ></v-select>
                    </div>

                    <div class="input_wrapper">
                      <label>Margen de Costo</label>
                      <input type="text"  v-model="evaluacion.conyuge.margen_costo_conyuge" />
                    </div>

                    <div class="input_wrapper">
                      <label>Valor Inventario</label>
                      <input type="text" v-model="evaluacion.conyuge.valor_inventario_conyuge" />
                    </div>

                  </div>
                </div>
              </div>


              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Gasto Financiero Cónyuge</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(gasto,index) in evaluacion.conyuge.gasto_financiero" v-bind:key="index">
                    <h3 class="title">
                      Entidad {{index + 1}}
                      <button v-if="index > 0" class="delete_section" type="button"  @click="clickRemoveEntidad(index)">
                        <i class="material-icons-outlined"> delete </i>
                      </button>
                    </h3>
                    <div class="form_content">
                      <div class="group_form">
                        <div class="input_wrapper">
                          <label>Entidad</label>
                             <v-select
                              label="nombre"
                              :options="entidades"
                              :reduce="entidades => entidades.nombre"
                              v-model="evaluacion.conyuge.gasto_financiero[index].entidad">
                              <span slot="no-options">
                                No se encontro giro de negocio
                              </span>
                            </v-select>  
                        </div>

                        <div class="input_wrapper">
                          <label>Saldo Capital</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_financiero[index].saldo_capital" v-bind:precision="2"></vue-numeric>
                        </div>

                        <div class="input_wrapper">
                          <label>Cuota</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_financiero[index].cuota" v-bind:precision="2"></vue-numeric>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button"  class="add_section" @click="clickAddEntidad" >
                  <span> AGREGAR ENTIDAD </span>
                  <i class="material-icons-outlined">add</i>  
                </button>
              </div>


              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Gasto del Negocio</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label v-text="evaluacion.titular.gasto_negocio[0].entidad">Alquiler</label>
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_negocio[0].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.titular.gasto_negocio[1].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_negocio[1].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.titular.gasto_negocio[2].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_negocio[2].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.titular.gasto_negocio[3].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_negocio[3].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.titular.gasto_negocio[4].entidad">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_negocio[4].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form_buttons in_bottom">
                <a class="button_inline_primary medium prev" @click="prev(2)">
                  <i class="material-icons-outlined">navigate_before</i>
                  <span>ATRAS</span>
                </a>
                <a class="button_primary medium next" @click="validateStep1 ? next(2): tabError() ">
                  <span>SIGUIENTE</span>
                  <i class="material-icons-outlined">navigate_next</i>
                </a>
              </div>

              
            </div>

            <div v-show="tab == 3" class="form_step">

              <div class="form_step_wrapper">
                <h3 class="title">Gasto del Hogar</h3>
                <div class="form_content">

                  <div class="group_form">

                    <div class="input_wrapper">
                      <label v-text="evaluacion.gastos_hogar[0].concepto">Alquiler</label>
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.gastos_hogar[0].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.gastos_hogar[1].concepto">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.gastos_hogar[1].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.gastos_hogar[2].concepto">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.gastos_hogar[2].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.gastos_hogar[3].concepto">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.gastos_hogar[3].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.gastos_hogar[4].concepto">Alquiler</label> 
                      <vue-numeric  currency="S/. " separator="," v-model="evaluacion.gastos_hogar[4].pago" v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                      <label v-text="evaluacion.gastos_hogar[5].concepto">Alquiler</label> 
                      <vue-numeric disabled='disabled'  currency="S/. " separator="," v-model="evaluacion.gastos_hogar[5].pago" v-bind:precision="2"></vue-numeric>
                    </div>

                  </div>
                </div>
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Propiedades</h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(propiedades,index) in evaluacion.propiedades" v-bind:key="index">
                    <h3 class="title">Propiedad {{index + 1}}
                      <button v-if="index > 0" class="delete_section" type="button"  @click="clickRemovePropiedad(index)">
                        <i class="material-icons-outlined"> delete </i>
                      </button>
                    </h3>
                    
                    <div class="form_content">
                      <div class="group_form">
                        <div class="input_wrapper">
                          <label>Concepto</label>
                          <input type="text"  v-model="evaluacion.propiedades[index].concepto" />
                        </div>
                        <div class="input_wrapper">
                          <label>Valor del bien</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.propiedades[index].valor_estimado"  v-bind:precision="2"></vue-numeric>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button"  class="add_section" @click="clickAddPropiedad">
                  <span> AGREGAR PROPIEDAD </span>
                  <i class="material-icons-outlined">add</i>  
                </button>
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Gasto Financiero del Titular (Personales) </h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(gasto,index) in evaluacion.titular.gasto_financiero_personal" v-bind:key="index">
                    <h3 class="title">Entidad {{index + 1}}
                      <button v-if="index > 0" class="delete_section" type="button"  @click="clickRemoveEntidadTitular(index)">
                        <i class="material-icons-outlined"> delete </i>
                      </button>
                    </h3>
                    <div class="form_content">
                      <div class="group_form">
                        <div class="input_wrapper">
                          <label>Entidad</label>
                          <v-select
                              label="nombre"
                              :options="entidades"
                              :reduce="entidades => entidades.nombre"
                              v-model="evaluacion.titular.gasto_financiero_personal[index].entidad">
                              <span slot="no-options">
                                No se encontro giro de negocio
                              </span>
                            </v-select>  
                        </div>
                        <div class="input_wrapper">
                          <label>Saldo Capital</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_financiero_personal[index].saldo_capital"  v-bind:precision="2"></vue-numeric>
                        </div>
                        <div class="input_wrapper">
                          <label>Cuota</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.titular.gasto_financiero_personal[index].cuota"  v-bind:precision="2"></vue-numeric>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>
                <button type="button"  class="add_section" @click="clickAddEntidadTitular" >
                  <span> AGREGAR ENTIDAD </span>
                  <i class="material-icons-outlined">add</i>  
                </button>
              </div>

              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Gasto Financiero del cónyuge o Conviviente (Personales) </h3>
                <div class="form_list no_border">
                  <div class="sub_step_wrapper" v-for="(gasto,index) in evaluacion.conyuge.gasto_financiero_personal" v-bind:key="index">
                    <h3 class="title">Entidad {{index + 1}}
                        <button v-if="index > 0" class="delete_section" type="button"  @click="clickRemoveEntidadconyuge(index)">
                        <i class="material-icons-outlined"> delete </i>
                      </button>
                    </h3>
                    <div class="form_content">
                      <div class="group_form">
                        <div class="input_wrapper">
                          <label>Entidad</label>
                          <v-select
                              label="nombre"
                              :options="entidades"
                              :reduce="entidades => entidades.nombre"
                              v-model="evaluacion.conyuge.gasto_financiero_personal[index].entidad">
                              <span slot="no-options">
                                No se encontro giro de negocio
                              </span>
                            </v-select>   
                        </div>
                        <div class="input_wrapper">
                          <label>Saldo Capital</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_financiero_personal[index].saldo_capital"  v-bind:precision="2"></vue-numeric>
                        </div>
                        <div class="input_wrapper">
                          <label>Cuota</label>
                          <vue-numeric  currency="S/. " separator="," v-model="evaluacion.conyuge.gasto_financiero_personal[index].cuota"  v-bind:precision="2"></vue-numeric>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button"  class="add_section" @click="clickAddEntidadconyuge">
                  <span> AGREGAR ENTIDAD </span>
                  <i class="material-icons-outlined">add</i>  
                </button>
              </div>

              <div class="form_buttons">
                  <a class="button_inline_primary medium prev" @click="prev(3)">
                    <i class="material-icons-outlined">navigate_before</i>
                    <span>ATRAS</span>
                  </a>
                  <a class="button_primary medium next" @click.prevent="validateStep1 ? registrar(): tabError()" :class="{loading: loading}">
                    <div class="load_spinner"></div>
                  <span>FINALIZAR</span>
                  <i class="material-icons-outlined">check</i>
                </a>
                </div>

            </div>
          </div>
     </section>
    </div>

 
</div>
</template>
<script>
import vSelect from "vue-select";
import { serviceNumber } from "../mixins/functions";
import VueNumeric from 'vue-numeric';
import { toastOptions } from '../constants.js';

export default {
  mixins: [serviceNumber],
  components: {
    vSelect,
    VueNumeric
  },
  data() {
    return {
      giros: [],
      tab: 1,
      entidades:[], 
      cliente:0,
      loading: false,
      evaluacion: {
        prestamo_id: this.$route.params.prestamo,
        tipo_persona :this.$route.params.persona,
        propuesta: {
          producto: "",
          monto: 1,
          numero_cuotas: 0,
          cuotas: 0
        },
        probabilidad_infocorp: 0,
        gastos_hogar: [
          {
            concepto: "LUZ",
            pago: 0
          },
          {
            concepto: "AGUA",
            pago: 0
          },
          {
            concepto: "TELÉFONO FIJO",
            pago: 0
          },
          {
            concepto: "ALQUILER",
            pago: 0
          },
          {
            concepto: "ALIMENTACIÓN Y TRANSPORTE",
            pago: 0
          },
          {
            concepto: "EDUCACIÓN",
            pago: 0
          }
        ],
        propiedades: [
          {
            concepto: "",
            valor_estimado: 0
          },
          {
            concepto: "",
            valor_estimado: 0
          }
        ],
        titular: {
          ingresos_negocio: [
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            },
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            }
          ],

          ingresos_por_categoria: [
            {
              concepto: "",
              mes: ""
            },
            {
              concepto: "",
              mes: ""
            }
          ],
          gasto_financiero: [
            
          ],
          gasto_financiero_personal: [
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            }
          ],
          gasto_negocio: [
            {
              entidad: "ALQUILER",
              pago: 0
            },
            {
              entidad: "EMPLEADOS",
              pago: 0
            },
            {
              entidad: "IMPUESTOS",
              pago: 0
            },
            {
              entidad: "AGUA",
              pago: 0
            },
            {
              entidad: "LUZ",
              pago: 0
            }
          ],
          giro_negocio: "",
          margen_costo: 0,
          valor_inventario: 0
        },
        conyuge: {
          ingresos_negocio: [
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            },
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            }
          ],

          ingresos_por_categoria: [
            {
              concepto: "",
              mes: ""
            },
            {
              concepto: "",
              mes: ""
            }
          ],
          giro_negocio: "",
          margen_costo: "",
          valor_inventario: 0,
          gasto_financiero: [
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            } 
          ],
          gasto_financiero_personal: [
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            }
          ],
          gasto_negocio: [
            {
              entidad: "ALQUILER",
              pago: 0
            },
            {
              entidad: "EMPLEADOS",
              pago: 0
            },
            {
              entidad: "IMPUESTOS",
              pago: 0
            },
            {
              entidad: "AGUA",
              pago: 0
            },
            {
              entidad: "LUZ",
              pago: 0
            }
          ]
        }
      }
    };
  },

  mounted() {
    this.$http
      .get(`/prestamos/` + this.$route.params.prestamo)
      .then(response => {
        this.cliente=response.data.cliente
        this.evaluacion.propuesta.producto = response.data.producto;
        this.evaluacion.propuesta.monto = response.data.importe;
        this.evaluacion.propuesta.cuotas = response.data.cuotas;
        this.evaluacion.propuesta.plazo = response.data.plazo;
      });

    this.$http.get(`/extras/giro`).then(response => {
      this.giros = response.data;
    });

    this.$http.get(`/extras/entidades`).then(response => {
      this.entidades = response.data;
    });

    this.$http
      .get(
        `/analisis/datosCualitativas/`+this.$route.params.prestamo
      )
      .then(response => {
        console.log(response)
        //Total de costo en educacion
        response.data.familiar.hijos.map(element=>{
          this.evaluacion.gastos_hogar[5].pago+=parseFloat(element.costo)
        })
        // entidades financieras
        response.data.central_riesgo.map(element=>{
          if(element.entidad_financiera){

            this.evaluacion.titular.gasto_financiero.push({
              entidad: element.entidad_financiera,
              saldo_capital: 0,
              cuota: 0
            })
          }
        })
        this.evaluacion.titular.ingresos_negocio[0].concepto=response.data.principal.fuente_ingreso
        this.evaluacion.titular.giro_negocio=response.data.principal.fuente_ingreso
      });
  },
    computed: {

    validateNegocioLunes() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].lunes).length > 0
    },
    validateNegocioMartes() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].martes).length > 0
    },
    validateNegocioMiercoles() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].miercoles).length > 0
    },
    validateNegocioJueves() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].jueves).length > 0
    },
    validateNegocioViernes() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].viernes).length > 0
    },
    validateNegocioSabado() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].sabado).length > 0
    },
    validateNegocioDomingo() {
      return  String(this.evaluacion.titular.ingresos_negocio[0].domingo).length > 0
    },

    validateNegocioMargen() {
      return  this.evaluacion.titular.margen_costo.length > 0
    },

    validateNegocioValor() {
      return  this.evaluacion.titular.valor_inventario.length > 0
    },

    validateNegocioAlquiler() {
      return  String(this.evaluacion.titular.gasto_negocio[0].pago).length > 0
    },

      validateNegocioEmpleado() {
      return  String(this.evaluacion.titular.gasto_negocio[1].pago).length > 0
    },

      validateNegocioImpuesto() {
      return  String(this.evaluacion.titular.gasto_negocio[2].pago).length > 0
    },

      validateNegocioAgua() {
      return  String(this.evaluacion.titular.gasto_negocio[3].pago).length > 0
    },

      validateNegocioLuz() {
      return  String(this.evaluacion.titular.gasto_negocio[4].pago).length > 0
    },

    validateSaldoCapitalTitular1(){
        return  String(this.evaluacion.titular.gasto_financiero[0].saldo_capital).length > 1
    },
    validateCuotaTitular1(){
        return  String(this.evaluacion.titular.gasto_financiero[0].cuota).length > 1
    },

    validateStep1() {
      if(this.evaluacion.titular.gasto_financiero.length>0 )
      {
                return  this.validateNegocioLunes &&
                        this.validateNegocioMartes &&
                        this.validateNegocioMiercoles &&
                        this.validateNegocioJueves &&
                        this.validateNegocioViernes &&
                        this.validateNegocioSabado &&
                        this.validateNegocioDomingo &&
                        this.validateNegocioMargen &&
                        this.validateNegocioValor &&
                        this.validateNegocioAlquiler &&
                        this.validateNegocioEmpleado &&
                        this.validateNegocioImpuesto &&
                        this.validateNegocioAgua &&
                        this.validateNegocioLuz &&
                        this.validateSaldoCapitalTitular1 &&
                        this.validateCuotaTitular1
      }else{

        return  this.validateNegocioLunes &&
                this.validateNegocioMartes &&
                this.validateNegocioMiercoles &&
                this.validateNegocioJueves &&
                this.validateNegocioViernes &&
                this.validateNegocioSabado &&
                this.validateNegocioDomingo &&
                this.validateNegocioMargen &&
                this.validateNegocioValor &&
                this.validateNegocioAlquiler &&
                this.validateNegocioEmpleado &&
                this.validateNegocioImpuesto &&
                this.validateNegocioAgua &&
                this.validateNegocioLuz
      }
    }
  },
  methods: {
    tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },

    next(index) {
      window.scrollTo(0,0)
      this.tab = index + 1
    },
    prev(index) {
      window.scrollTo(0,0)
      this.tab = index - 1
    },
    cambioValor(){
      if(this.evaluacion.titular.margen_costo>0){
          this.evaluacion.titular.valor_inventario = ''
      }else{
          this.evaluacion.titular.valor_inventario = 0
      }
    },
    clickAddEntidad() { 
      this.evaluacion.conyuge.gasto_financiero.push({
              entidad: "",
              saldo_capital: 0,
              cuota: 0
      });
    },
    clickRemoveEntidad(index) {
      this.evaluacion.conyuge.gasto_financiero.splice(index, 1);
    },

    clickAddEntidadTitular() { 
      this.evaluacion.titular.gasto_financiero_personal.push({
              entidad: "",
              saldo_capital: 0,
              cuota: 0
      });
    },
    clickRemoveEntidadTitular(index) {
      this.evaluacion.titular.gasto_financiero_personal.splice(index, 1);
    },

    clickAddEntidadconyuge() { 
      this.evaluacion.conyuge.gasto_financiero_personal.push({
              entidad: "",
              saldo_capital: 0,
              cuota: 0
      });
    },
    clickRemoveEntidadconyuge(index) {
      this.evaluacion.conyuge.gasto_financiero_personal.splice(index, 1);
    },


    clickAddPropiedad() { 
      this.evaluacion.propiedades.push({
            concepto: "",
            valor_estimado: 0
      });
    },
    clickRemovePropiedad(index) {
      this.evaluacion.propiedades.splice(index, 1);
    },
    
    negocioIngresosSubtotal(index) {
      this.evaluacion.titular.ingresos_negocio[index].subtotal =
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].lunes, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].martes, 2) +
        parseFloat(
          this.evaluacion.titular.ingresos_negocio[index].miercoles,
          2
        ) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].jueves, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].viernes, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].sabado, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].domingo, 2);
    },
    registrar() { 

      this.loading= true
      axios.post("/analisis/cuantitativa", this.evaluacion).then(response => {
        this.loading=false
        this.$toast.success(
            "La Evalación fue realizada",
            "Exitoso",
            toastOptions.success
          ) 
        this.$router.push({ name: 'perfil', params: { id: this.cliente.id}})
      }).catch(err=>{
          this.loading=false
          this.$toast.error(
            "Error Evaluación",
            "Error",
            toastOptions.error
          )
      }); 
    },
 
    conyugeIngresosSubtotal(index) {
      this.evaluacion.conyuge.ingresos_negocio[index].subtotal =
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].lunes, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].martes, 2) +
        parseFloat(
          this.evaluacion.conyuge.ingresos_negocio[index].miercoles,
          2
        ) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].jueves, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].viernes, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].sabado, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].domingo, 2);
    }
  }
};
</script>

<style lang="css" scoped>
.input-w {
  width: 100%;
}
.form-group label {
  margin-bottom: 0;
  color: #000000;
  font-weight: 500;
}

.card-header {
  padding: 0.2rem 1.25rem !important;
}
.card-body {
  padding: 10px 0px !important;
  margin: 0 !important;
}
.form-control {
  height: 27px !important;
  font-size: 14px !important;
}

.title-table {
  background: #dfdede;
  text-align: center;
  border: 1px solid #bababa;
}
</style>