import Municipality from './data/municipality.json';
document.addEventListener('alpine:init', () => {
    Alpine.data('kyc', () => ({
        p_municipalities: [],
        districtData: Municipality,
        p_district: null,
        t_district: null,
        t_municipalities: [],
        init() {
            this.$watch('p_district', (value) => {
                if (value in this.districtData) {
                    this.p_municipalities = this.districtData[value];
                } else {
                    this.p_municipalities = [];
                }
            })

            this.$watch('t_district', (value) => {
                if (value in this.districtData) {
                    this.t_municipalities = this.districtData[value];
                } else {
                    this.t_municipalities = [];
                }
            })
        },
    }))
})