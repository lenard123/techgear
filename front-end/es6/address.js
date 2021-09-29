
const fetchRegionLocation = async (region) => {
  try {
    const { data } = await axios.get(`${php_base_url}api.php?page=location&region=${region}`)
    return data
  } catch (err) {
    console.log('There is an errpr', err)
    return undefined
  }
}

document.addEventListener('alpine:init', () => {

  Alpine.data('address', () => ({

    all_location: {},

    get province_list() {
      const province_list = this.all_location[this.selected_region]?.province_list
      if (typeof province_list === 'undefined') return {}
      return province_list
    },

    get municipality_list() {
      const province_list = this.province_list
      const province = province_list[this.selected_province]
      if (typeof province === 'undefined') return {}
      return province.municipality_list
    },

    get barangay_list() {
      const municipality = this.municipality_list[this.selected_municipality]
      if (typeof municipality === 'undefined') return []
      return municipality.barangay_list
    },

    get provinces() {
      return Object.keys(this.province_list)
    },

    get municipalities() {
      return Object.keys(this.municipality_list)
    },

    selected_region: '',
    selected_province: '',
    selected_municipality: '',
    selected_barangay: '',

    init() {
      this.$watch('selected_region', async (selected) => {
        if (typeof this.all_location[selected] !== 'undefined') return
        this.all_location[selected] = await fetchRegionLocation(selected)
      })

      if (typeof php_region !== 'undefined') {
        this.all_location[php_region] = php_region_data
        this.$nextTick(() => {
          this.selected_region = php_region
          if (typeof php_province !== 'undefined') this.selected_province = php_province
          if (typeof php_municipality !== 'undefined') this.selected_municipality = php_municipality
          if (typeof php_barangay !== 'undefined') this.selected_barangay = php_barangay
        })
      }

    }

  }))

})