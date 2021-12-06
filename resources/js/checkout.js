document.addEventListener('alpine:init', async function() {

  const Alpine = window.Alpine
  const axios = window.axios


  const fetchAllRegions = async function () {
    const { data } = await axios.get('/api/address/regions')
    return data
  }

  const fetchProvinces = async function(region_id) {
    const { data } = await axios.get(`/api/address/provinces/${region_id}`)
    return data
  }

  const fetchCities = async function (province_id) {
    const { data } = await axios.get(`/api/address/cities/${province_id}`)
    return data
  }

  const fetchBarangays = async function (city_id) {
    const { data } = await axios.get(`/api/address/barangays/${city_id}`);
    return data
  }

  Alpine.data('address', (cache, selected) => ({

    cache: cache,

    selected: selected,

    get filteredProvinces() {

      if (
        this.selected.region == '' || //No selected region
        !this.cache.provinces[this.selected.region] //Selected province is empty
      ) return []

      return this.cache.provinces[this.selected.region]
    },

    get filteredCities() {
      if (
        this.selected.province == '' || //No selected province
        !this.cache.cities[this.selected.province] //Selected cities is empty
      ) return []

      return this.cache.cities[this.selected.province]
    },

    get filteredBarangays() {
      if (
        this.selected.city == '' || //No seletected city
        !this.cache.barangays[this.selected.city]
      ) return []

      return this.cache.barangays[this.selected.city]
    },

    async init() {
      if (!this.cache.regions)
        this.cache.regions = await fetchAllRegions()

      this.$watch('selected.region', async (selected) => {
        this.selected.province = ''
        if(selected != '' && !this.cache.provinces[selected]) {
          this.cache.provinces[selected] = await fetchProvinces(selected)
        }
      })

      this.$watch('selected.province', async (selected) => {
        this.selected.city = ''
        if (selected != '' && !this.cache.cities[selected]) {
          this.cache.cities[selected] = await fetchCities(selected)
        }
      })

      this.$watch('selected.city', async (selected) => {
        this.selected.barangay = ''
        if (selected != '' && !this.cache.barangays[selected]) {          
          this.cache.barangays[selected] = await fetchBarangays(selected)
        }
      })

    }

  }))

})