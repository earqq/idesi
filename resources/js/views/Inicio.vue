<template>
  <div class="container-general">
      <div class="row m-0 dashboard">

              <div class="col-md-9">
                  <div class="row m-0">
                       <div class="col-md-12 info"> 
                            <div class="row m-0">


                                <div class="col-md-3">
                                    <div class="row h-100">
                                        <div class="col-md-4 d-flex flex-column justify-content-center text-center icon ">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <div class="col-md-8  d-flex flex-column justify-content-center text">
                                            <p class="title">Totales</p>
                                            <p>1452</p>
                                        </div>
                                    </div>
                                </div>


                                   <div class="col-md-3">
                                    <div class="row h-100">
                                        <div class="col-md-4 d-flex flex-column justify-content-center text-center icon ">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <div class="col-md-8  d-flex flex-column justify-content-center text">
                                            <p class="title">Aceptados</p>
                                            <p>1452</p>
                                        </div>
                                    </div>
                                </div>


                                   <div class="col-md-3">
                                    <div class="row h-100">
                                        <div class="col-md-4 d-flex flex-column justify-content-center text-center icon ">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <div class="col-md-8  d-flex flex-column justify-content-center text">
                                            <p class="title">Observados</p>
                                            <p>1452</p>
                                        </div>
                                    </div>
                                </div>


                                   <div class="col-md-3">
                                    <div class="row h-100">
                                        <div class="col-md-4 d-flex flex-column justify-content-center text-center icon ">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <div class="col-md-8  d-flex flex-column justify-content-center text">
                                            <p class="title">Rechazados</p>
                                            <p>1452</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                      <div class="col-md-12 loans">
                           <h1>Prestamos</h1> 
                            <table style="width:100%">
                                <tr>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Gian Marco Albornoz Rimas</td>
                                    <td>Pendiente</td>
                                    <td> <button class="btn btn-success" style="width:50%"> Ver Prestamo</button></td>
                                </tr>
                                <tr>
                                    <td>Gian Marco Albornoz Rimas</td>
                                    <td>Rechazado</td>
                                    <td> <button class="btn btn-success" style="width:50%"> Ver Prestamo</button></td>
                                </tr>
                                 <tr>
                                    <td>Gian Marco Albornoz Rimas</td>
                                    <td>Observado</td>
                                    <td> <button class="btn btn-success" style="width:50%"> Ver Prestamo</button></td>
                                </tr>
                                 <tr>
                                    <td>Gian Marco Albornoz Rimas</td>
                                    <td>Pendiente</td>
                                    <td> <button class="btn btn-success" style="width:50%"> Ver Prestamo</button></td>
                                </tr>
                                </table>
                      </div>
                  </div>
              </div>
              
              <div class="col-md-3 p-0 views">
                  <div class="title">
                      <h1>Cronograma Visitas</h1>
                  </div>
                  <div class="sub-title">
                      <h1>Hoy</h1>
                  </div>

                  <div class="views-list">

                      <!-- LISTA DE VISTAS -->
                      <div class="clients-view">
                          <div class="row m-0">
                              <div class="col-md-9 date-client">
                                  <p>Gian Marco Albornoz Rimas</p>
                                  <p class="font-weight-bold">12:00 am</p>
                              </div>
                              <div class="col-md-3 map">
                                  <i class="fas fa-map-marker-alt"></i>
                              </div>
                          </div>
                      </div>
                      <!-- FIN DE LISTA DE CLIENTES -->

                      <!-- LISTA DE VISTAS -->
                      <div class="clients-view">
                          <div class="row m-0">
                              <div class="col-md-9 date-client">
                                  <p>Gian Marco Albornoz Rimas</p>
                                  <p class="font-weight-bold">12:00 am</p>
                              </div>
                              <div class="col-md-3 map">
                                  <i class="fas fa-map-marker-alt"></i>
                              </div>
                          </div>
                      </div>
                      <!-- FIN DE LISTA DE CLIENTES -->
                  </div>


                  <div class="sub-title">
                      <h1>Vie, 30 Mar 2019</h1>
                  </div>

                  <div class="views-list">

                      <!-- LISTA DE VISTAS -->
                      <div class="clients-view">
                          <div class="row m-0">
                              <div class="col-md-9 date-client">
                                  <p>Gian Marco Albornoz Rimas</p>
                                  <p class="font-weight-bold">12:00 am</p>
                              </div>
                              <div class="col-md-3 map">
                                  <i class="fas fa-map-marker-alt"></i>
                              </div>
                          </div>
                      </div>
                      <!-- FIN DE LISTA DE CLIENTES -->

                      <!-- LISTA DE VISTAS -->
                      <div class="clients-view">
                          <div class="row m-0">
                              <div class="col-md-9 date-client">
                                  <p>Gian Marco Albornoz Rimas</p> 
                                  <p class="font-weight-bold">12:00 am</p>
                              </div>
                              <div class="col-md-3 map">
                                  <i class="fas fa-map-marker-alt"></i>
                              </div>
                          </div>
                      </div>
                      <!-- FIN DE LISTA DE CLIENTES -->
                  </div>

              </div>

      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      
    };
  },
  methods: {

  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
