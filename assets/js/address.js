
var cache_location = {}
var selected_region = null
var selected_province = null

var fetchLocation = function(region) {
  return new Promise(function(resolve, reject) {
    if (cache_location[region] !== undefined) {
      resolve(cache_location[region])
      return
    }
    axios.get(php_base_url + 'api.php?page=location&region=' + region)
      .then(function (result) {
        var data = result.data;
        cache_location[region] = data
        resolve(data)
      })
      .catch(reject)
  })
}

$(document).ready(function() {


  var INPUT_REGION = $('#checkout_input_region')
  var INPUT_PROVINCE = $('#checkout_input_province')
  var INPUT_MUNICIPALITY = $('#checkout_input_municipality')
  var INPUT_BARANGAY = $('#checkout_input_barangay')

  INPUT_REGION.change(function(e) {
    var selected = e.currentTarget.value
    if (selected == "") {
      INPUT_PROVINCE.val('').attr('disabled', true)
    } else {
      fetchLocation(selected).then(function(location) {
        selected_region = location

        var provinces = Object.keys(selected_region.province_list)

        INPUT_PROVINCE.attr('disabled', false).val('').html('<option value="">-- Select Province --</option>')
        provinces.forEach(function(province) {
          INPUT_PROVINCE.append(`<option>${province}</option>`)
        })
      })
    }

    INPUT_MUNICIPALITY.val('').attr('disabled', true)
    INPUT_BARANGAY.val('').attr('disabled', true)
  })

  INPUT_PROVINCE.change(function(e) {
    var selected = e.currentTarget.value
    if (selected == "") {
      INPUT_MUNICIPALITY.attr('disabled', true).val('')
    } else {
      selected_province = selected_region.province_list[selected]
      var cities = Object.keys(selected_province.municipality_list)

      INPUT_MUNICIPALITY.attr('disabled', false).val('').html('<option value="">-- Select City --</option>')
      cities.forEach(function(city) {
        INPUT_MUNICIPALITY.append(`<option>${city}</option>`)
      })
    }

    INPUT_BARANGAY.val('').attr('disabled', true)
  })

  INPUT_MUNICIPALITY.change(function(e) {
    var selected = e.currentTarget.value
    if (selected == "") {
      INPUT_BARANGAY.attr('disabled', true).val('')
    } else {
      var brgys = selected_province.municipality_list[selected].barangay_list
      INPUT_BARANGAY.attr('disabled', false).val('').html('<option value="">-- Select Barangay --</option>')
      brgys.forEach(function(brgy) {
        INPUT_BARANGAY.append(`<option>${brgy}</option>`)
      })
    }
  })

  if (php_region) {
    cache_location[php_region] = php_region_data
    selected_region = php_region_data
    INPUT_REGION.val(php_region).change()
    if (php_province) {
      /**
       * The reason for setTimeOut is because the change event
       * for input province is a promise
       * so the execution order is messy.
       **/
      setTimeout(function() { 
        INPUT_PROVINCE.val(php_province).change()

        if (php_municipality) {
          INPUT_MUNICIPALITY.val(php_municipality).change()
          if (php_barangay) {
            INPUT_BARANGAY.val(php_barangay).change()
          }
        }

      }, 100)
    }
  }
})
