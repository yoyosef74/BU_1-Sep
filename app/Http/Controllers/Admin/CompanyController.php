<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Apptitle;
use App\Models\Company;
use App\Models\Countries;
use App\Models\Footertext;
use App\Models\Seosetting;
use App\Models\Pages;
use Auth;
use Str;
use Illuminate\Support\Facades\Validator;
use Response;

class CompanyController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = Company::latest()->get();
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
                ->addColumn('country', function ($data) {
                    return $data->country->name ?? '-';
                })
                ->rawColumns(['action', 'checkbox', 'name','country'])
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
        $data['countries'] = Countries::all();;


        return view('admin.companies.index', compact('basic', 'title', 'footertext'))->with($data)->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',

        ]);

        if ($validator->passes()) {
            $testiId = $request->company_id;
            $testi =  [
                'name' => $request->name,
                'country_id' => $request->country_id,

            ];

            $company = Company::updateOrCreate(['id' => $testiId], $testi);
            return response()->json(['code' => 200, 'success' => trans('langconvert.functions.companyupdatecreate'), 'data' => $company], 200);
        } else {
            return Response::json(['errors' => $validator->errors()]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('Project Delete');
        $company = Company::find($id);
        $company->delete();

        return response()->json(['error' => trans('langconvert.functions.companydelete')]);
    }

    public function companymassdestroy(Request $request)
    {
        $company_id_array = $request->input('id');

        $companies = Company::whereIn('id', $company_id_array)->get();

        foreach ($companies as $company) {
            $company->delete();
        }
        return response()->json(['error' => trans('langconvert.functions.companydelete')]);
    }
    public function show($id)
    {
      $this->authorize('Project Edit');
        $post = Company::find($id);
        return response()->json($post);
    }
}
