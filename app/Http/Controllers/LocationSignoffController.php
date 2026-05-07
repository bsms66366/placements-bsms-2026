<?php

namespace App\Http\Controllers;

use App\Models\LocationSignoff;
use Illuminate\Http\Request;

class LocationSignoffController extends Controller
{
    public function index()
    {
        return LocationSignoff::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_barcode' => 'required|string|max:255',
            'bsms_id' => 'required|string|max:255',
            'reg_number_of_approver' => 'nullable|string|max:255',
            'signoff_name' => 'nullable|string|max:255',
            'signature_svg_base64' => 'nullable|string',
            'location_id' => 'required|exists:locations2025,id',
            'location_postcode' => 'nullable|string|max:255',
        ]);

        if (isset($validated['signature_svg_base64'])) {
            $validated['signature_svg'] = base64_decode($validated['signature_svg_base64']);
            unset($validated['signature_svg_base64']);
        }

        return LocationSignoff::create($validated);
    }

    public function submitData(Request $request)
    {
        return $this->storeDataPayload($request);
    }

    public function saveRecord(Request $request)
    {
        return $this->storeDataPayload($request);
    }

    protected function storeDataPayload(Request $request)
    {
        $validated = $request->validate([
            'location_barcode' => 'required|string|max:255',
            'bsms_id' => 'required|string|max:255',
            'reg_number_of_approver' => 'nullable|string|max:255',
            'signoff_name' => 'nullable|string|max:255',
            'data' => 'nullable|string',
            'location_id' => 'required|exists:locations2025,id',
            'location_postcode' => 'nullable|string|max:255',
        ]);

        if (isset($validated['data'])) {
            $validated['signature_svg'] = base64_decode($validated['data']);
            unset($validated['data']);
        }

        return LocationSignoff::create($validated);
    }
}
