<?php

namespace App\Services;

use App\Models\User;
use Yajra\Address\Repositories\Regions\RegionsRepository;
use Yajra\Address\Repositories\Provinces\ProvincesRepository;
use Yajra\Address\Repositories\Cities\CitiesRepository;
use Yajra\Address\Repositories\Barangays\BarangaysRepository;

class UserAddressService
{

    private $user_info;

    public $cache = [
        'regions' => [],
        'provinces' => [],
        'cities' => [],
        'barangays' => [],
    ];

    public $selected = [
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
    ];

    public function __construct(User $user)
    {
        $this->user_info = $user->info();

        $this->selected['region'] = $this->user_info->region_id;
        $this->selected['province'] = $this->user_info->province_id;
        $this->selected['city'] = $this->user_info->city_id;
        $this->selected['barangay'] = $this->user_info->barangay_id;

        $this->cacheRegions();
    }

    private function cacheRegions()
    {
        $repository = resolve(RegionsRepository::class);
        $this->cache['regions'] = $repository->all();
        $this->cacheProvinces();
    }

    private function cacheProvinces()
    {

        $region_id = $this->user_info->region_id;

        if (is_null($region_id)) return;

        $repository = resolve(ProvincesRepository::class);

        $provinces = $repository->getProvinceByRegion($region_id);

        $this->cache['provinces'][$region_id] = $provinces;

        $this->cacheCities();
    }

    private function cacheCities()
    {
        $province_id = $this->user_info->province_id;

        if (is_null($province_id)) return;

        $repository = resolve(CitiesRepository::class);

        $this->cache['cities'][$province_id] = $repository->getByProvince($province_id);

        $this->cacheBarangays();
    }

    private function cacheBarangays()
    {
        $city_id = $this->user_info->city_id;

        if (is_null($city_id)) return;

        $repository = resolve(BarangaysRepository::class);

        $this->cache['barangays'][$city_id] = $repository->getByCity($city_id);
    }
}