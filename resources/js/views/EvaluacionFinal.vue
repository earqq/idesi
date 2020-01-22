<template>
  <div class="container-general">
    <div class="evaluations">
      <div class="row col-md-12 m-0">
        <div class="card col-md-12 p-0">
          <div class="card-header">PRESTAMOS</div>
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Fecha de registro</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="prestamo in prestamos" :key="prestamo.id">
                  <td v-text="prestamo.nombres +' '+ prestamo.apellidos"></td>
                  <td v-text="prestamo.created_at"></td>
                  <td v-text="prestamo.estado"></td>
                  <td>
                    <router-link
                            v-if="prestamo.estado=='PENDIENTE'"
                            :to="{name:'/evaluacion/final/', params:{prestamo:prestamo.id}}"
                            class="btn btn-def ml-3"
                          >Evalular
                    </router-link> 
                    <button
                      v-else
                      class="btn btn-def"
                      style="width:50%"
                    >Detalles</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select'
export default {
  data() {
    return {
      resource: "evaluaciones", 
      prestamos: [], 
  
    };
  },
  async created() { 
    await this.methodsPrestamo();
  },
  methods: {
    methodsPrestamo() {
      this.$http.get(`/${this.resource}/prestamos/`).then(response => {
        this.prestamos = response.data;
        console.log(response.data);
      });
    },
  },
};
</script>
 