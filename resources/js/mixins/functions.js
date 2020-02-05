export const serviceNumber = {
    data() {
        return {
            loading_search: false,
            fromRoute: undefined,
            id_rol: ''
        }
    },
  beforeRouteEnter (to, from, next) {
    next((vm) => {
      vm.fromRoute = from.name
    })
  },
    methods: {
        backMixin_handleBack(fallBackUrl) {
            if (this.fromRoute) {
              this.$router.back()
            } else {
              this.$router.push(fallBackUrl || '/')
            }
          },
        filterProvince() {
            this.form.laboral.provincia = '0'
            this.form.laboral.distrito = '0'
            this.filterProvinces()
        },
        filterProvinces() {
            this.provinces = this.all_provinces.filter(f => {
                return f.departamento_id === this.form.laboral.departamento
            })
        },
        filterDistrict() {
            this.form.laboral.distrito = '0'
            this.filterDistricts()
        },
        filterDistricts() {
            this.districts = this.all_districts.filter(f => {
                return f.provincia_id === this.form.laboral.provincia
            })
        },

      filterProvinceTitular() {
          this.form.natural.domicilio_provincia = '0'
          this.form.natural.domicilio_distrito = '0'
          this.filterProvincesTitular()
      },
      filterProvincesTitular() {

        console.log(this.all_departments)
          this.provincesTitular = this.all_provinces.filter(f => {
              return f.departamento_id === this.form.natural.domicilio_departamento
          })
      },
      filterDistrictTitular() {
          this.form.natural.domicilio_distrito = '0'
          this.filterDistrictsTitular()
      },
      filterDistrictsTitular() {
          this.districtsTitular = this.all_districts.filter(f => {
              return f.provincia_id === this.form.natural.domicilio_provincia
          })
      },
        
    }
};

// 'use strict';

// const video = document.getElementById('video');
// const canvas = document.getElementById('canvas');
// const snap = document.getElementById("snap");
// const errorMsgElement = document.querySelector('span#errorMsg');

// const constraints = {
//   audio: true,
//   video: {
//     width: 1280, height: 720
//   }
// };

// // Access webcam
// async function init() {
//   try {
//     const stream = await navigator.mediaDevices.getUserMedia(constraints);
//     handleSuccess(stream);
//   } catch (e) {
//     errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
//   }
// }

// // Success
// function handleSuccess(stream) {
//   window.stream = stream;
//   video.srcObject = stream;
// }

// // Load init
// init();

// // Draw image
// var context = canvas.getContext('2d');
// snap.addEventListener("click", function() {
//         context.drawImage(video, 0, 0, 640, 480);
// });