export const serviceNumber = {
    data() {
        return {
            loading_search: false
        }
    },
    methods: {
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