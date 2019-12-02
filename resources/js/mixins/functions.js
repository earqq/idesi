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
            this.form.provincias_id = null 
            this.form.distritos_id = null
            console.log("sdad");
            this.filterProvinces()
        },
        filterProvinces() {
            this.provinces = this.all_provinces.filter(f => {
                return f.departamento_id === this.form.departamentos_id
            })
        },
        filterDistrict() {
            this.form.distritos_id = null
            this.filterDistricts()
        },
        filterDistricts() {
            this.districts = this.all_districts.filter(f => {
                return f.provincia_id === this.form.provincias_id
            })
        },
        
    }
};