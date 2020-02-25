<template lang="pug">
      <div class="form_step_wrapper">
            <div class="form_list no_border">
              <div class="sub_step_wrapper " v-for="(row, index) in prestamo.garantias" :key="index">
                <h3 class="title">
                  Garantia {{index + 1}}
                  <button 
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveGarantia(index)">
                    <i class="material-icons-outlined">delete</i>
                  </button>
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Bien en Garantía</label>
                      <input type="text" maxlength="50" v-model="row.bien_garantia" />
                    </div>
                  </div>
                  <div class="group_form">
                    <div class="input_box no_label">
                      <div class="input_box_wrapper">
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio'+index" :name="'garantiaType'+index" v-model="row.inscripcion" value="1" />
                          <label class="box_content" :for="'radio'+index">
                            <div class="box">
                            </div>
                            <span>Inscripción</span>
                          </label>
                        </div>
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio2'+index" :name="'garantiaType'+index" v-model="row.declaracion_jurada" value="1" />
                          <label class="box_content" :for="'radio2'+index">
                            <div class="box">
                            </div>
                            <span>Declaración Jurada</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" @click="clickAddGarantia" class="add_section" v-if="prestamo.garantias.length<=1">
              <span>AGREGAR GARANTIA</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>
</template>