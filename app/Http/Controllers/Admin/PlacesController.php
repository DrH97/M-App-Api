<?php

namespace App\Http\Controllers\Admin;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectsRequest;
use App\Http\Requests\Admin\UpdateProjectsRequest;

class PlacesController extends Controller
{
    /**
     * Display a listing of Place.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!Gate::allows('project_access')) {
        //     return abort(401);
        // }


        if (request('show_deleted') == 1) {
            // if (!Gate::allows('project_delete')) {
            //     return abort(401);
            // }
            $places = Place::onlyTrashed()->get();
        } else {
            $places = Place::all();
        }

        return view('admin.places.index', compact('places'));
    }

    /**
     * Show the form for creating new Place.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (!Gate::allows('project_create')) {
        //     return abort(401);
        // }
        $locations = \App\Location::get()->pluck('country', 'id', 'area')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.places.create', compact('locations'));
    }

    /**
     * Store a newly created Place in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreProjectsRequest $request)
    // {
    public function store(Request $request)
    {
        // if (!Gate::allows('project_create')) {
        //     return abort(401);
        // }
        $path = $request->file('image')->store('placeimages');

        $request->image = $path;

        // return $request->image;
        $place = new Place;
        $place->title = $request->title;
        $place->image = $request->image;
        $place->location_id = $request->location_id;
        $place->description = $request->description;
        $place->price = $request->price;

        // return $place;
        $place->save();
        // $place = Place::create($place);

        return redirect()->route('admin.places.index');
    }


    /**
     * Show the form for editing Place.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (!Gate::allows('project_edit')) {
        //     return abort(401);
        // }
        $place = Place::findOrFail($id);

        return view('admin.places.edit', compact('place'));
    }

    /**
     * Update Place in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateProjectsRequest $request, $id)
    // {
    public function update(Request $request, $id)
    {
        // if (!Gate::allows('project_edit')) {
        //     return abort(401);
        // }
        $place = Place::findOrFail($id);
        $place->update($request->all());

        return redirect()->route('admin.places.index');
    }


    /**
     * Display Place.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (!Gate::allows('project_view')) {
        //     return abort(401);
        // }
        $place = Place::findOrFail($id);

        return view('admin.places.show', compact('place'));
    }


    /**
     * Remove Place from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!Gate::allows('project_delete')) {
        //     return abort(401);
        // }
        $place = Place::findOrFail($id);
        $place->delete();

        return redirect()->route('admin.places.index');
    }

    /**
     * Delete all selected Place at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        // if (!Gate::allows('project_delete')) {
        //     return abort(401);
        // }
        if ($request->input('ids')) {
            $entries = Place::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Place from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // if (!Gate::allows('project_delete')) {
        //     return abort(401);
        // }
        $place = Place::onlyTrashed()->findOrFail($id);
        $place->restore();

        return redirect()->route('admin.places.index');
    }

    /**
     * Permanently delete Place from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        // if (!Gate::allows('project_delete')) {
        //     return abort(401);
        // }
        $place = Place::onlyTrashed()->findOrFail($id);
        $place->forceDelete();

        return redirect()->route('admin.places.index');
    }
}
