<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Apptitle;
use App\Models\Countries;
use App\Models\Footertext;
use App\Models\Seosetting;
use App\Models\Pages;
use App\Models\Sla;
use Auth;
use Str;
use Illuminate\Support\Facades\Validator;
use Response;

class SLAController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = Sla::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<div class = "d-flex">';
                    if (Auth::user()->can('Project Edit')) {

                        $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="action-btns1 edit-testimonial"><i class="feather feather-edit text-primary" data-id="' . $data->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>';
                    } else {
                        $button .= '~';
                    }
                    if (Auth::user()->can('Project Delete')) {
                        $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="action-btns1" id="delete-testimonial" ><i class="feather feather-trash-2 text-danger" data-id="' . $data->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a>';
                    } else {
                        $button .= '~';
                    }

                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('checkbox', function ($data) {
                    if (Auth::user()->can('Project Delete')) {
                        return '<input type="checkbox" name="project_checkbox[]" class="checkall" value="' . $data->id . '" />';
                    } else {
                        return '<input type="checkbox" name="project_checkbox[]" class="checkall" value="' . $data->id . '" disabled />';
                    }
                })
                ->addColumn('name', function ($data) {
                    return Str::limit($data->name, '40');
                })
                ->addColumn('tickets_monthly', function ($data) {
                    return $data->tickets_monthly;
                })
                ->rawColumns(['action', 'checkbox', 'name','country','tickets_monthly'])
                ->addIndexColumn()
                ->make(true);
        }
        $basic = Apptitle::first();

        $title = Apptitle::first();
        $data['title'] = $title;

        $footertext = Footertext::first();
        $data['footertext'] = $footertext;

        $seopage = Seosetting::first();
        $data['seopage'] = $seopage;

        $post = Pages::all();
        $data['page'] = $post;


        return view('admin.slas.index', compact('basic', 'title', 'footertext'))->with($data)->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',

        ]);

        if ($validator->passes()) {
            $testiId = $request->sla_id;
            $testi =  [
                'name' => $request->name,
                'tickets_monthly' => $request->tickets_monthly,

            ];

            $sla = Sla::updateOrCreate(['id' => $testiId], $testi);
            return response()->json(['code' => 200, 'success' => trans('langconvert.functions.slaupdatecreate'), 'data' => $sla], 200);
        } else {
            return Response::json(['errors' => $validator->errors()]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('Project Delete');
        $sla = Sla::find($id);
        $sla->delete();

        return response()->json(['error' => trans('langconvert.functions.sladelete')]);
    }

    public function slamassdestroy(Request $request)
    {
        $sla_id_array = $request->input('id');

        $slas = Sla::whereIn('id', $sla_id_array)->get();

        foreach ($slas as $sla) {
            $sla->delete();
        }
        return response()->json(['error' => trans('langconvert.functions.sladelete')]);
    }
    public function show($id)
    {
      $this->authorize('Project Edit');
        $post = Sla::find($id);
        return response()->json($post);
    }
}
