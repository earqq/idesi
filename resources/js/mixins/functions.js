export const serviceNumber = {
    data() {
        return {
            loading_search: false,
            fromRoute: undefined
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
            this.form.laboral.provincia = null 
            this.form.laboral.distrito = null
            console.log("sdad");
            this.filterProvinces()
        },
        filterProvinces() {
            this.provinces = this.all_provinces.filter(f => {
                return f.departamento_id === this.form.laboral.departamento
            })
        },
        filterDistrict() {
            this.form.laboral.distrito = null
            this.filterDistricts()
        },
        filterDistricts() {
            this.districts = this.all_districts.filter(f => {
                return f.provincia_id === this.form.laboral.provincia
            })
        },
        
    }
};