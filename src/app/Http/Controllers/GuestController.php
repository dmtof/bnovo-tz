<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestCreateRequest;
use App\Http\Requests\GuestUpdateRequest;
use App\Models\Guest;

class GuestController extends Controller
{
    public function index()
    {
        return Guest::all();
    }

    public function store(GuestCreateRequest $request)
    {
        $requestData = $request->validated();
        if (!isset($requestData['country'])) {
            $requestData['country'] = $this->getCountryFromPhone($requestData['phone']);
        }

        return Guest::create($requestData);
    }

    public function show($id)
    {
        return Guest::findOrFail($id);
    }

    public function update(GuestUpdateRequest $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $requestData = $request->validated();

        $guest->fill($requestData);
        if ($guest->isDirty('phone')) {
            $guest->country = $this->getCountryFromPhone($guest->phone);
        }
        $guest->save();

        return response()->json($guest);
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return response()->json(null, 204);
    }

    private function getCountryFromPhone($phone)
    {
        $countries = [
            'Russia' => '+7',
            'USA' => '+1',
            'UK' => '+44',
            'France' => '+33',
            'Brazil' => '+55',
            'Australia' => '+61',
            'Germany' => '+49',
            'Spain' => '+34',
            'Italy' => '+39',
            'Netherlands' => '+31',
            'Poland' => '+48',
            'Czech Republic' => '+420',
            'Romania' => '+40',
            'Hungary' => '+36',
            'Slovakia' => '+421',
            'Croatia' => '+385',
            'Slovenia' => '+386',
            'Serbia' => '+381',
            'Bosnia and Herzegovina' => '+387',
            'Albania' => '+355',
            'Greece' => '+30',
            'Latvia' => '+371',
            'Lithuania' => '+370',
            'Estonia' => '+372',
            'Andorra' => '+376',
            'Monaco' => '+377',
            'Liechtenstein' => '+423',
            'San Marino' => '+378',
            'Vatican City' => '+379',
            'Malta' => '+356',
            'Iceland' => '+354',
            'Ireland' => '+353',
            'Gibraltar' => '+350',
        ];

        foreach ($countries as $country => $code) {
            if (str_starts_with($phone, $code)) {
                return $country;
            }
        }

        return null;
    }
}
