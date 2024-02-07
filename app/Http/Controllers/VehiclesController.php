<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Vehicle_subcategory;
use App\Models\Vehicle_category;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use App\Traits\GlobalErrors;
use App\Exceptions\InertiaException;

/**
 *
 */
class VehiclesController extends Controller
{

    use GlobalErrors;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo 'vehicles';
    }

    /**
     * Gets all the related cat -> sub cat -> vehicles data
     * The Vehicle_category and Vehicle_subcategory 'gets'
     * would be mirrored in their respective controllers in a full app.
     * They have been rolled into one response here for the POC.
     *
     * @param Request $request
     * @return Response
     * @throws InertiaException
     */
    public function getVehicles(Request $request): Response
    {
        //check vehicle cat exists
        try {
            $vehicleCat = Vehicle_category::where('name',$request->path())->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw new InertiaException($this->getExceptionError('noVehicleCategory'),404);
        }

        //get sub cats
        try {
            $vehicleSubCats = Vehicle_subcategory::where('vehicle_categories_id',$vehicleCat->id)->get();
        } catch (ModelNotFoundException $exception) {
            throw new InertiaException($this->getExceptionError('noVehicleCategory'),404);
        }

        //get vehicle row sub cats -> vehicles
        try{
            $vehicles = Vehicle::whereIn('vehicle_subcategory_id',$vehicleSubCats->pluck('id')->toArray())->with('Vehicle_subcategory')->paginate(5);
        } catch (ModelNotFoundException $exception) {
            throw new InertiaException($this->getExceptionError('noVehicles'),404);
        }

        return Inertia::render('Vehicles/Index', [
            'status' => 'live',
            'category' => ucfirst($request->path()),
            'subCats' => $vehicleSubCats,
            'count' => $vehicles->count(),
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
